<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Event\EventInterface;

/**
 * Questions Controller
 *
 * @property \App\Model\Table\QuestionsTable $Questions
 * @method \App\Model\Entity\Question[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class QuestionsController extends AppController
{
    
    public function beforefilter(EventInterface $event)
    {
        $this->set('pageHeader','<i class="fas fw fa-question"></i> Preguntas');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $questions = $this->paginate($this->Questions);

        $this->set(compact('questions'));
    }
    public function excel()
    {
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $file = TMP . DS . "excel.xls";
            $data['file']->moveto($file);
            $inputFileType = 'Xlsx';
            $inputFileName = $file;

            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
            $reader->setReadDataOnly(true);
            $data = $reader->load($inputFileName)->getActiveSheet()->toArray();
            $i = 0;
            $updated = 0;
            $new = 0;
            foreach($data as $d){
                if($i > 0){
                    $question = $this->Questions->findByIdentifierAndLanguaje($d[0],$d[1])->first();
                    //dd($question->toArray(),$d[0],$d[1]);
                    if(!empty($question)){
                        $updated++;
                        $question = $this->Questions->get($question->id);
                    }else{
                        $new++;
                        $question = $this->Questions->newEmptyEntity();
                    }
                    $options = [
                        'enunciado' => [
                            'E1' => $d[5],
                            'E2' => $d[6],
                            'E3' => $d[7],
                        ],
                        'languaje' => $d[1],
                        'categories' => $d[4],
                        'required' => $d[3],
                    ];

                    $question = $this->Questions->patchEntity($question, [
                        'options' => $options,
                        'type' => $d[2],
                        'identifier' => $d[0]
                    ]);
                    if (!$this->Questions->save($question)) {
                        dd($question->getErrors());
                    }
                }
                $i++;
            }
            $this->Flash->success(__("Se ha procesado el archivo exitosamente.Resultado: $new preguntas nuevas, $updated modificadas"));
        }
    }

    /**
     * View method
     *
     * @param string|null $id Question id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $question = $this->Questions->get($id, [
            'contain' => ['Answers', 'SelectedQuestions'],
        ]);

        $this->set(compact('question'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $question = $this->Questions->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['options'] = json_encode($data['options']);
            $question = $this->Questions->patchEntity($question, $data);
            if ($this->Questions->save($question)) {
                $this->Flash->success(__('The question has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question could not be saved. Please, try again.'));
        }
        $this->set(compact('question'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Question id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $question = $this->Questions->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            //$data['options'] = json_encode($data['options']);
            $question = $this->Questions->patchEntity($question, $data);
            //dd($question);
            if ($this->Questions->save($question)) {
                $this->Flash->success(__('The question has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            // dd($question);
            $this->Flash->error(__('The question could not be saved. Please, try again.'));
        }
        $this->set(compact('question'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Question id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $question = $this->Questions->get($id);
        if ($this->Questions->delete($question)) {
            $this->Flash->success(__('The question has been deleted.'));
        } else {
            $this->Flash->error(__('The question could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
