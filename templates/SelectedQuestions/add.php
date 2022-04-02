<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SelectedQuestion $selectedQuestion
 * @var \App\Model\Entity\Section[]|\Cake\Collection\CollectionInterface $sections
 * @var \App\Model\Entity\Question[]|\Cake\Collection\CollectionInterface $questions
 * @var \App\Model\Entity\Answer[]|\Cake\Collection\CollectionInterface $answers
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Html->link(__('Listar Selected Questions'), ['action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Listar Sections'), ['controller' => 'Sections', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Nuevo Section'), ['controller' => 'Sections', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Listar Questions'), ['controller' => 'Questions', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Nuevo Question'), ['controller' => 'Questions', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Listar Answers'), ['controller' => 'Answers', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Nuevo Answer'), ['controller' => 'Answers', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="selectedQuestions form content">
    <?= $this->Form->create($selectedQuestion) ?>
    <fieldset>
        <legend><?= __('Add Selected Question') ?></legend>
        <?php
            echo $this->Form->control('section_id', ['options' => $sections, 'empty' => true]);
            echo $this->Form->control('question_id', ['options' => $questions, 'empty' => true]);
            echo $this->Form->control('order');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Guardar')) ?>
    <?= $this->Form->end() ?>
</div>
