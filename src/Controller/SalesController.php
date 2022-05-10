<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Core\Configure;
use Cake\Event\EventInterface;
use Cake\ORM\TableRegistry;
use Cake\Collection\Collection;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use \PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Cake\I18n\Time;


/**
 * sales Controller
 *
 * @property \App\Model\Table\salesTable $sales
 * @method \App\Model\Entity\sale[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SalesController extends AppController
{
    public function beforefilter(EventInterface $event){
        $this->set('pageHeader','<i class="fas fw fa-receipt"></i> Ventas');
    }
    
    public function index(){
        require(ROOT.'/src/countries.php');
        $config = $this->paginate = [
            'sortableFields' => [
                'Companies.name',
                'Sales.created',
                'Sales.country',
                'Sales.instrument_id',
            ],
        ];
        
        $filters = [
            'from' => [
                'label' => 'Desde',
                'field' => 'Sales.started >=',
                'type' => 'date',
            ],
            'to' => [
                'label' => 'Hasta',
                'field' => 'Sales.started <=',
                'type' => 'date',
            ],
            'break' => [
                'type' => 'break',
            ],
            'companies' => [
                'label' => 'Empresas',
                'field' => 'Sales.company_id = ',
                'type' => 'select',
                'options' => TableRegistry::get('Companies')->find('list',[
                    'keyField' => 'id',
                    'valueField' => 'name'
                ])->order('name')->toArray(),
            ],
            'instrumentos' => [
                'label' => 'Instrumentos',
                'field' => 'Sales.instrument_id = ',
                'type' => 'select',
                'options' => TableRegistry::get('Instruments')->find('list',[
                    'keyField' => 'id',
                    'valueField' => 'name'
                ])->order('name')->toArray(),
            ],
            'Pais' => [
                'label' => 'Pais',
                'field' => 'Sales.country = ',
                'type' => 'select',
                'options' => $countries,
            ],
        ];

        $sales = $this->Sales->find('all',[
            'contain' => [
                'Companies',
                'Instruments',
                'Evaluations'
            ],
        ]);

        foreach ($this->request->getQuery() as $key => $value) {
            if (isset($filters[$key]) && ! empty($value)) {
                $sales->where([
                    $filters[$key]['field'] => $value
                ]);
            }
        }

        if($this->user && $this->user->role != 'superadmin'){
            $sales = $sales->where('company_id = '.$this->user->company_id);
        }
        // dd($sales->sql());

        $sales = $this->paginate($sales);

        $this->set(compact('sales','countries','filters'));
    }
    
    public function graphs($id = null){
        require(ROOT.'/src/countries.php');
        
        $prog = ROOT."/tmp/files/$id.txt";
        $rootPath = ROOT."/tmp/files/$id/";

        if(!file_exists($rootPath)){ 
            mkdir($rootPath, 0777, true);
        }

        $saleTable = TableRegistry::get('Sales');

        $sale = $saleTable->get($id,[
            'contain' => [
                'Instruments',
                'Companies',
                'Evaluations'
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
        $data = [];
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
            $data[$e->id]['Semaforo'] = (int) floor($data[$e->id]['Global'][0]/5);
            $rango = ($data[$e->id]['Global'][0]<=30
                        ? "Bajo"
                        : (($data[$e->id]['Global'][0] > 30 && $data[$e->id]['Global'][0] <= 70)
                            ? "Medio"
                            : "Alto"));
            $data[$e->id][$rango] = $data[$e->id]['Global'][0];
        }
        if(empty($data)){
            $this->Flash->error(__('No se ha encontrado información'));
            return $this->redirect(['action' => 'index']);        
        }
        $data = (new Collection($data))->reduce(function ($final, $value){
            foreach($value as $c => $v) {
                if(in_array($c,['Bajo','Medio','Alto'])){
                    if(!isset($final[$c])){
                        $final = [
                            'Bajo' => [0],
                            'Medio' => [0],
                            'Alto' => [0],
                        ];
                    }
                    $final[$c][0]++;
                }elseif($c == 'Semaforo'){
                    if(!isset($final[$c])){
                        $final[$c] = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
                        // $final[$c] = [5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5];
                    }
                    $final['Semaforo'][$v]++;
                }else{
                    if(!isset($final[$c][0])){
                        $final[$c][0] = 0;
                    }
                    $final[$c][0] += $v[0];
                    if(isset($v[1]) && $v[1] != 'nan'){
                        $final[$c][1] = $v[1];
                    }
                }
            }
            return $final;
        }, []);
        // dd($data);
        $data = (new Collection($data))->map(function ($value, $key) use ($total) {
            if(in_array($key,['Bajo','Medio','Alto'])){
                $value[0] = $value[0] / $total * 100;
            }elseif($key != 'Semaforo'){
                $value[0] /= $total;
            }
            return $value;
        });
        // dd($data->toArray());
        $GraficoAtributos['keys'] = array_slice(array_keys($data->toArray()),10,20);
        $GraficoAtributos['usted'] = array_slice($data->reduce(function ($final, $value){
            $final[] = $value[0];
            return $final;
        }, []),10,20);
        $GraficoAtributos['ideal'] = array_slice($data->reduce(function ($final, $value){
            if(isset($value[1])){
                $final[] = $value[1];
            }
            return $final;
        }, []),0,20);
        // dd($GraficoAtributos);

        $keys = array_keys($data->toArray());
        $data = $data->toArray();
        // dd($data);
        $GraficoDimensiones['keys'] = [$keys[3],$keys[5],$keys[7]];
        $GraficoDimensiones['Usted'] = [$data[$keys[3]][0],$data[$keys[5]][0],$data[$keys[7]][0]];
        $GraficoDimensiones['Ideal'] = [$data[$keys[4]][0],$data[$keys[6]][0],$data[$keys[8]][0]];
        // dd($GraficoDimensiones);

        $GraficoMadurez = [
            'Bajo' => number_format($data['Bajo'][0],2,',','.'),
            'Medio' => number_format($data['Medio'][0],2,',','.'),
            'Alto' => number_format($data['Alto'][0],2,',','.'),
            'Semaforo' => $data['Semaforo'],
        ];
        // dd($GraficoMadurez);
        $now = Time::now()->i18nformat('dd/MM/YYYY');
        $context = [];
        $context[] = "V_NombreCompania_{$sale->company->name}";
        $context[] = "V_NombreRepresentante_{$sale->company->contact_fullname}";
        $context[] = "V_EmailRepresentante_{$sale->company->contact_email}";
        $context[] = "V_TelefonoRepresentante_{$sale->company->contact_phone}";
        $context[] = "V_NombreInstrumento_{$sale->instrument->name}";
        $context[] = "V_IdiomaInstrumento_{$sale->instrument->language}";
        $context[] = "V_Pais_{$countries[$sale->country]}";
        $context[] = "V_FechaVenta_{$sale->created->i18nformat('dd/MM/YYYY')}";
        $context[] = "V_FechaReporte_{$now}";

        $context[] = "V_Vendidas_{$sale->instruments}";
        $context[] = "V_FechaMaxima_".(isset($sale->max_date)?$sale->max_date->i18nformat('dd/MM/YYYY'):"");
        $context[] = "V_Contestadas_".count($sale->evaluations);
        
        $context[] = "V_Completadas_".count((new Collection($sale->evaluations))->filter(function ($value, $key, $iterator) {
            return !empty($value->completed) && !empty($value->started) && empty($value->anulado);
        })->toArray());
        $context[] = "V_Anuladas_".count((new Collection($sale->evaluations))->filter(function ($value, $key, $iterator) {
            return empty($evaluation->completed) && !empty($value->anulado) && !empty($value->started);
        })->toArray());
        $context[] = "V_Iniciadas_".count((new Collection($sale->evaluations))->filter(function ($value, $key, $iterator) {
            return !empty($value->started);
        })->toArray());

        if ($evaluation->instrument->language == "ES"){
        $context[] = "V_EdadPromedio_".round((new Collection($report['fechaNacimiento']['answers']))->map(function ($value, $key, $iterator){
            $fechaNac = Time::parse($key);
            $now = new Time();
            $edad = $now->diff($fechaNac);
            return $edad->format('%y');
        })->avg());
        } else {
            $context[] = "V_EdadPromedio_".round((new Collection($report['birthday']['answers']))->map(function ($value, $key, $iterator){
                $fechaNac = Time::parse($key);
                $now = new Time();
                $edad = $now->diff($fechaNac);
                return $edad->format('%y');    
        }

        $puntaje = (new Collection($evaluations))->map(function ($value, $key, $iterator){
            $data = explode("\n",$value->results);
            $data = explode(":",$data[6]);
            return $data[1];
        });
        $context[] = "V_MenorPuntaje_".$puntaje->min(function ($value){
            return $value;
        });
        $context[] = "V_MayorPuntaje_".$puntaje->max(function ($value){
            return $value;
        });

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

                    arsort($r['answers']);
                    $data = array_values($r['answers']);

                    require_once (ROOT.DS.'src'.DS.'jpgraph'.DS.'src'.DS.'jpgraph.php');
                    require_once (ROOT.DS.'src'.DS.'jpgraph'.DS.'src'.DS.'jpgraph_pie.php');

                    // Create the graph. These two calls are always required
                    $graph = new \PieGraph(800,600);
                    $graph->SetScale("textlin");
                    
                    $graph->SetShadow();
                    $graph->SetAntiAliasing();
                    $graph->img->SetMargin(40,30,70,30);
                    // Create the bar plots
                    $p1 = new \PiePlot($data);
                    $p1->SetLegends(array_keys($r['answers']));
                    
                    // ...and add it to the graPH
                    $graph->Add($p1);
                    
                    $colors = [
                        ['#666666','#eeeeee','#cccccc','#aaaaaa','#888888'],
                        ['#ff8003','#eeeeee','#cccccc','#aaaaaa','#888888'],
                        ['#008000','#eeeeee','#cccccc','#aaaaaa','#888888'],
                    ];

                    $p1->SetSliceColors($colors[ $processed % 3 ]);
                    // $p1->ExplodeSlice(0);

                    $graph->title->SetFont(FF_DV_SANSSERIF,FS_BOLD);
                    
                    // $graph->xaxis->SetTickLabels($labels);
                    $graph->legend->SetPos(0.04,0.04,'right','top');
                    $graph->legend->SetColumns(1);
                    $graph->legend->SetFont(FF_DV_SANSSERIF,FS_NORMAL, 15);
                    
                    $p1->SetStartAngle(90);
                    $p1->value->SetColor('#111111');
                    $p1->value->SetFont(FF_DV_SANSSERIF,FS_NORMAL, 15);
                    // $p1->value->Show();

                    // Display the graph
                    $graph->Stroke("{$rootPath}/Grafico{$c}.png");
                    $context[] = "G_Grafico{$c}_Grafico{$c}";
                    $processed++;
            }
        }

        // foreach($questions as $q){
        //     if(in_array($q->type,['YN','SE','RA'])){
        //         echo "<h1>{$q->identifier}) {$q->options['enunciado']['E1']} {Grafico{$q->identifier}}</h1>";
        //         $graph = "{$rootPath}/Grafico{$q->identifier}.png";
        //         echo '<img src="data:image/png;base64, '.base64_encode( file_get_contents($graph)).'" >';
        //         // pj($q);
        //     }
        // }

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
        $graph->Set90AndMargin(250,30,80,30);
        
        // Create the grouped bar plot
        $gbplot = new \GroupBarPlot(array($b1plot,$b2plot));
        
        // ...and add it to the graPH
        $graph->Add($gbplot);

        $graph->xaxis->SetTickLabels($GraficoAtributos['keys']);
        $graph->xaxis->SetLabelMargin(10);
        $graph->xaxis->SetLabelAlign('right','center');
        $graph->xaxis->SetTickLabels($GraficoAtributos['keys']);

        $graph->SetBox(false);
        $graph->ygrid->SetFill(false);
        $graph->ygrid->SetColor('white');
        $graph->yaxis->SetColor('white');
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

        $graph->title->SetFont(FF_DV_SANSSERIF,FS_BOLD);
        
        // Display the graph
        $graph->Stroke("{$rootPath}/GraficoAtributos.png");
        $context[] = "G_GraficoAtributos_GraficoAtributos";

        // Grafico dimensiones
        $labels = ['CONOCIMIENTOS','HABILIDADES','ACTITUDES Y VALORES'];

        require_once (ROOT.DS.'src'.DS.'jpgraph'.DS.'src'.DS.'jpgraph.php');
        require_once (ROOT.DS.'src'.DS.'jpgraph'.DS.'src'.DS.'jpgraph_bar.php');

        // Create the graph. These two calls are always required
        $graph = new \Graph(800,600);
        $graph->SetScale("textlin");
        
        $graph->SetShadow();
        $graph->img->SetMargin(40,30,70,30);
        
        // Create the bar plots
        $b1plot = new \BarPlot($GraficoDimensiones['Usted']);
        $b2plot = new \BarPlot($GraficoDimensiones['Ideal']);
        // Create the grouped bar plot
        $gbplot = new \GroupBarPlot(array($b1plot,$b2plot));

        // ...and add it to the graPH
        $graph->Add($gbplot);

        $graph->SetBox(false);
        $graph->ygrid->SetFill(false);
        $graph->ygrid->SetColor('white');
        $graph->yaxis->SetColor('white');

        $graph->title->SetFont(FF_DV_SANSSERIF,FS_NORMAL, 15);

        $graph->xaxis->SetTickLabels($labels);
        $graph->xaxis->SetFont(FF_DV_SANSSERIF,FS_NORMAL, 10);
        $graph->legend->SetPos(0.04,0.04,'right','top');
        $graph->legend->SetFont(FF_DV_SANSSERIF,FS_NORMAL, 15);
        
        $b1plot->value->SetFormat('%01.2f');
        $b2plot->value->SetFormat('%01.2f');
        $b2plot->value->SetFont(FF_DV_SANSSERIF,FS_NORMAL, 10);
        $b1plot->value->SetFont(FF_DV_SANSSERIF,FS_NORMAL, 10);
        $b1plot->value->Show();
        $b2plot->value->Show();

        $b1plot->SetFillColor("#FF8003");
        $b1plot->SetColor("#FF8003");
        $b1plot->SetLegend('Grupo');
        $b1plot->value->SetColor("#333A42");

        $b2plot->SetFillColor("#333A42");
        $b2plot->SetColor("#333A42");
        $b2plot->SetLegend('Ideal');
        $b2plot->value->SetColor("#333A42");

        $graph->Stroke("{$rootPath}/GraficoDimensiones.png");
        $context[] = "G_GraficoDimensiones_GraficoDimensiones";

        //Grafico Madurez
        $labels = [];
        for($i = 1; $i <= 100; $i += 5){
            $labels[] = $i." - ".($i + 4);
        }

        require_once (ROOT.DS.'src'.DS.'jpgraph'.DS.'src'.DS.'jpgraph.php');
        require_once (ROOT.DS.'src'.DS.'jpgraph'.DS.'src'.DS.'jpgraph_bar.php');

        // Create the graph. These two calls are always required
        $graph = new \Graph(800,600);
        $graph->SetScale("textlin");
        
        $colors = [
            '#FF0000','#ff1400','#ff2e00','#ff5300',
            '#ff7000','#ff8d00','#ffa400','#ffbb00',
            '#ffd200','#ffe900','#ffff00','#e3f200',
            '#c1e200','#a5d500','#8fcb00','#78c000',
            '#60b500','#46a900','#239900','#008800'];
        for($i = 0; $i < 20; $i++){
            $graph->img->SetColor($colors[$i]);
            $x = 20;
            $y = 78 + ($i * 25);
            $graph->img->FilledRectangle($x,$y,$x+10,$y+10);
        }

        $graph->SetShadow();
        $count = count($GraficoMadurez['Semaforo']);
        $matriz = [];
        for($i = 0; $i < $count; $i++){
            for($j = 0; $j < $count; $j++){
                $matriz[$i][$j] = ($i == $j?$GraficoMadurez['Semaforo'][$i]:0);
            }
        }
        
        for($i = 0; $i < $count; $i++){
            // Create the bar plots
            $bplot[$i] = new \BarPlot($matriz[$i]);
        }

        $accbplot = new \AccBarPlot($bplot);
        $accbplot->SetWidth(1);

        $graph->Add($accbplot);

        $graph->SetBox(false);
        $graph->ygrid->SetFill(false);
        $graph->ygrid->SetColor('white');
        $graph->yaxis->SetColor('white');

        $graph->Set90AndMargin(100,30,70,30);        
        $graph->title->SetFont(FF_DV_SANSSERIF,FS_NORMAL, 15);
        $graph->xaxis->SetTickLabels($labels);
        $graph->xaxis->SetFont(FF_DV_SANSSERIF,FS_NORMAL, 10);

        for($i = 0; $i < $count; $i++){
            $bplot[$i]->SetWidth(1);
            $bplot[$i]->SetColor($colors[$i]);
            $bplot[$i]->SetFillColor($colors[$i]);
            $bplot[$i]->value->SetColor('#000000');
            $bplot[$i]->value->SetFont(FF_DV_SANSSERIF,FS_NORMAL, 10);
            $bplot[$i]->value->Show();
        }


        $graph->Stroke("{$rootPath}/GraficoMadurez.png");
        $context[] = "G_GraficoMadurez_GraficoMadurez";

        require_once (ROOT.DS.'src'.DS.'jpgraph'.DS.'src'.DS.'jpgraph_canvas.php');

        $g = new \CanvasGraph(800,300,'auto');
        $g->SetMargin(0,0,0,0);
        $g->InitFrame();
        
        $g->img->SetColor('#FF0000');
        $g->img->FilledRectangle(100,10,300,100);
        $g->img->SetColor('#ffe900');
        $g->img->FilledRectangle(300,10,500,100);
        $g->img->SetColor('#008800');
        $g->img->FilledRectangle(500,10,700,100);

        $txt="MADUREZ\nBAJA";
        $t = new \Text($txt,200,60);
        $t->SetFont(FF_DV_SANSSERIF,FS_BOLD,20);
        $t->SetColor('#FFFFFF');
        $t->SetMargin(0);
        $t->Align('center','center');
        $t->ParagraphAlign('center');
        $t->SetBox('#FF0000','#FF0000',false,0,0);
        $t->Stroke($g->img);

        $txt=$GraficoMadurez['Bajo']."%";
        $t = new \Text($txt,200,130);
        $t->SetFont(FF_DV_SANSSERIF,FS_BOLD,20);
        $t->SetColor('#FF0000');
        $t->SetMargin(0);
        $t->Align('center','center');
        $t->ParagraphAlign('center');
        $t->SetBox('#FFFFFF','#FFFFFF',false,0,0);
        $t->Stroke($g->img);
                
        $txt="MADUREZ\nMEDIA";
        $t = new \Text($txt,400,60);
        $t->SetFont(FF_DV_SANSSERIF,FS_BOLD,20);
        $t->SetColor('#FFFFFF');
        $t->SetMargin(0);
        $t->Align('center','center');
        $t->ParagraphAlign('center');
        $t->SetBox('#ffe900','#ffe900',false,0,0);
        $t->Stroke($g->img);

        $txt=$GraficoMadurez['Medio']."%";
        $t = new \Text($txt,400,130);
        $t->SetFont(FF_DV_SANSSERIF,FS_BOLD,20);
        $t->SetColor('#ffe900');
        $t->SetMargin(0);
        $t->Align('center','center');
        $t->ParagraphAlign('center');
        $t->SetBox('#FFFFFF','#FFFFFF',false,0,0);
        $t->Stroke($g->img);
                
        $txt="MADUREZ\nALTA";
        $t = new \Text($txt,600,60);
        $t->SetFont(FF_DV_SANSSERIF,FS_BOLD,20);
        $t->SetColor('#FFFFFF');
        $t->SetMargin(0);
        $t->Align('center','center');
        $t->ParagraphAlign('center');
        $t->SetBox('#008800','#008800',false,0,0);
        $t->Stroke($g->img);

        $txt=$GraficoMadurez['Alto']."%";
        $t = new \Text($txt,600,130);
        $t->SetFont(FF_DV_SANSSERIF,FS_BOLD,20);
        $t->SetColor('#008800');
        $t->SetMargin(0);
        $t->Align('center','center');
        $t->ParagraphAlign('center');
        $t->SetBox('#FFFFFF','#FFFFFF',false,0,0);
        $t->Stroke($g->img);
                
        $g->Stroke("{$rootPath}/GraficoSemaforo.png");
        $context[] = "G_GraficoSemaforo_GraficoSemaforo";

        // echo "<h1>Gráfico Atributos {GraficoAtributos}</h1>";
        // $graph = "{$rootPath}/GraficoAtributos.png";
        // echo '<img src="data:image/png;base64, '.base64_encode( file_get_contents($graph)).'" >';

        // echo "<h1>Gráfico Dimensiones {GraficoDimensiones}</h1>";
        // $graph = "{$rootPath}/GraficoDimensiones.png";
        // echo '<img src="data:image/png;base64, '.base64_encode( file_get_contents($graph)).'" >';

        // echo "<h1>Gráfico Madurez {GraficoMadurez}</h1>";
        // $graph = "{$rootPath}/GraficoMadurez.png";
        // echo '<img src="data:image/png;base64, '.base64_encode( file_get_contents($graph)).'" >';

        // echo "<h1>Gráfico Semaforo {GraficoSemaforo}</h1>";
        // $graph = "{$rootPath}/GraficoSemaforo.png";
        // echo '<img src="data:image/png;base64, '.base64_encode( file_get_contents($graph)).'" >';
        // exit;
        
        $parseDoc = 
        "/usr/bin/python3 ".
        ROOT.DS."src".DS."Scripts".DS."parseDocGrupal.py ".
        "\"{$sale->instrument->grupal}\" ".
        "\"{$sale->id}\" ".
        "\"{$rootPath}\" ".
        "\"{$sale->company->name} - {$sale->created->i18nformat('dd-MM-yyyy')}\" ".
        "\"".implode("\" \"",$context)."\"";

        $str = shell_exec($parseDoc);
        $file = file_get_contents("{$rootPath}/Reporte Grupal - {$sale->company->name} - {$sale->created->i18nformat('dd-MM-yyyy')}.docx");
        header("Content-type: application/ms-word-stream");
        header("Content-Disposition: attachment; filename=\"Reporte Grupal - {$sale->company->name} - {$sale->created->i18nformat('dd-MM-yyyy')}.docx\"");
        die($file);
        exit;
    }

    public function view($id = null){
            $this->set('pageHeader','<i class="fas fw fa-receipt"></i> Evaluaciones de la venta');

        require(ROOT.'/src/countries.php');

        $filters = [
            'from' => [
                'label' => 'Desde',
                'field' => 'Evaluations.started >=',
                'type' => 'date',
            ],
            'to' => [
                'label' => 'Hasta',
                'field' => 'Evaluations.started <=',
                'type' => 'date',
            ],
            'break' => [
                'type' => 'break',
            ],
        ];       
        $evaluations = TableRegistry::get('Evaluations')->find('all',[
            'contain' => [
                'Sales',
                'Instruments',
                'Companies'
            ],
        ])
        ->where("sale_id = '$id'");

        foreach ($this->request->getQuery() as $key => $value) {
            if (isset($filters[$key]) && ! empty($value)) {
                $evaluations->where([
                    $filters[$key]['field'] => $value
                ]);
            }
        }
        $evaluations = $this->paginate($evaluations);

        $this->set(compact('evaluations','countries','filters'));

    }

    public function download($id = null){
        $this->set('pageHeader','<i class="fas fw fa-file-archive"></i> Descargar evaluaciones completadas');
        
        $id = $this->request->getParam('id');

        $prog = ROOT."/tmp/files/$id.txt";
        file_put_contents($prog,"0%");
        $command = ROOT."/bin/cake download $id";
        $command = "$command > /dev/null &";
        $str = shell_exec($command);
        $this->set(compact('id'));
    }

    public function downloadword($id = null){
        $this->set('pageHeader','<i class="fas fw fa-file-archive"></i> Descargar reporte global');
        
        $id = $this->request->getParam('id');

        $prog = ROOT."/tmp/files/$id.txt";
        file_put_contents($prog,"0%");
        $command = ROOT."/bin/cake word $id";
        $command = "$command > /dev/null &";
        $str = shell_exec($command);
        $this->set(compact('id'));
    }

    public function progress(){
        $id = $this->request->getQuery('id');
        $prog = ROOT."/tmp/files/$id.txt";
        die(@file_get_contents($prog));
    }

    public function file(){
        $id = $this->request->getQuery('id');
        $prog = ROOT."/tmp/files/$id.zip";

        header('Content-Type: application/zip');
        header("Content-Disposition: attachment;filename=\"$id.zip\"");
        header('Cache-Control: max-age=0');

        die(file_get_contents($prog));
    }

    public function excel(){
        ini_set('memory_limit','500M');

        $id = $this->request->getParam('id');

        $sale = $this->Sales->get($id,[
            'contain' => [
                'Instruments',
                'Companies'
            ]
        ]);

        $questions = [];
        foreach($sale->instrument->options['sections'] as $s){
            if(isset($s['questions'])){
                $questions = array_merge($questions,TableRegistry::get('Questions')->find('all')->where('identifier in ("'.implode('","',$s['questions']).'")')->toArray());
            }
        }
        $evaluations = TableRegistry::get('Evaluations')
        ->find('all')
        ->where(["sale_id = '$id'"]);

        // $this->set(compact('sale','evaluations','questions'));
        
        $c = 'A';
        $f = 1;
        $report = [];
        //header
        $report[$f][$c++] = '#';
        $report[$f][$c++] = 'Nombres y apellidos';
        $report[$f][$c++] = 'Correo Electrónico';
        $report[$f][$c++] = 'Iniciada';
        $report[$f][$c++] = 'Completada';
        foreach($questions as $q){
            $report[1][$c++] = $q->options['enunciado']['E1'];
        }

        $f = 2;
        $candidate = 1;
        //body
        foreach($evaluations as $e){
            $c = 'A';
            $report[$f][$c++] = $candidate++;
            $report[$f][$c++] = $e->names.' '.$e->lastnames;
            $report[$f][$c++] = $e->email;
            $report[$f][$c++] = $e->started?$e->started->i18nformat('dd/MM/YYYY hh:mm a'):'';
            $report[$f][$c++] = $e->completed?$e->completed->i18nformat('dd/MM/YYYY hh:mm a'):'';
            if(!empty($e->answers)){
                $answers = new Collection($e->answers);
                foreach($questions as $q){
                    $filter = $answers->filter(function ($value, $key, $iterator) use ($q) {
                        return $value['question'] == $q->identifier;
                    })->first();
                    $report[$f][$c++] = !empty($filter['answer']) 
                        ? (
                            $q->type == 'DT' 
                            ? date('d/m/Y',strtotime($filter['answer']))
                            : $filter['answer']
                        ) 
                        : "";
                }
            }
            $f++;
        }
        
        $this->autoRender = false;
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $writer = new Xls($spreadsheet);

        foreach($report as $rc => $r){
            foreach($r as $cc=> $c){
                $sheet->setCellValue($cc.$rc, $c);
            }
        }

        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=\"Reporte {$sale->company->name}.xls\"");
        header('Cache-Control: max-age=0');
        $writer->save('php://output');

    }
    
    public function word(){
        ini_set('memory_limit','500M');
        set_time_limit ( 300 ) ;

        $id = $this->request->getParam('id');

        $sale = $this->Sales->get($id,[
            'contain' => [
                'Instruments',
                'Companies'
            ]
        ]);

        $questions = [];
        foreach($sale->instrument->options['sections'] as $s){
            if(isset($s['questions'])){
                $questions = array_merge($questions,TableRegistry::get('Questions')->find('all')->where('identifier in ("'.implode('","',$s['questions']).'")')->toArray());
            }
        }
        //dd($questions);

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
        // dd($report);
        $f = 2;
        $candidate = 1;
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
                }
            }
        }
        
        $rootPath = ROOT."/tmp/files/sales/$id";
        $docFile = "{$rootPath}/Reporte {$sale->company->name}.docx";

        if(!file_exists($rootPath)){ 
            mkdir($rootPath, 0777, true);
        }

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
                    
                    $graph->title->SetFont(FF_DV_SANSSERIF,FS_BOLD);
                    
                    // $graph->xaxis->SetTickLabels($labels);
                    $graph->legend->SetPos(0.04,0.04,'right','top');
                    $graph->legend->SetColumns(3);

                    // $bplot->value->SetFormat('%01.2f');
                    // $bplot->value->Show();

                    // $bplot->SetFillColor("#FF8003");
                    // $bplot->SetColor("#FF8003");
                    // $bplot->SetLegend('Usted');
                    // $bplot->value->SetColor("#333A42");

                    // Display the graph
                    // $graph->Stroke("{$rootPath}/Grafico{$c}.png");
                    if($c == 'genero'){
                        $graph->Stroke();
                    }

            }
        }
        // dd($reporte);
    }
    
    public function add(){
        $sale = $this->Sales->newEmptyEntity();
        if ($this->request->is('post')) {
            $sale = $this->Sales->patchEntity($sale, $this->request->getData());
            if ($this->Sales->save($sale)) {
                $this->Flash->success(__('The sale has been saved.'));

                return $this->redirect(['action' => 'edit',$sale->id]);
            }
            $this->Flash->error(__('The sale could not be saved. Please, try again.'));
        }
        $companies = $this->Sales->Companies->find('list');
        $instruments = $this->Sales->Instruments->find('list');
        require(ROOT.'/src/countries.php');
        $this->set(compact('sale','companies','countries','instruments'));
    }
    
    public function edit($id = null){
        $sale = $this->Sales->get($id, [
            'contain' => [
                'Companies',
                'Instruments'
            ],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $sale = $this->Sales->patchEntity($sale, $data);
            if ($this->Sales->save($sale)) {
                $this->Flash->success(__('The sale has been saved.'));

                return $this->redirect(['action' => 'edit',$sale->id]);
            }
            $this->Flash->error(__('The sale could not be saved. Please, try again.'));
        }
        $companies = $this->Sales->Companies->find('list');
        $instruments = $this->Sales->Instruments->find('list');
        require(ROOT.'/src/countries.php');
        $this->set(compact('sale','companies','countries','instruments'));

    }

    public function delete($id = null){
        $this->request->allowMethod(['post', 'delete']);
        $sale = $this->Sales->get($id);
        if ($this->Sales->delete($sale)) {
            $this->Flash->success(__('The sale has been deleted.'));
        } else {
            $this->Flash->error(__('The sale could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
