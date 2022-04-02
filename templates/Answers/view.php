<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Answer $answer
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Html->link(__('Edit Answer'), ['action' => 'edit', $answer->id], ['class' => 'nav-link']) ?></li>
<li><?= $this->Form->postLink(__('Delete Answer'), ['action' => 'delete', $answer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $answer->id), 'class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Listar Answers'), ['action' => 'index'], ['class' => 'nav-link']) ?> </li>
<li><?= $this->Html->link(__('Nuevo Answer'), ['action' => 'add'], ['class' => 'nav-link']) ?> </li>
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

<div class="answers view large-9 medium-8 columns content">
    <h3><?= h($answer->id) ?></h3>
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th scope="row"><?= __('Instrument') ?></th>
                <td><?= $answer->has('instrument') ? $this->Html->link($answer->instrument->name, ['controller' => 'Instruments', 'action' => 'view', $answer->instrument->id]) : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('User') ?></th>
                <td><?= $answer->has('user') ? $this->Html->link($answer->user->id, ['controller' => 'Users', 'action' => 'view', $answer->user->id]) : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Question') ?></th>
                <td><?= $answer->has('question') ? $this->Html->link($answer->question->id, ['controller' => 'Questions', 'action' => 'view', $answer->question->id]) : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Section') ?></th>
                <td><?= $answer->has('section') ? $this->Html->link($answer->section->name, ['controller' => 'Sections', 'action' => 'view', $answer->section->id]) : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Evaluation') ?></th>
                <td><?= $answer->has('evaluation') ? $this->Html->link($answer->evaluation->id, ['controller' => 'Evaluations', 'action' => 'view', $answer->evaluation->id]) : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Selected Question') ?></th>
                <td><?= $answer->has('selected_question') ? $this->Html->link($answer->selected_question->id, ['controller' => 'SelectedQuestions', 'action' => 'view', $answer->selected_question->id]) : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Id') ?></th>
                <td><?= $this->Number->format($answer->id) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Response') ?></th>
                <td><?= h($answer->response) ?></td>
            </tr>
        </table>
    </div>
    <div class="row">
        <h4><?= __('Value') ?></h4>
        <?= $this->Text->autoParagraph(h($answer->value)); ?>
    </div>
</div>
