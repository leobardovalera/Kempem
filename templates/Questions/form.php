<div class="questions form content">
    <?= $this->Form->create($question) ?>
        <fieldset>
            <legend><?= __($action.' pregunta') ?></legend>
                <?php
                    echo $this->Form->control('identifier',['label' => 'Identificador de pregunta']);
                ?>
                <div class="form-group">
                    <label for="options_categories">Categorías</label>
                    <input type="text" class="form-control" name="options[categories]" id="options_categories" data-role="tagsinput" value="<?= $question->options['categories'] ?>">
                </div>

                <div id="questions-wrapper">
                    <questions :question='<?= json_encode($question) ?>'></questions>
                </div>
        </fieldset>
        <?= $this->Form->button(__('Guardar')) ?>
    <?= $this->Form->end() ?>
</div>

<?php $this->append('script'); ?>
<link href="/css/tagsinput.css" rel="stylesheet" type="text/css">
<script src="/js/tagsinput.js"></script>
<?php $this->end(); ?>
