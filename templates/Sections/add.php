<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Section $section
 * @var \App\Model\Entity\Instrument[]|\Cake\Collection\CollectionInterface $instruments
 * @var \App\Model\Entity\Answer[]|\Cake\Collection\CollectionInterface $answers
 * @var \App\Model\Entity\SelectedQuestion[]|\Cake\Collection\CollectionInterface $selectedQuestions
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Html->link(__('Listar Sections'), ['action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Listar Instruments'), ['controller' => 'Instruments', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Nuevo Instrument'), ['controller' => 'Instruments', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Listar Answers'), ['controller' => 'Answers', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Nuevo Answer'), ['controller' => 'Answers', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Listar Selected Questions'), ['controller' => 'SelectedQuestions', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Nuevo Selected Question'), ['controller' => 'SelectedQuestions', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="sections form content">
    <?= $this->Form->create($section) ?>
    <fieldset>
        <legend><?= __('Add Section') ?></legend>
        <?php
            echo $this->Form->control('instrument_id', ['options' => $instruments]);
            echo $this->Form->control('name');
            echo $this->Form->control('description');
            echo $this->Form->control('type');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Guardar')) ?>
    <?= $this->Form->end() ?>
</div>
