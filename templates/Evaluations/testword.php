<div class="instruments form content row">
    <?= $this->Form->create(null,['type' => 'file']) ?>
    <div class="col col-md-8">
        <?php
            echo $this->Form->control('file', ['label'=>'Archivo','required' => true,'empty' => true,'type' => 'file']);
        ?>
    </div>
    <?= $this->Form->button(__('Enviar')) ?>
    <?= $this->Form->end() ?>
</div>
