<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Core\Configure;
use Cake\Event\EventInterface;
use Cake\ORM\TableRegistry;

/**
 * Companies Controller
 *
 * @property \App\Model\Table\CompaniesTable $companies
 * @method \App\Model\Entity\company[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CompaniesController extends AppController
{
    public function beforefilter(EventInterface $event)
    {
        $this->set('pageHeader','<i class="fas fw fa-building"></i> Clientes');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => [
                'Access'
            ],
        ];
        $companies = $this->paginate($this->Companies);

        $this->set(compact('companies'));
    }

    /**
     * View method
     *
     * @param string|null $id company id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $company = $this->Companies->get($id, [
            'contain' => [
                'Access'
            ],
        ]);

    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $company = $this->Companies->newEmptyEntity();
        if ($this->request->is('post')) {
            $company = $this->Companies->patchEntity($company, $this->request->getData());
            if ($this->Companies->save($company)) {
                $this->Flash->success(__('The company has been saved.'));

                return $this->redirect(['action' => 'edit',$company->id]);
            }
            $this->Flash->error(__('The company could not be saved. Please, try again.'));
        }
        $users = $this->Companies->Access->find('list',[
            'keyField' => 'id',
            'valueField' => function ($access) {
                return $access->first_name.' '.$access->last_name.' - '.$access->role;
            }
        ]);
        $this->set(compact('company','users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id company id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $company = $this->Companies->get($id, [
            'contain' => [
                'Access'
            ],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $company = $this->Companies->patchEntity($company, $data);
            if ($this->Companies->save($company)) {
                $this->Flash->success(__('The company has been saved.'));

                return $this->redirect(['action' => 'edit',$company->id]);
            }
            $this->Flash->error(__('The company could not be saved. Please, try again.'));
        }
        $users = $this->Companies->Access->find('list',[
            'keyField' => 'id',
            'valueField' => function ($access) {
                return $access->first_name.' '.$access->last_name.' - '.$this->roles[$access->role];
            }
        ]);

        $selectedUsers = [];
        if(!empty($company->access)) foreach($company->access as $u){
            $selectedUsers[] = $u->id;
        }

        $this->set(compact('company','users','selectedUsers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id company id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $company = $this->Companies->get($id);
        if ($this->Companies->delete($company)) {
            $this->Flash->success(__('The company has been deleted.'));
        } else {
            $this->Flash->error(__('The company could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
