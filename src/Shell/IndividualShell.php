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
class IndividualShell extends Shell
{
    var $root;

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

    public function getGraph($number,$sale_id,$eval_id){
        
        $ch = null;
        $dirPath = "{$this->root}/{$sale_id}/{$eval_id}/";

        if(!file_exists($dirPath)){ 
            mkdir($dirPath, 0777, true);
        }

        $ch = curl_init("https://evaluaciones.kempem.es/graph{$number}/{$eval_id}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);

        $res = curl_exec($ch);
        file_put_contents("{$dirPath}/graph{$number}.jpg", $res);
        return;
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main(){
        $id = $this->args[0];

        $this->root = ROOT."/tmp/files/sales";
        $zipFile = "{$this->root}/$id.zip";
        $prog = "{$this->root}/$id.txt";

        if(!file_exists($this->root)){ 
            mkdir($this->root, 0777, true);
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
            $docFile = "{$this->root}/$id/Reporte {$evaluation->names} {$evaluation->lastnames}.docx";

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

            $this->getGraph(1,$id,$evaluation->id);
            $this->getGraph(2,$id,$evaluation->id);
            $this->getGraph(3,$id,$evaluation->id);

            $parseDoc = 
                "/usr/bin/python3 ".
                ROOT.DS."src".DS."Scripts".DS."parseDocIndividual.py ".
                "{$evaluation->instrument->individual} ".
                "\"{$this->root}/{$id}/{$evaluation->id}\" ".
                "\"{$evaluation->names}\" ".
                "\"{$evaluation->lastnames}\" ".
                "\"{$evaluation->sale->company->name}\" ".
                "\"{$evaluation->sale->created->i18nformat('dd/MM/yyyy')}\" "
                ;
            // dd($parseDoc);
            exec($parseDoc);
            exec("/usr/bin/abiword --to=pdf \"{$this->root}/{$id}/{$evaluation->id}/Reporte individual - {$evaluation->names} {$evaluation->lastnames}.docx\"");
            
            $proc = (floor(($processed/$count)*10000)/100)."%";
            $this->out("$processed/$count = $proc");
            $processed++;
            file_put_contents($prog,$proc);
        }

        // Get real path for our folder
        $this->root = realpath($this->root);

        // Initialize archive object
        $zip = new \ZipArchive();
        $zip->open($zipFile, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        // Create recursive directory iterator
        /** @var SplFileInfo[] $files */
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($this->root),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );
        foreach ($files as $name => $file){
            // Skip directories (they would be added automatically)
            if ($file->getExtension() == 'pdf'){
                // Get real and relative path for current file
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($this->root) + 1);

                // Add current file to archive
                $zip->addFile($filePath, $relativePath);
            }
        }

        // Zip archive will be created only after closing object
        file_put_contents($prog,"<h3 class='completado'>Completado: <a href='/sales/file?id=$id'>Descargar Aqui</a></h3>");
        $zip->close();
        system("rm -rf {$this->root}/{$id}");
    }
}
