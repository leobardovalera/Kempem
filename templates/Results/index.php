<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Result[]|\Cake\Collection\CollectionInterface $results
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Html->link(__('Nuevo Result'), ['action' => 'add'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Listar Scripts'), ['controller' => 'Scripts', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Nuevo Script'), ['controller' => 'Scripts', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Listar Users'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Nuevo User'), ['controller' => 'Users', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Listar Instruments'), ['controller' => 'Instruments', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Nuevo Instrument'), ['controller' => 'Instruments', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Listar Evaluations'), ['controller' => 'Evaluations', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Nuevo Evaluation'), ['controller' => 'Evaluations', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('script_id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('processed') ?></th>
        <th scope="col"><?= $this->Paginator->sort('instrument_id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('evaluation_id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('data') ?></th>
        <th scope="col" class="actions"><?= __('Actions') ?></th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $result) : ?>
        <tr>
            <td><?= $this->Number->format($result->id) ?></td>
            <td><?= $result->has('script') ? $this->Html->link($result->script->name, ['controller' => 'Scripts', 'action' => 'view', $result->script->id]) : '' ?></td>
            <td><?= $result->has('user') ? $this->Html->link($result->user->id, ['controller' => 'Users', 'action' => 'view', $result->user->id]) : '' ?></td>
            <td><?= h($result->processed) ?></td>
            <td><?= $result->has('instrument') ? $this->Html->link($result->instrument->name, ['controller' => 'Instruments', 'action' => 'view', $result->instrument->id]) : '' ?></td>
            <td><?= $result->has('evaluation') ? $this->Html->link($result->evaluation->id, ['controller' => 'Evaluations', 'action' => 'view', $result->evaluation->id]) : '' ?></td>
            <td><?= h($result->data) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $result->id], ['title' => __('View'), 'class' => 'btn btn-secondary','escape' => false ]) ?>
                <?= $this->Html->link(__('<i class="fas fw fa-pencil"></i> '), ['action' => 'edit', $result->id], ['title' => __('<i class="fas fw fa-pencil"></i> '), 'class' => 'btn btn-secondary','escape' => false ]) ?>
                <?= $this->Form->postLink(__('<i class="fas fw fa-trash"></i> '), ['action' => 'delete', $result->id], ['confirm' => __('Are you sure you want to delete # {0}?', $result->id), 'title' => __('Delete'), 'class' => 'btn btn-danger','escape' => false ]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->first('<< ' . __('Inicio')) ?>
        <?= $this->Paginator->prev('< ' . __('Anterior')) ?>
        <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
        <?= $this->Paginator->next(__('Próximo') . ' >') ?>
        <?= $this->Paginator->last(__('Final') . ' >>') ?>
    </ul>
    <p><?= $this->Paginator->counter(__('Página {{page}} de {{pages}}, mostrando {{current}} registro(s) de {{count}} en total')) ?></p>
</div>
