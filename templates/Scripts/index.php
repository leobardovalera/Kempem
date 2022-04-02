<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Script[]|\Cake\Collection\CollectionInterface $scripts
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('name') ?></th>
        <th scope="col"><?= $this->Paginator->sort('location') ?></th>
        <th scope="col" class="actions"><?= __('Actions') ?></th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($scripts as $script) : ?>
        <tr>
            <td><?= $this->Number->format($script->id) ?></td>
            <td><?= h($script->name) ?></td>
            <td><?= h($script->location) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('<i class="fas fw fa-edit"></i>'), ['action' => 'edit', $script->id], ['title' => __('Editar'), 'class' => 'btn btn-secondary','escape' => false ]) ?>
                <?= $this->Form->postLink(__('<i class="fas fw fa-trash"></i> '), ['action' => 'delete', $script->id], ['confirm' => __('Are you sure you want to delete # {0}?', $script->id), 'title' => __('Delete'), 'class' => 'btn btn-danger','escape' => false ]) ?>
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
