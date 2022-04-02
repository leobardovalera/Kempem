<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SelectedQuestion[]|\Cake\Collection\CollectionInterface $selectedQuestions
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Html->link(__('Nuevo Selected Question'), ['action' => 'add'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Listar Sections'), ['controller' => 'Sections', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Nuevo Section'), ['controller' => 'Sections', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Listar Questions'), ['controller' => 'Questions', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Nuevo Question'), ['controller' => 'Questions', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Listar Answers'), ['controller' => 'Answers', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Nuevo Answer'), ['controller' => 'Answers', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('section_id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('question_id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('order') ?></th>
        <th scope="col" class="actions"><?= __('Actions') ?></th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($selectedQuestions as $selectedQuestion) : ?>
        <tr>
            <td><?= $this->Number->format($selectedQuestion->id) ?></td>
            <td><?= $selectedQuestion->has('section') ? $this->Html->link($selectedQuestion->section->name, ['controller' => 'Sections', 'action' => 'view', $selectedQuestion->section->id]) : '' ?></td>
            <td><?= $selectedQuestion->has('question') ? $this->Html->link($selectedQuestion->question->id, ['controller' => 'Questions', 'action' => 'view', $selectedQuestion->question->id]) : '' ?></td>
            <td><?= $this->Number->format($selectedQuestion->order) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $selectedQuestion->id], ['title' => __('View'), 'class' => 'btn btn-secondary']) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $selectedQuestion->id], ['title' => __('Edit'), 'class' => 'btn btn-secondary']) ?>
                <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $selectedQuestion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $selectedQuestion->id), 'title' => __('Delete'), 'class' => 'btn btn-danger']) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->first('<< ' . __('First')) ?>
        <?= $this->Paginator->prev('< ' . __('Previous')) ?>
        <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
        <?= $this->Paginator->next(__('Next') . ' >') ?>
        <?= $this->Paginator->last(__('Last') . ' >>') ?>
    </ul>
    <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
</div>
