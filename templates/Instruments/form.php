<div class="instruments form content">
    <?= $this->Form->create($instrument) ?>
    <fieldset>
        <legend><?= __($action.' Instrumento') ?></legend>
        <?php
            echo $this->Form->control('script_id', ['label'=>'Script','options' => $scripts, 'empty' => true]);
            echo $this->Form->control('name',['label'=>'Nombre']);
            echo $this->Form->control('description',['label'=>'Descripción','class'=>'tinymce']);
            echo $this->Form->control('language',['label'=>'Idioma','options' => ["ES" => "Español","EN" => "Inglés","PT" => "Portugués",], 'empty' => true]);
        ?>
        <?php if(!empty($instrument->id)){ ?>
            <h4>
                Configuración del Instrumento
                <a href="/instruments/view/<?= $instrument->id ?>" target="_blank" title="Vista previa" class="btn btn-primary float-right">
                    <i class="fas fa-fw fa-eye"></i>
                </a>
            </h4>
            <div id="instrument-options-wrapper" class="mt-4">
                <input type="hidden" name="options" value="">
                <instrument-options :instrument='<?= json_encode($instrument) ?>' :questions='<?= json_encode($questions) ?>'></instrument-options>
            </div>
        <?php } ?>
    </fieldset>
    <?= $this->Form->button(__('Guardar')) ?>
    <?= $this->Form->end() ?>
</div>
