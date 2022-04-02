<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Evaluation $evaluation
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 * @var \App\Model\Entity\Instrument[]|\Cake\Collection\CollectionInterface $instruments
 * @var \App\Model\Entity\Answer[]|\Cake\Collection\CollectionInterface $answers
 * @var \App\Model\Entity\Result[]|\Cake\Collection\CollectionInterface $results
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<?php 
    $action = 'Editar';
    require('form.php'); 
?>