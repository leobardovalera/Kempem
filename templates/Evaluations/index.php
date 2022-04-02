<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Evaluation[]|\Cake\Collection\CollectionInterface $evaluations
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>
<?= $this->element('filters', ['filters' => $filters ]); ?>

<table class="table table-striped">
    <thead>
    <tr>
        <th width="40%" scope="col">
            <?= $this->Paginator->sort('Evaluations.names',['label' => 'Nombres']) ?>
            <?= $this->Paginator->sort('Evaluations.lastnames',['label' => 'Apellidos']) ?>
            <?= $this->Paginator->sort('Company.name',['label' => 'Empresa']) ?>
        </th>
        <th width="25%" scope="col">
            <?= $this->Paginator->sort('Instruments.name',['label' => 'Instrumento']) ?>
            <?= $this->Paginator->sort('Sales.id',['label' => 'Código']) ?>
        </th>
        <th width="25%" scope="col">Estatus</th>
        <th width="10%" scope="col" class="actions"><?= __('Actions') ?></th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($evaluations as $evaluation) : ?>
        <tr>
            <td>
                <h6><?= h($evaluation->names) ?> <?= h($evaluation->lastnames) ?></h6>
                <?= $evaluation->email ?><br>
                <b>Empresa:</b> <?= $evaluation->company->name ?><br>
            </td>
            <td>
                <?= h($evaluation->id) ?><br>
                <?= $evaluation->has('instrument') ? $this->Html->link($evaluation->instrument->name, ['controller' => 'Instruments', 'action' => 'view', $evaluation->instrument->id]) : '' ?><br>
                <?php if($evaluation->sale){ ?>
                    <b>Código venta:</b> <?= h(strtoupper(substr($evaluation->sale->id,-8,8))) ?><br>
                    <b>País venta:</b> <?= h($evaluation->sale->country?$countries[$evaluation->sale->country]:'País no definido') ?><br>
                <?php } ?>
            </td>
            <td>
                Estatus: 
                    <?php 
                        if(!empty($evaluation->processed)){
                            echo 'Procesada';
                        }else if(!empty($evaluation->completed)){
                            echo '<span class="text-success">Completada</span>';
                        }else if(!empty($evaluation->anulado)){
                            echo '<span class="text-danger">Anulada</span>';
                        }else if(!empty($evaluation->started)){
                            echo '<span class="text-info">Iniciada</span>';
                        }else{
                            echo 'Nueva';
                        }
                    ?><br>
                Venta: <?= h($evaluation->sale?$evaluation->sale->created:$evaluation->created) ?><br>
                Iniciada: <?= h($evaluation->started) ?><br>
                Completada: <?= h($evaluation->completed) ?><br>
                Progreso: <?= $evaluation->answered.'/'.$evaluation->total ?> <?= number_format($evaluation->answered/$evaluation->total*100,2,',','.') ?>%
            </td>
            <td class="actions">
                <?= $this->Html->link(__('<i class="fas fw fa-eye"></i>'), ['action' => 'view', $evaluation->id], ['title' => __('View'), 'class' => 'btn btn-secondary','escape' => false ]) ?>
                <?= $this->Html->link(__('<i class="fas fw fa-file-pdf"></i>'), ['controller'=>'evaluations','action' => 'reporte', $evaluation->id], ['title' => __('View'), 'class' => 'btn btn-primary','escape' => false ]) ?>
                <?= $this->Form->postLink(__('<i class="fas fw fa-recycle"></i> '), ['controller'=>'evaluations','action' => 'reset', $evaluation->id], ['confirm' => __('Esta a punto de eliminar las preguntas de la evaluación de {0} ¿Está seguro que desea continuar?', $evaluation->names.' '.$evaluation->lastnames), 'title' => __('Resetear'), 'class' => 'btn btn-danger','escape' => false ]) ?>
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
