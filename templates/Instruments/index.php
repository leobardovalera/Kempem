<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Instrument[]|\Cake\Collection\CollectionInterface $instruments
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Html->link(__('Nuevo Instrumento'), ['action' => 'add'], ['class' => 'nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col"><?= $this->Paginator->sort('Script') ?></th>
        <th scope="col"><?= $this->Paginator->sort('Nombre') ?></th>
        <th scope="col"><?= $this->Paginator->sort('Idioma') ?></th>
        <th scope="col" class="actions"><?= __('Acciones') ?></th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($instruments as $instrument) : ?>
        <tr>
            <td><?= $instrument->has('script') ? $this->Html->link($instrument->script->name, ['controller' => 'Scripts', 'action' => 'view', $instrument->script->id]) : '' ?></td>
            <td><?= h($instrument->name) ?></td>
            <td><?= h($instrument->language) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('<i class="fas fw fa-eye"></i>'), ['action' => 'view', $instrument->id], ['title' => __('Previsualizar'), 'class' => 'btn btn-info','target' => '_blank','escape' => false ]) ?>
                <?= $this->Html->link(__('<i class="fas fw fa-file-word"></i>'), ['action' => 'files', $instrument->id], ['title' => __('Archivos'), 'class' => 'btn btn-warning','escape' => false ]) ?>
                <?= $this->Html->link(__('<i class="fas fw fa-edit"></i>'), ['action' => 'edit', $instrument->id], ['title' => __('Editar'), 'class' => 'btn btn-secondary','escape' => false ]) ?>
                <?= $this->Form->postLink(__('<i class="fas fw fa-trash"></i> '), ['action' => 'delete', $instrument->id], ['confirm' => __('Are you sure you want to delete # {0}?', $instrument->id), 'title' => __('Delete'), 'class' => 'btn btn-danger','escape' => false ]) ?>
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
