<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Instrument $instrument
 */
?>
<?php $this->extend('/layout/instrument'); ?>

<div id="instrument-wrapper">
    <instrument :version="3" :instrument='<?= json_encode($instrument) ?>' :questions='<?= json_encode($questions) ?>'></instrument>
</div>

<?php //pj($instrument) ?>