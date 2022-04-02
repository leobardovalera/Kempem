<div class="scripts form content">
    <?= $this->Form->create($script) ?>
    <fieldset>
        <legend><?= __($action.' Script') ?></legend>
        <?php
            echo $this->Form->control('name',['label' => 'Nombre']);
            echo $this->Form->control('description',['label' => 'Descripción']);
            echo $this->Form->control('command',['label' => 'Comando para ejecutar el script']);
            echo $this->Form->control('in_file',['label' => 'Ruta del archivo de entrada']);
            echo $this->Form->control('out_file',['label' => 'Ruta del archivo de salida']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Guardar')) ?>
    <?= $this->Form->end() ?>
</div>
