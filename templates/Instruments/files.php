<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>
<div class="instruments form content">
    <?= $this->Form->create($instrument,['type' => 'file' ]) ?>
    <fieldset>
        <legend><?= __('Archivos de Reporte') ?></legend>
        <?php
            echo $this->Form->control('grupal', ['label'=>'Archivo Word del instrumento Grupal','type' => 'file']);
            ?>
    </fieldset>
    <?= $this->Form->button(__('Subir')) ?>
    <?= $this->Form->end() ?>
</div>
