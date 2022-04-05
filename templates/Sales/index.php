<?php

use Cake\Collection\Collection;
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Instrument[]|\Cake\Collection\CollectionInterface $sales
 */

// dd($sales);
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>
<?= $this->element('filters', ['filters' => $filters ]); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Html->link(__('Nueva Empresa'), ['action' => 'add'], ['class' => 'nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<table class="table table-striped">
    <thead>
    <tr>
        <th width="25%" scope="col">
            <?= $this->Paginator->sort('Companies.name',['label' => 'Compañía']) ?>
            <?= $this->Paginator->sort('Sales.country',['label' => 'País']) ?>
            <?= $this->Paginator->sort('Sales.instrument_id',['label' => 'Instrumento']) ?>
        </th>
        <th width="12%" scope="col"><?= $this->Paginator->sort('Sales.created',['label' => 'Creación']) ?></th>
        <th width="12%" scope="col">Código de acceso</th>
        <th width="30%" scope="col" colspan="2">Métricas</th>
        <th width="21%" scope="col" class="actions"><?= __('Acciones') ?></th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($sales as $sale) : ?>
        <tr>
            <td>
                <?= h($sale->company->name) ?><br />
                <?= h($sale->country?$countries[$sale->country]:'País no definido') ?><br />
                <?= $sale->instrument?$sale->instrument->name:"<b class='text-danger'>Por favor no borrar información de la BD</b>" ?>
            </td>
            <td><?= h($sale->created) ?></td>
            <td>
                <p class="lead"><?= h(strtoupper(substr($sale->id,-8,8))) ?></p>
            </td>
            <td width="15%">
                <b>Vendidas:</b> <?= h($sale->instruments) ?><br/>
                <b>Fecha maxima:</b> <?= isset($sale->max_date)?$sale->max_date->i18nformat('dd/MM/YYYY'):"--" ?><br/>
                <b>Contestadas:</b> <?= count($sale->evaluations) ?>
            </td>
            <td width="15%">
                <b>Completadas:</b> <?= count((new Collection($sale->evaluations))->filter(function ($value, $key, $iterator) {
                    return !empty($value->completed) && !empty($value->started) && empty($value->anulado);
                })->toArray()) ?><br/>
                <b>Anuladas:</b> <?= count((new Collection($sale->evaluations))->filter(function ($value, $key, $iterator) {
                    return empty($evaluation->completed) && !empty($value->anulado) && !empty($value->started);
                })->toArray()) ?><br/>
                <b>Iniciadas:</b> <?= count((new Collection($sale->evaluations))->filter(function ($value, $key, $iterator) {
                    return !empty($value->started);
                })->toArray()) ?><br/>
            </td>
            <td class="actions">
                <?= $this->Html->link(__('<i class="fas fw fa-eye" title="Ver individuales"></i>'), ['action' => 'view', $sale->id], ['title' => __('Ver'), 'class' => 'btn btn-info','escape' => false ]) ?>
                <?php if (isset($role) && $role == 'superadmin') { ?>
                    <?= $this->Html->link(__('<i class="fas fw fa-file-excel" title="General reporte Global"></i>'), ['action' => 'excel', $sale->id], ['title' => __('Editar'), 'class' => 'btn btn-success','escape' => false ]) ?>
                    <?= $this->Html->link(__('<i class="fas fw fa-file-word" title="Descargar informe global"></i>'), ['action' => 'graphs', $sale->id,'?'=>['v'=>time()]], ['title' => __('Descargar evaluaciones completadas'), 'class' => 'btn btn-primary','escape' => false ]) ?>
                    <?= $this->Html->link(__('<i class="fas fw fa-edit" title="Editar Venta"></i>'), ['action' => 'edit', $sale->id], ['title' => __('Editar'), 'class' => 'btn btn-secondary','escape' => false ]) ?>
                    <?= $this->Html->link(__('<i class="fas fw fa-file-archive" title="Descargar completadas"></i>'), ['action' => 'download', $sale->id], ['title' => __('Descargar evaluaciones completadas'), 'class' => 'btn btn-warning','escape' => false ]) ?>
                <?php } ?>
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
