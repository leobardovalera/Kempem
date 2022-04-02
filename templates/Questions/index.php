<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Question[]|\Cake\Collection\CollectionInterface $questions
 */

$types = [
    "YN" => 'Si/No',
    "17" => 'Escala 1..7',
    "DE" => 'Desarrollo',
    "TX" => 'Texto',
    "NU" => 'Número',
    "DT" => 'Fecha',
    "CB" => 'Checkbox',
    "EM" => 'Email',
    "RA" => 'Radio',
    "SE" => 'Seleccion',
   ];
$graph = [
    "" => 'No indicado',
    "PIE" => 'Torta',
    "BARS" => 'Barras',
    "LINES" => 'Líneas',
];

?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Html->link(__('Nueva Pregunta'), ['action' => 'add'], ['class' => 'nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<table class="table table-striped">
    <thead>
    <tr>
        <th width="10%" scope="col"><?= $this->Paginator->sort('Identificador') ?></th>
        <th width="10%" scope="col"><?= $this->Paginator->sort('Idioma') ?></th>
        <th width="10%" scope="col"><?= $this->Paginator->sort('Categorias') ?></th>
        <th width="10%" scope="col"><?= $this->Paginator->sort('Tipo') ?></th>
        <th scope="col"><?= $this->Paginator->sort('Enunciado Principal') ?></th>
        <th width="10%" scope="col"><?= $this->Paginator->sort('Grafico') ?></th>
        <th width="10%" scope="col" class="actions"><?= __('Acciones') ?></th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($questions as $question) : ?>
        <tr>
            <td><?= h($question->identifier) ?></td>
            <td><?= h($question->options['languaje']) ?></td>
            <td><?= !empty($question->options['categories'])?h($question->options['categories']):'' ?></td>
            <td><?= h($types[$question->type]) ?></td>
            <td><?= h($question->options['enunciado']['E1']) ?></td>
            <td><?= h($graph[$question->graph]) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('<i class="fas fw fa-edit"></i>'), ['action' => 'edit', $question->id], ['title' => __('Editar'), 'class' => 'btn btn-secondary','escape' => false ]) ?>
                <?= $this->Form->postLink(__('<i class="fas fw fa-trash"></i> '), ['action' => 'delete', $question->id], ['confirm' => __('Are you sure you want to delete # {0}?', $question->id), 'title' => __('Delete'), 'class' => 'btn btn-danger','escape' => false ]) ?>
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
