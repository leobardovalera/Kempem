<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Event\EventInterface;
use Cake\ORM\TableRegistry;
use Cake\Collection\Collection;
use Cake\I18n\FrozenTime;
use Cake\Mailer\Mailer;
use Cake\I18n\Time;
use Gears\Pdf;
use Gears\Pdf\Docx\Converter\Unoconv;
use Icecave\Parity\Parity;

/**
 * Evaluations Controller
 *
 * @property \App\Model\Table\EvaluationsTable $Evaluations
 * @method \App\Model\Entity\Evaluation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EvaluationsController extends AppController
{
    public function beforefilter(EventInterface $event){
        $this->set('pageHeader','<i class="fas fw fa-thermometer-half"></i> Aplicaciones');
    }
    
    public function index(){

        $config = $this->paginate = [
            'sortableFields' => [
                'Evaluations.names',
                'Companies.name',
                'Instruments.lastnames',
                'Instruments.name',
                'Sales.id',
                'Sales.country',
            ],
        ];

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
            'companies' => [
                'label' => 'Empresas',
                'field' => 'Evaluations.company_id = ',
                'type' => 'select',
                'options' => TableRegistry::get('Companies')->find('list',[
                    'keyField' => 'id',
                    'valueField' => 'name'
                ])->order('name')->toArray(),
            ],
            'instrumentos' => [
                'label' => 'Instrumentos',
                'field' => 'Evaluations.instrument_id = ',
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
                    
        $evaluations = $this->Evaluations->find('all',[
            'contain' => [
                'Sales',
                'Instruments',
                'Companies'
            ],
        ]);

        foreach ($this->request->getQuery() as $key => $value) {
            if (isset($filters[$key]) && ! empty($value)) {
                $evaluations->where([
                    $filters[$key]['field'] => $value
                ]);
            }
        }

        if(isset($this->user) && $this->user->role != 'superadmin'){
            $evaluations = $evaluations->where('Evaluations.company_id = '.$this->user->company_id);
        }
        // dd($evaluations->sql());
        $evaluations = $this->paginate($evaluations);

        $this->set(compact('evaluations','countries','filters'));
    }

    public function testword() {

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $filename = $data['file']->getClientFilename();
            $tmpname = TMP.DS.'files'.DS.$filename;
            $data['file']->moveTo($tmpname);

            $command = "/usr/bin/python3 ".ROOT.DS."src".DS."Scripts".DS."parseDoc.py ".$tmpname." ".$filename;
            exec($command);
            $file = ROOT.DS."src".DS."Scripts".DS."myvar-output.docx";
            

            header('Content-Type: application/word');
            header('Content-disposition: attachment; filename="'.$filename.'"');
            header('Cache-Control: max-age=0');
            die(file_get_contents($file));
            
        }
    }
    
    public function view($id = null){
        $evaluation = $this->Evaluations->get($id, [
            'contain' => [
                'Instruments', 
                'Instruments.Scripts', 
            ],
        ]);

        $this->set(compact('evaluation'));
    }
    
    public function reset($id = null){
        if ($this->request->is(['patch', 'post', 'put'])) {
            $evaluation = $this->Evaluations->get($id);
            $evaluation = $this->Evaluations->patchEntity($evaluation, [
                'results' => null,
                'answers' => null,
                'processed' => null,
                'anulado' => null,
                'started' => null,
                'completed' => null,
            ]);
            if ($this->Evaluations->save($evaluation)) {
                $this->Flash->success(__('Se ha reseteado la evaluación exitosamente'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Hubo un error, por favor intente nuevamente'));
        }
    }

    public function respuestas(){
        $id = $this->request->getParam('id');
        $evaluation = $this->Evaluations->get($id, [
            'contain' => [
                'Instruments', 
            ],
        ]);
        if(!empty($evaluation->answers)){
            // debug($evaluation->answers);
            $answers = new Collection($evaluation->answers);
            $questions = new Collection(TableRegistry::get('Questions')->find('all'));
            foreach($evaluation->instrument->options['sections'] as $c => $s){
                if(isset($s['questions'])){
                    foreach($s['questions'] as $k => $q){
                        $answer = $answers->filter(function ($value, $key, $iterator) use ($q) {
                            return $value['question'] == $q;
                        })->first();
                        $answer['question'] = $q;
                        $question = $questions->filter(function ($value, $key, $iterator) use ($q) {
                            return $value->identifier == $q;
                        })->first();
                        $answer['enunciado'] = $question->options['enunciado']['E'.(isset($answer['version'])?$answer['version']:1)];
                        $answer['type'] = $question->type;
                        $answer['languaje'] = $question->languaje;
                        $evaluation->instrument->options['sections'][$c]['questions'][$k] = $answer;
                        // debug($evaluation->instrument->options['sections'][$c]['questions'][$k]);
                    }
                }
            }
        }
        $this->set(compact('evaluation'));
    }

    public function send(){
        $id = $this->request->getParam('id');
        $evaluation = $this->Evaluations->get($id, [
            'contain' => [
                'Instruments',
            ],
        ]);

        if(!$evaluation->sended){
            $evaluation->sended = FrozenTime::now();
            $this->Evaluations->save($evaluation);
        }

        $mailer = new Mailer();
        $mailer
                    ->setEmailFormat('html')
                    ->setTo($evaluation->email)
                    ->setFrom(['info@kempem.com'=> 'Kempem'])
                    ->setSubject('Intrumento Kempem')
                    ->setViewVars(['evaluation' => $evaluation])
                    ->viewBuilder()
                        ->setTemplate('evaluation');


        $mailer->deliver();
        
        $this->Flash->success(__('Se ha enviado el correo exitosamente'));

        return $this->redirect(['action' => 'view',$evaluation->id]);
    }

    public function externo(){
        if ($this->request->is('post')) {

            $data = $this->request->getData();

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query([
                'secret' => '6LfLTqYaAAAAADcGdRHxqZw1ML9cx3Id_IfBLMVr',
                'response' => @$data['g-recaptcha-response']
            ]));

            $response = curl_exec($curl);
            $response = json_decode($response, true);

            if ($response['success'] === false) {

                $this->Flash->error(__('Error de identificación de usuario'));
                return $this->redirect(['action' => 'externo']);

            }

            $sale = TableRegistry::get('Sales')->find('all',[
                'contain' => [
                    'Evaluations'
                ]
            ])
            ->where('upper(substring(id,-8,8)) = "'.strtoupper(trim($data['code'])).'"')->first();
            $time = FrozenTime::now();

            if($sale->max_date < $time){
                $this->Flash->error(__('El tiempo para realizar el cuestionario ha expirado, comuníquese con asistencia al usuario'));
                return $this->redirect(['action' => 'externo']);
            }

            if(is_null($sale)){
                $this->Flash->error(__('Código de instrumento inválido, comuníquese con asistencia al usuario'));
                return $this->redirect(['action' => 'externo']);
            }

            $evaluation = $this->Evaluations->find('all')
            ->where([
                'sale_id' => $sale->id,
                'email' => $data['email'],
            ])->first();

            if($evaluation == null){
                if($sale->instruments - count($sale->evaluations) <= 0){
                    $this->Flash->error(__('No es posible iniciar el instrumento, comuníquese con asistencia al usuario'));
                    return $this->redirect(['action' => 'externo']);
                }
                $evaluation = $this->Evaluations->newEmptyEntity();
                $evaluation = $this->Evaluations->patchEntity($evaluation, [
                    'company_id' => $sale->company_id,
                    'sale_id' => $sale->id,
                    'email' => $data['email'],
                    'names' => $data['names'],
                    'lastnames' => $data['lastnames'],
                    'instrument_id' => $sale->instrument_id,
                ]);
                
                if (!$this->Evaluations->save($evaluation)) {
                    $this->Flash->error(__('Ha ocurrido un error por favor intente nuevamente'));
                    return $this->redirect(['action' => 'externo']);
                }
            }
            return $this->redirect('/evaluacion/'.$evaluation->id);
        }
    }

    public function ejecutar(){
        $id = $this->request->getParam('id');
        $evaluation = $this->Evaluations->get($id, [
            'contain' => [
                'Instruments',
            ],
        ]);
        if(!$evaluation->started){
            $evaluation->started = FrozenTime::now();
            $this->Evaluations->save($evaluation);
        }
        $completado = true;
        if(!empty($evaluation->answers)){
            // debug($evaluation->answers);
            $answers = new Collection($evaluation->answers);
            foreach($evaluation->instrument->options['sections'] as $s){
                if(isset($s['questions'])){
                    foreach($s['questions'] as $q){
                        // debug($q);
                        $filter = $answers->filter(function ($value, $key, $iterator) use ($q) {
                            return $value['question'] == $q;
                        });
                        // debug($filter);
                        $completado = $completado && ($filter->count() > 0);
                    }
                }
            }
            // dd($completado);
            // if($completado){
            //     return $this->redirect('/resultados/'.$evaluation->id);
            // }
        }
        $questions =  TableRegistry::get('Questions')->find('all');
        $this->set(compact('evaluation','questions'));
    }

    public function resultados(){
        $id = $this->request->getParam('id');

        $evaluation = $this->Evaluations->get($id, [
            'contain' => [
                'Instruments',
            ],
        ]);
        $time = Time::now();

        $evaluation = $this->Evaluations->patchEntity($evaluation, [
            'completed' => $time
        ]);
        $this->Evaluations->save($evaluation);
    }

    public function finalizado(){
        $id = $this->request->getParam('id');
        $evaluation = $this->Evaluations->get($id);
        $evaluation = $this->Evaluations->patchEntity($evaluation, [
            'anulado' => Time::now()
        ]);
        $this->Evaluations->save($evaluation);
    }

    public function process(){
        $id = $this->request->getParam('id');

        $evaluation = $this->Evaluations->get($id, [
            'contain' => [
                'Instruments',
                'Sales',
                'Sales.Companies',
                'Instruments.Scripts',
            ],
        ]);

        // dd($evaluation->sale->company->name);
        $input = sprintf($evaluation->instrument->script->in_file,$id);
        $output = sprintf($evaluation->instrument->script->out_file,$id);
        $command = sprintf($evaluation->instrument->script->command,$id);
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
        $evaluation->completed = Time::now();
        $evaluation->results = file_get_contents($output);
        $this->Evaluations->save($evaluation);

        exit;
    }

    public function reporte(){
        $id = $this->request->getParam('id');

        $evaluation = $this->Evaluations->get($id, [
            'contain' => [
                'Instruments',
                'Sales',
                'Sales.Companies',
                'Instruments.Scripts',
            ],
        ]);
        // dd($evaluation);
        $input = sprintf($evaluation->instrument->script->in_file,$id);
        $output = sprintf($evaluation->instrument->script->out_file,$id);
        $command = sprintf($evaluation->instrument->script->command,$id);
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
        $this->Evaluations->save($evaluation);

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
	  // Done by Leo. Erase if it is wrong
      if ($evaluation->instrument->name == "Competencia emprendedora"){
          $CakePdf->template('reporte_spanish');
      } else {
            $CakePdf->template('reporte_english');
        }

        $CakePdf->viewVars([
            'evaluation' => $evaluation,
            'grafico' => $grafico,
        ]);

        header('Content-Type: application/pdf');
        header('Cache-Control: max-age=0');
        echo $CakePdf->output();
        exit;
    }

    public function graph1(){
        $id = $this->request->getParam('id');
        $output = ROOT.DS.'src'.DS.'Scripts'.DS.'files'.DS.$id.'_output.csv';
        $data = explode("\n",file_get_contents($output));
        foreach($data as $k => $c){
            if(strpos($c,":") > 0){
                $data[$k] = explode(":",$c);
            }else{
                $data[$k] = explode(",",$c);
            }
        }

        $grafico['Usted'] = [
            $data[0][1],
            $data[2][1],
            $data[4][1],
        ];
        $grafico['Ideal'] = [
            $data[1][1],
            $data[3][1],
            $data[5][1],
        ];
        $labels = ['CONOCIMIENTOS','HABILIDADES','ACTITUDES Y VALORES'];

        require_once (ROOT.DS.'src'.DS.'jpgraph'.DS.'src'.DS.'jpgraph.php');
        require_once (ROOT.DS.'src'.DS.'jpgraph'.DS.'src'.DS.'jpgraph_bar.php');

        // Create the graph. These two calls are always required
        $graph = new \Graph(800,600);
        $graph->SetScale("textlin");
        
        $graph->SetShadow();
        $graph->img->SetMargin(40,30,70,30);
        
        // Create the bar plots
        $b1plot = new \BarPlot($grafico['Usted']);
        $b2plot = new \BarPlot($grafico['Ideal']);
        // Create the grouped bar plot
        $gbplot = new \GroupBarPlot(array($b1plot,$b2plot));

        // ...and add it to the graPH
        $graph->Add($gbplot);
        
        $graph->title->SetFont(FF_FONT1,FS_BOLD);

        $graph->xaxis->SetTickLabels($labels);

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

        // Display the graph
        $graph->Stroke();

        exit;
    }

    public function graph2(){
        $id = $this->request->getParam('id');
        $output = ROOT.DS.'src'.DS.'Scripts'.DS.'files'.DS.$id.'_output.csv';
        $data = explode("\n",file_get_contents($output));
        foreach($data as $k => $c){
            if(strpos($c,":") > 0){
                $data[$k] = explode(":",$c);
            }else{
                $data[$k] = explode(",",$c);
            }
        }
        $grafico = [];
        
        for($i = 7; $i<=26;$i++){
            $labels[] = $data[$i][0];
            $grafico['Usted'][] = $data[$i][2];
            $grafico['Ideal'][] = $data[$i][1];
        }

        require_once (ROOT.DS.'src'.DS.'jpgraph'.DS.'src'.DS.'jpgraph.php');
        require_once (ROOT.DS.'src'.DS.'jpgraph'.DS.'src'.DS.'jpgraph_bar.php');

        // Create the graph. These two calls are always required
        $graph = new \Graph(700,900);
        $graph->SetScale("textlin");
        
        $graph->SetShadow();
        $graph->img->SetMargin(40,30,20,40);
        
        // Create the bar plots
        $b1plot = new \BarPlot($grafico['Usted']);
        $b2plot = new \BarPlot($grafico['Ideal']);
        
        // Create the grouped bar plot
        $gbplot = new \GroupBarPlot(array($b1plot,$b2plot));
        
        // ...and add it to the graPH
        $graph->Add($gbplot);

        $graph->Set90AndMargin(250,30,80,30);

        $graph->xaxis->SetTickLabels($labels);
        $graph->xaxis->SetLabelMargin(10);
        $graph->xaxis->SetLabelAlign('right','center');
        $graph->xaxis->SetTickLabels($labels);

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

        $graph->title->SetFont(FF_FONT1,FS_BOLD);
        
        // Display the graph
        $graph->Stroke();

        exit;
    }

    public function graph3(){
        $id = $this->request->getParam('id');
        $output = ROOT.DS.'src'.DS.'Scripts'.DS.'files'.DS.$id.'_output.csv';
        $data = explode("\n",file_get_contents($output));
        foreach($data as $k => $c){
            if(strpos($c,":") > 0){
                $data[$k] = explode(":",$c);
            }else{
                $data[$k] = explode(",",$c);
            }
        }
        $grafico = [$data[6][1]];

        require_once (ROOT.DS.'src'.DS.'jpgraph'.DS.'src'.DS.'jpgraph.php');
        require_once (ROOT.DS.'src'.DS.'jpgraph'.DS.'src'.DS.'jpgraph_bar.php');

        // Create the graph. These two calls are always required
        $graph = new \Graph(500,200);
        $graph->SetScale("textlin");
        
        $graph->SetShadow();
        $graph->img->SetMargin(40,30,20,40);
        
        // Create the bar plots
        $b1plot = new \BarPlot($grafico);
        
        // ...and add it to the graPH
        $graph->Add($b1plot);

        $graph->Set90AndMargin(30,30,70,30);

        $graph->xaxis->hide();
        $graph->legend->hide();

        $b1plot->value->SetFormat('%01.2f');
        $b1plot->value->Show();
        $b1plot->value->SetFont(FF_DV_SANSSERIF,FS_NORMAL, 15);
        $b1plot->value->SetColor("#ffffff");
        $b1plot->SetFillColor('black@1');
        $b1plot->SetColor('black@1');

        $graph->title->SetFont(FF_FONT1,FS_BOLD);
        $graph->SetScale('textlin',0,100);
        $graph->yaxis->scale->ticks->Set(10);
        $graph->ygrid->SetFill(false);
        $graph->xgrid->SetFill(false);
        $graph->xaxis->SetColor('white');
        $graph->SetFrame(false);
        $graph->SetBox(false);

        $graph->SetBackgroundImage(ROOT.DS.'src'.DS.'Scripts'.DS.'termometro.jpg',BGIMG_FILLPLOT);
        // $graph->SetBackgroundImageMix(25);

        // Display the graph
        $graph->Stroke();

        exit;
    }

    public function answer(){
        $data = $this->request->getData();
        $evaluation = $this->Evaluations->get($data['evaluation']);
        $evaluation = $this->Evaluations->patchEntity($evaluation,[
            'answers' => $data['answers']
        ]);
        $this->Evaluations->save($evaluation);

        $this->autoRender = false;
    }
    
    public function add(){
        $evaluation = $this->Evaluations->newEmptyEntity();
        if ($this->request->is('post')) {
            $evaluation = $this->Evaluations->patchEntity($evaluation, $this->request->getData());
            if ($this->Evaluations->save($evaluation)) {
                $this->Flash->success(__('The evaluation has been saved.'));

                return $this->redirect(['action' => 'view',$evaluation->id]);
            }
            $this->Flash->error(__('The evaluation could not be saved. Please, try again.'));
        }
        $instruments = $this->Evaluations->Instruments->find('list');
        $companies = $this->Evaluations->Companies->find('list');
        $sales = $this->Evaluations->Sales->find('list',[
            'keyField' => 'id',
            'valueField' => function ($sales) {
                return $sales->id.' - '.$sales->created->i18nformat('dd/mm/yyyy').' - '.$sales->instruments;
            }
        ]);
        $this->set(compact('evaluation', 'instruments', 'companies', 'sales'));
    }
    
    public function edit($id = null){
        $evaluation = $this->Evaluations->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $evaluation = $this->Evaluations->patchEntity($evaluation, $this->request->getData());
            if ($this->Evaluations->save($evaluation)) {
                $this->Flash->success(__('The evaluation has been saved.'));

                return $this->redirect(['action' => 'view',$evaluation->id]);
            }
            $this->Flash->error(__('The evaluation could not be saved. Please, try again.'));
        }
        $instruments = $this->Evaluations->Instruments->find('list');
        $companies = $this->Evaluations->Companies->find('list');
        $sales = $this->Evaluations->Sales->find('list',[
            'keyField' => 'id',
            'valueField' => function ($sales) {
                return $sales->id.' - '.$sales->created->i18nformat('dd/mm/yyyy').' - '.$sales->instruments;
            }
        ]);
        $this->set(compact('evaluation', 'instruments', 'companies', 'sales'));
    }
    
    public function delete($id = null){
        $this->request->allowMethod(['post', 'delete']);
        $evaluation = $this->Evaluations->get($id);
        if ($this->Evaluations->delete($evaluation)) {
            $this->Flash->success(__('The evaluation has been deleted.'));
        } else {
            $this->Flash->error(__('The evaluation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
