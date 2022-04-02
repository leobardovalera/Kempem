<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Result $result
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Html->link(__('Edit Result'), ['action' => 'edit', $result->id], ['class' => 'nav-link']) ?></li>
<li><?= $this->Form->postLink(__('Delete Result'), ['action' => 'delete', $result->id], ['confirm' => __('Are you sure you want to delete # {0}?', $result->id), 'class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Listar Results'), ['action' => 'index'], ['class' => 'nav-link']) ?> </li>
<li><?= $this->Html->link(__('Nuevo Result'), ['action' => 'add'], ['class' => 'nav-link']) ?> </li>
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

<div class="results view large-9 medium-8 columns content">
    <h3><?= h($result->id) ?></h3>
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th scope="row"><?= __('Script') ?></th>
                <td><?= $result->has('script') ? $this->Html->link($result->script->name, ['controller' => 'Scripts', 'action' => 'view', $result->script->id]) : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('User') ?></th>
                <td><?= $result->has('user') ? $this->Html->link($result->user->id, ['controller' => 'Users', 'action' => 'view', $result->user->id]) : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Instrument') ?></th>
                <td><?= $result->has('instrument') ? $this->Html->link($result->instrument->name, ['controller' => 'Instruments', 'action' => 'view', $result->instrument->id]) : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Evaluation') ?></th>
                <td><?= $result->has('evaluation') ? $this->Html->link($result->evaluation->id, ['controller' => 'Evaluations', 'action' => 'view', $result->evaluation->id]) : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Data') ?></th>
                <td><?= h($result->data) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Id') ?></th>
                <td><?= $this->Number->format($result->id) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Processed') ?></th>
                <td><?= h($result->processed) ?></td>
            </tr>
        </table>
    </div>
</div>
