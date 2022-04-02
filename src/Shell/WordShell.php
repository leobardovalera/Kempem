<?php
declare(strict_types=1);

namespace App\Shell;

use Cake\Console\ConsoleOptionParser;
use Cake\Console\Shell;
use Cake\ORM\TableRegistry;
use Cake\Collection\Collection;
use Cake\I18n\Time;

/**
 * Word shell command.
 */
class WordShell extends Shell
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

        $prog = ROOT."/tmp/files/$id.txt";
        $rootPath = ROOT."/tmp/files/$id/";

        if(!file_exists($rootPath)){ 
            mkdir($rootPath, 0777, true);
        }

        $saleTable = TableRegistry::get('Sales');

        $sale = $saleTable->get($id,[
            'contain' => [
                'Instruments',
                'Companies'
            ]
        ]);

        $questions = [];
        foreach($sale->instrument->options['sections'] as $s){
            if(isset($s['questions'])){
                $questions = array_merge($questions,TableRegistry::get('Questions')->find('all')->where('identifier in ("'.implode('","',$s['questions']).'") and type != "17"')->toArray());
            }
        }
        // dd($questions);
        
        $evaluations = TableRegistry::get('Evaluations')
        ->find('all')
        ->where(["sale_id = '$id' and completed is not NULL"]);
        // dd($evaluations->toArray());
        // $this->set(compact('sale','evaluations','questions'));
        
        $report = [];
        //header
        foreach($questions as $q){
            $report[$q->identifier] = [
                'enunciado' => $q->options['enunciado']['E1'],
                'graph' => empty($q->graph)?"PIE":$q->graph,
                'answers' => []
            ];
        }
        //dd($report);
        $f = 2;
        $candidate = 1;
        $total = count($evaluations->toArray());
        //body
        foreach($evaluations as $e){
            if(!empty($e->answers)){
                $answers = new Collection($e->answers);
                foreach($questions as $q){
                    $filter = $answers->filter(function ($value, $key, $iterator) use ($q) {
                        return $value['question'] == $q->identifier;
                    })->first();
                    if(isset($filter)){
                        if(!isset($report[$q->identifier]['answers'][$filter['answer']])){
                            $report[$q->identifier]['answers'][$filter['answer']] = 0;
                        }
                        $report[$q->identifier]['answers'][$filter['answer']]++;
                        // dd($filter['answer'], $q);
                    }
                    // $this->out($q->identifier.': '.$q->options['enunciado']['E1']);
                }
            }
            $data[$e->id] = new Collection(explode("\n",$e->results));
            $data[$e->id] = $data[$e->id]->map(function ($value, $key) {
                return strpos($value,':')?explode(":",$value):explode(",",$value);
            })->reduce(function ($final, $value) {
                if(!empty($value[0])){
                    if(!isset($final[$value[0]])){
                        $final[$value[0]] = [0,0];
                    }
                    if(isset($value[1]) && $value[1] != 'nan' && !empty($value[1])){
                        $final[$value[0]][0] += $value[1];
                    }
                    if(isset($value[2]) && $value[2] != 'nan' && !empty($value[2])){
                        $final[$value[0]][1] += $value[2];
                    }
                }
                return $final;
            }, []);
        }
        //dd($data);
        $data = (new Collection($data))->reduce(function ($final, $value){
            foreach($value as $c => $v) {
                if(!isset($final[$c][0])){
                    $final[$c][0] = 0;
                }
                $final[$c][0] += $v[0];
                if(isset($v[1]) && $v[1] != 'nan'){
                    $final[$c][1] = $v[1];
                }
            }
            return $final;
        }, []);
        $data = (new Collection($data))->map(function ($value, $key) use ($total) {
            $value[0] /= $total;
            return $value;
        });

        $GraficoAtributos['keys'] = array_slice(array_keys($data->toArray()),7);
        $GraficoAtributos['usted'] = array_slice($data->reduce(function ($final, $value){
            $final[] = $value[0];
            return $final;
        }, []),7);
        $GraficoAtributos['ideal'] = $data->reduce(function ($final, $value){
            if(isset($value[1])){
                $final[] = $value[1];
            }
            return $final;
        }, []);
        // dd($GraficoAtributos);

        $rootPath = ROOT."/tmp/files/sales/$id";
        $docFile = "{$rootPath}/Reporte {$sale->company->name}.docx";

        if(!file_exists($rootPath)){ 
            mkdir($rootPath, 0777, true);
        }
        $count = count($report);
        $processed = 1;

        // dd($report);
        foreach($report as $c => $r){
            switch($r['graph']){
                case 'BARS':
                break;
                case 'LINES':
                break;
                default:
                    $data = array_values($r['answers']);

                    require_once (ROOT.DS.'src'.DS.'jpgraph'.DS.'src'.DS.'jpgraph.php');
                    require_once (ROOT.DS.'src'.DS.'jpgraph'.DS.'src'.DS.'jpgraph_pie.php');

                    // Create the graph. These two calls are always required
                    $graph = new \PieGraph(800,600);
                    $graph->SetScale("textlin");
                    
                    $graph->SetShadow();
                    $graph->img->SetMargin(40,30,70,30);
                    // Create the bar plots
                    $p1 = new \PiePlot($data);
                    $p1->SetLegends(array_keys($r['answers']));
                    
                    // ...and add it to the graPH
                    $graph->Add($p1);
                    
                    $colors = [
                        ['#666666','#aaaaaa','#cccccc','#eeeeee'],
                        ['#ff8003','#ffcb9b','#ffdebf','#fff1e5'],
                        ['#008000','#00aaaa','#00cccc','#00eeee'],
                    ];

                    $p1->SetSliceColors($colors[ $processed % 3 ]);
                    $p1->ExplodeSlice(0);

                    $graph->title->SetFont(FF_FONT1,FS_BOLD);
                    
                    // $graph->xaxis->SetTickLabels($labels);
                    $graph->legend->SetPos(0.04,0.04,'right','top');
                    $graph->legend->SetColumns(1);
                    $graph->legend->SetFont(FF_FONT1,FS_NORMAL, 50);

                    // $bplot->value->SetFormat('%01.2f');
                    // $bplot->value->Show();

                    // $bplot->SetFillColor("#FF8003");
                    // $bplot->SetColor("#FF8003");
                    // $bplot->SetLegend('Usted');
                    // $bplot->value->SetColor("#333A42");

                    // Display the graph
                    $graph->Stroke("{$rootPath}/Grafico{$c}.png");
                    // if($c == 'genero'){
                    //     $graph->Stroke();
                    // }
                    $proc = (floor(($processed/$count)*10000)/100)."%";
                    $this->out("$processed/$count = $proc");
                    $processed++;
                    file_put_contents($prog,$proc);
            }
        }

        //Grafico Atributos
        
        require_once (ROOT.DS.'src'.DS.'jpgraph'.DS.'src'.DS.'jpgraph.php');
        require_once (ROOT.DS.'src'.DS.'jpgraph'.DS.'src'.DS.'jpgraph_bar.php');

        // Create the graph. These two calls are always required
        $graph = new \Graph(700,900);
        $graph->SetScale("textlin");
        
        $graph->SetShadow();
        $graph->img->SetMargin(40,30,20,40);
        
        // Create the bar plots
        $b1plot = new \BarPlot($GraficoAtributos['usted']);
        $b2plot = new \BarPlot($GraficoAtributos['ideal']);
        
        // Create the grouped bar plot
        $gbplot = new \GroupBarPlot(array($b1plot,$b2plot));
        
        // ...and add it to the graPH
        $graph->Add($gbplot);

        $graph->Set90AndMargin(250,30,80,30);

        $graph->xaxis->SetTickLabels($GraficoAtributos['keys']);
        $graph->xaxis->SetLabelMargin(10);
        $graph->xaxis->SetLabelAlign('right','center');
        $graph->xaxis->SetTickLabels($GraficoAtributos['keys']);

        $graph->legend->SetPos(0.04,0.04,'right','top');


        $b1plot->value->SetFormat('%01.2f');
        $b2plot->value->SetFormat('%01.2f');
        $b1plot->value->Show();
        $b2plot->value->Show();

        $b1plot->SetFillColor("#FF8003");
        $b1plot->SetColor("#FF8003");
        $b1plot->SetLegend('Usted');
        $b1plot->value->SetColor("#333A42");

        $b2plot->SetFillColor("#333A42");
        $b2plot->SetColor("#333A42");
        $b2plot->SetLegend('Ideal');
        $b2plot->value->SetColor("#333A42");

        $graph->title->SetFont(FF_FONT1,FS_BOLD);
        
        // Display the graph
        $graph->Stroke("{$rootPath}/Atributos.png");

        file_put_contents($prog,"<h3 class='completado'>Completado: <a href='/sales/file?id=$id'>Descargar Aqui</a></h3>");
    }
}
