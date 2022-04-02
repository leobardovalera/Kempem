<div class="instruments form content row">
    <?= $this->Form->create($evaluation) ?>
    <div class="col col-md-8">
        <legend><?= __($action.' Evaluación') ?></legend>
        <?php
            echo $this->Form->control('company_id', ['label'=>'Cliente','required' => true,'empty' => true,'options' => $companies]);
            echo $this->Form->control('sales_id', ['label'=>'Venta','required' => true,'empty' => true,'options' => $sales]);
            echo $this->Form->control('email', ['label'=>'Correo electrónico','type' => 'email','required' => true]);
            echo $this->Form->control('names', ['label'=>'Nombres','required' => true]);
            echo $this->Form->control('lastnames', ['label'=>'Apellidos','required' => true]);
            echo $this->Form->control('instrument_id', ['label'=>'Instrumento','options' => $instruments, 'required' => true, 'empty' => true]);
        ?>
        <?php if(!empty($instrument->id)){ ?>
            <h4>Configuración del Instrumento</h4>
                <div id="instrument-wrapper">
                    <input type="hidden" name="options" value="">
                    <instrument :instrument='<?= json_encode($instrument) ?>' :questions='<?= json_encode($questions) ?>'></instrument>
                </div>
        <?php } ?>
    </div>
    <?= $this->Form->button(__('Generar')) ?>
    <?= $this->Form->end() ?>
</div>
