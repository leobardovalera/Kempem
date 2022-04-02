<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Core\Configure;
use Cake\Event\EventInterface;
use Cake\ORM\TableRegistry;

/**
 * Instruments Controller
 *
 * @property \App\Model\Table\InstrumentsTable $Instruments
 * @method \App\Model\Entity\Instrument[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InstrumentsController extends AppController
{
    public function beforefilter(EventInterface $event)
    {
        $this->set('pageHeader','<i class="fas fw fa-thermometer"></i> Instrumentos');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Scripts'],
        ];
        $instruments = $this->paginate($this->Instruments);

        $this->set(compact('instruments'));
    }

    /**
     * View method
     *
     * @param string|null $id Instrument id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $instrument = $this->Instruments->get($id, [
            'contain' => ['Scripts','Evaluations'],
        ]);
        $questions =  TableRegistry::get('Questions')->find('all');
        $this->set(compact('instrument', 'questions'));

    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $instrument = $this->Instruments->newEmptyEntity();
        if ($this->request->is('post')) {
            $instrument = $this->Instruments->patchEntity($instrument, $this->request->getData());
            if ($this->Instruments->save($instrument)) {
                $this->Flash->success(__('The instrument has been saved.'));

                return $this->redirect(['action' => 'edit',$instrument->id]);
            }
            $this->Flash->error(__('The instrument could not be saved. Please, try again.'));
        }
        $scripts = $this->Instruments->Scripts->find('list', ['limit' => 200]);
        $languages = Configure::read('Languages');;
        $this->set(compact('instrument', 'scripts', 'languages'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function files($id = null)
    {
        $instrument = $this->Instruments->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $scriptsFolder = ROOT.DS.'src'.DS.'Scripts'.DS.'instruments'.DS.$id;
            if (!file_exists($scriptsFolder)) {
                mkdir($scriptsFolder, 0777, true);
            }
            $instruments = [];
            if(!$data['grupal']->getError()){
                $grupal = $scriptsFolder.DS.'grupal.docx';
                $data['grupal']->moveTo($grupal);
                $instruments['grupal'] = $grupal;
            }

            $instrument = $this->Instruments->patchEntity($instrument, $instruments);
            if ($this->Instruments->save($instrument)) {
                $this->Flash->success(__('The instrument has been saved.'));

                return $this->redirect(['action' => 'files',$instrument->id]);
            }
            $this->Flash->error(__('The instrument could not be saved. Please, try again.'));
        }
        $this->set(compact('instrument'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Instrument id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $instrument = $this->Instruments->get($id, [
            'contain' => [
            ],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $instrument = $this->Instruments->patchEntity($instrument, $data);
            if ($this->Instruments->save($instrument)) {
                $this->Flash->success(__('The instrument has been saved.'));

                return $this->redirect(['action' => 'edit',$instrument->id]);
            }
            $this->Flash->error(__('The instrument could not be saved. Please, try again.'));
        }
        $scripts = $this->Instruments->Scripts->find('list', ['limit' => 200]);
        $questions =  TableRegistry::get('Questions')->find('all');
        $this->set(compact('instrument', 'scripts', 'questions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Instrument id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $instrument = $this->Instruments->get($id);
        if ($this->Instruments->delete($instrument)) {
            $this->Flash->success(__('The instrument has been deleted.'));
        } else {
            $this->Flash->error(__('The instrument could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
