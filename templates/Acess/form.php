<div class="user form content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __($action.' Empresa') ?></legend>
        <?php
            echo $this->Form->control('name',['label'=>'Nombre']);
            echo $this->Form->control('description',['label'=>'Descripción','class'=>'tinymce']);
            echo $this->Form->control('logo',['type'=>'file','label'=>'Logo']);
            echo $this->Form->control('instruments',['type'=>'number','label'=>'Cantidad de instrumentos']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Guardar')) ?>
    <?= $this->Form->end() ?>
</div>
