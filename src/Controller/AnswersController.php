<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Answers Controller
 *
 * @property \App\Model\Table\AnswersTable $Answers
 * @method \App\Model\Entity\Answer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AnswersController extends AppController
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
            'contain' => ['Instruments', 'Users', 'Questions', 'Sections', 'Evaluations', 'SelectedQuestions'],
        ];
        $answers = $this->paginate($this->Answers);

        $this->set(compact('answers'));
    }

    /**
     * View method
     *
     * @param string|null $id Answer id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $answer = $this->Answers->get($id, [
            'contain' => ['Instruments', 'Users', 'Questions', 'Sections', 'Evaluations', 'SelectedQuestions'],
        ]);

        $this->set(compact('answer'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $answer = $this->Answers->newEmptyEntity();
        if ($this->request->is('post')) {
            $answer = $this->Answers->patchEntity($answer, $this->request->getData());
            if ($this->Answers->save($answer)) {
                $this->Flash->success(__('The answer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The answer could not be saved. Please, try again.'));
        }
        $instruments = $this->Answers->Instruments->find('list', ['limit' => 200]);
        $users = $this->Answers->Users->find('list', ['limit' => 200]);
        $questions = $this->Answers->Questions->find('list', ['limit' => 200]);
        $sections = $this->Answers->Sections->find('list', ['limit' => 200]);
        $evaluations = $this->Answers->Evaluations->find('list', ['limit' => 200]);
        $selectedQuestions = $this->Answers->SelectedQuestions->find('list', ['limit' => 200]);
        $this->set(compact('answer', 'instruments', 'users', 'questions', 'sections', 'evaluations', 'selectedQuestions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Answer id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $answer = $this->Answers->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $answer = $this->Answers->patchEntity($answer, $this->request->getData());
            if ($this->Answers->save($answer)) {
                $this->Flash->success(__('The answer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The answer could not be saved. Please, try again.'));
        }
        $instruments = $this->Answers->Instruments->find('list', ['limit' => 200]);
        $users = $this->Answers->Users->find('list', ['limit' => 200]);
        $questions = $this->Answers->Questions->find('list', ['limit' => 200]);
        $sections = $this->Answers->Sections->find('list', ['limit' => 200]);
        $evaluations = $this->Answers->Evaluations->find('list', ['limit' => 200]);
        $selectedQuestions = $this->Answers->SelectedQuestions->find('list', ['limit' => 200]);
        $this->set(compact('answer', 'instruments', 'users', 'questions', 'sections', 'evaluations', 'selectedQuestions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Answer id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $answer = $this->Answers->get($id);
        if ($this->Answers->delete($answer)) {
            $this->Flash->success(__('The answer has been deleted.'));
        } else {
            $this->Flash->error(__('The answer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
