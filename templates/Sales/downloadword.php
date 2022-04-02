<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Instrument $instrument
 * @var \App\Model\Entity\Script[]|\Cake\Collection\CollectionInterface $scripts
 * @var \App\Model\Entity\Answer[]|\Cake\Collection\CollectionInterface $answers
 * @var \App\Model\Entity\Evaluation[]|\Cake\Collection\CollectionInterface $evaluations
 * @var \App\Model\Entity\Result[]|\Cake\Collection\CollectionInterface $results
 * @var \App\Model\Entity\Section[]|\Cake\Collection\CollectionInterface $sections
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<div class="progreso" style="mt-4"></div>

<?php $this->append('script'); ?>
<script>
    function check(){
        setTimeout(() => {
            let version = new Date();
            $.get('/sales/progress?id=<?= $id ?>&v='+version,function(data){
                $('.progreso').html(data);
                if($('.completado').length==0){
                    check();
                }
            });
        }, 1000);
    }
    check();
</script>
<?php $this->end(); ?>