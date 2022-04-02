<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Instrument[]|\Cake\Collection\CollectionInterface $companies
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Html->link(__('Nueva Empresa'), ['action' => 'add'], ['class' => 'nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col"><?= $this->Paginator->sort('Nombre') ?></th>
        <th scope="col" class="actions"><?= __('Acciones') ?></th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($companies as $company) : ?>
        <tr>
            <td><?= h($company->name) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('<i class="fas fw fa-edit"></i>'), ['action' => 'edit', $company->id], ['title' => __('Editar'), 'class' => 'btn btn-secondary','escape' => false ]) ?>
                <?= $this->Form->postLink(__('<i class="fas fw fa-trash"></i> '), ['action' => 'delete', $company->id], ['confirm' => __('Are you sure you want to delete # {0}?', $company->id), 'title' => __('Delete'), 'class' => 'btn btn-danger','escape' => false ]) ?>
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
