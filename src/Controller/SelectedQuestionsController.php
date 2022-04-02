<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * SelectedQuestions Controller
 *
 * @property \App\Model\Table\SelectedQuestionsTable $SelectedQuestions
 * @method \App\Model\Entity\SelectedQuestion[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SelectedQuestionsController extends AppController
{
    public function beforefilter(EventInterface $event)
    {
        $this->set('pageHeader','Scripts');
    }
    /**
     * Index
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Sections', 'Questions'],
        ];
        $selectedQuestions = $this->paginate($this->SelectedQuestions);

        $this->set(compact('selectedQuestions'));
    }

    /**
     * View method
     *
     * @param string|null $id Selected Question id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $selectedQuestion = $this->SelectedQuestions->get($id, [
            'contain' => ['Sections', 'Questions', 'Answers'],
        ]);

        $this->set(compact('selectedQuestion'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $selectedQuestion = $this->SelectedQuestions->newEmptyEntity();
        if ($this->request->is('post')) {
            $selectedQuestion = $this->SelectedQuestions->patchEntity($selectedQuestion, $this->request->getData());
            if ($this->SelectedQuestions->save($selectedQuestion)) {
                $this->Flash->success(__('The selected question has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The selected question could not be saved. Please, try again.'));
        }
        $sections = $this->SelectedQuestions->Sections->find('list', ['limit' => 200]);
        $questions = $this->SelectedQuestions->Questions->find('list', ['limit' => 200]);
        $this->set(compact('selectedQuestion', 'sections', 'questions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Selected Question id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $selectedQuestion = $this->SelectedQuestions->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $selectedQuestion = $this->SelectedQuestions->patchEntity($selectedQuestion, $this->request->getData());
            if ($this->SelectedQuestions->save($selectedQuestion)) {
                $this->Flash->success(__('The selected question has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The selected question could not be saved. Please, try again.'));
        }
        $sections = $this->SelectedQuestions->Sections->find('list', ['limit' => 200]);
        $questions = $this->SelectedQuestions->Questions->find('list', ['limit' => 200]);
        $this->set(compact('selectedQuestion', 'sections', 'questions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Selected Question id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $selectedQuestion = $this->SelectedQuestions->get($id);
        if ($this->SelectedQuestions->delete($selectedQuestion)) {
            $this->Flash->success(__('The selected question has been deleted.'));
        } else {
            $this->Flash->error(__('The selected question could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
