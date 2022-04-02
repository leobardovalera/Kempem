<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Instrument $instrument
 */
?>
<?php $this->extend('/layout/instrument'); ?>

<div id="instrument-wrapper">
    <instrument :version="<?= rand(1,3) ?>" :instrument='<?= json_encode($evaluation->instrument) ?>' :questions='<?= json_encode($questions) ?>' :evaluation='<?= json_encode($evaluation) ?>'></instrument>
</div>

<?php //pj($instrument) ?>