<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Answer $answer
 * @var \App\Model\Entity\Instrument[]|\Cake\Collection\CollectionInterface $instruments
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 * @var \App\Model\Entity\Question[]|\Cake\Collection\CollectionInterface $questions
 * @var \App\Model\Entity\Section[]|\Cake\Collection\CollectionInterface $sections
 * @var \App\Model\Entity\Evaluation[]|\Cake\Collection\CollectionInterface $evaluations
 * @var \App\Model\Entity\SelectedQuestion[]|\Cake\Collection\CollectionInterface $selectedQuestions
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Form->postLink(__('<i class="fas fw fa-trash"></i> '), ['action' => 'delete', $answer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $answer->id), 'class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Listar Answers'), ['action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Listar Instruments'), ['controller' => 'Instruments', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Nuevo Instrument'), ['controller' => 'Instruments', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Listar Users'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Nuevo User'), ['controller' => 'Users', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Listar Questions'), ['controller' => 'Questions', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Nuevo Question'), ['controller' => 'Questions', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Listar Sections'), ['controller' => 'Sections', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Nuevo Section'), ['controller' => 'Sections', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Listar Evaluations'), ['controller' => 'Evaluations', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Nuevo Evaluation'), ['controller' => 'Evaluations', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Listar Selected Questions'), ['controller' => 'SelectedQuestions', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Nuevo Selected Question'), ['controller' => 'SelectedQuestions', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="answers form content">
    <?= $this->Form->create($answer) ?>
    <fieldset>
        <legend><?= __('Edit Answer') ?></legend>
        <?php
            echo $this->Form->control('instrument_id', ['options' => $instruments, 'empty' => true]);
            echo $this->Form->control('user_id', ['options' => $users, 'empty' => true]);
            echo $this->Form->control('question_id', ['options' => $questions, 'empty' => true]);
            echo $this->Form->control('section_id', ['options' => $sections, 'empty' => true]);
            echo $this->Form->control('evaluation_id', ['options' => $evaluations, 'empty' => true]);
            echo $this->Form->control('selected_question_id', ['options' => $selectedQuestions, 'empty' => true]);
            echo $this->Form->control('response', ['empty' => true]);
            echo $this->Form->control('value');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Guardar')) ?>
    <?= $this->Form->end() ?>
</div>
