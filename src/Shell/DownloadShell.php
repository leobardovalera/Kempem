<?php
declare(strict_types=1);

namespace App\Shell;

use Cake\Console\ConsoleOptionParser;
use Cake\Console\Shell;
use Cake\ORM\TableRegistry;
use Cake\Collection\Collection;
use Cake\I18n\Time;

/**
 * Download shell command.
 */
class DownloadShell extends Shell
{
    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser(): ConsoleOptionParser
    {
        $parser = parent::getOptionParser();

        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main(){
        $id = $this->args[0];

        $zipFile = ROOT."/tmp/files/$id.zip";
        $prog = ROOT."/tmp/files/$id.txt";
        $rootPath = ROOT."/tmp/files/$id/";

        if(!file_exists($rootPath)){ 
            mkdir($rootPath, 0777, true);
        }

        $evalTable = TableRegistry::get('Evaluations');

        $evaluations = $evalTable
            ->find('all', [
                'contain' => [
                    'Instruments',
                    'Instruments.Scripts',
                    'Sales',
                    'Sales.Companies'
                ]
            ])
            ->where("Evaluations.sale_id = '$id' and Evaluations.completed IS NOT NULL");
        $count = count($evaluations->toArray());
        $processed = 1;
        foreach($evaluations as $evaluation){

            $input = sprintf($evaluation->instrument->script->in_file,$evaluation->id);
            $output = sprintf($evaluation->instrument->script->out_file,$evaluation->id);
            $command = sprintf($evaluation->instrument->script->command,$evaluation->id);

            $answers = new Collection($evaluation->answers);
            foreach($evaluation->instrument->options['sections'] as $s){
                if(isset($s['process']) && $s['process']){
                    $respuestas = [];
                    foreach($s['questions'] as $q){
                        $filter = $answers->filter(function ($value, $key, $iterator) use ($q) {
                            return $value['question'] == $q;
                        });
                        $respuestas[] = $filter->first()['answer'];
                    }
                    file_put_contents($input,implode(',',$respuestas));
                } 
            }
            exec($command);
            $evaluation->results = file_get_contents($output);
            $evalTable->save($evaluation);

            $data = explode("\n",file_get_contents($output));
            foreach($data as $k => $c){
                if(strpos($c,":") > 0){
                    $data[$k] = explode(":",$c);
                }else{
                    $data[$k] = explode(",",$c);
                }
            }
            $grafico = isset($data[6]) && isset($data[6][1])?$data[6][1]/10:null;
    
            $CakePdf = new \CakePdf\Pdf\CakePdf();
            // $CakePdf->template('reporte');
            
            if ($evaluation->instrument->language == "ES"){
                $CakePdf->template('reporte_spanish');
            } else {
                  $CakePdf->template('reporte_english');
              }

            $CakePdf->viewVars([
                'evaluation' => $evaluation,
                'grafico' => $grafico,
            ]);
    
            file_put_contents("{$rootPath}{$evaluation->names} {$evaluation->lastnames} - ".substr($evaluation->id,-8).".pdf",$CakePdf->output());

            $proc = (floor(($processed/$count)*10000)/100)."%";
            $this->out("$processed/$count = $proc");
            $processed++;
            file_put_contents($prog,$proc);
        }

        // Get real path for our folder
        $rootPath = realpath($rootPath);

        // Initialize archive object
        $zip = new \ZipArchive();
        $zip->open($zipFile, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        // Create recursive directory iterator
        /** @var SplFileInfo[] $files */
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($rootPath),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file){
            // Skip directories (they would be added automatically)
            if (!$file->isDir())
            {
                // Get real and relative path for current file
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);

                // Add current file to archive
                $zip->addFile($filePath, $relativePath);
            }
        }

        // Zip archive will be created only after closing object
        file_put_contents($prog,"<h3 class='completado'>Completado: <a href='/sales/file?id=$id'>Descargar Aqui</a></h3>");
        $zip->close();
    }
}
