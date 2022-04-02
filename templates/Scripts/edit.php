<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Script $script
 * @var \App\Model\Entity\Instrument[]|\Cake\Collection\CollectionInterface $instruments
 * @var \App\Model\Entity\Result[]|\Cake\Collection\CollectionInterface $results
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Form->postLink(__('<i class="fas fw fa-trash"></i> '), ['action' => 'delete', $script->id], ['confirm' => __('Are you sure you want to delete # {0}?', $script->id), 'class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Listar Scripts'), ['action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Listar Instruments'), ['controller' => 'Instruments', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Nuevo Instrument'), ['controller' => 'Instruments', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Listar Results'), ['controller' => 'Results', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Nuevo Result'), ['controller' => 'Results', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>


<?php 
    $action = 'Editar';
    require('form.php'); 
?>