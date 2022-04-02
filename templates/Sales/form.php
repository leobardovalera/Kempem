<div class="sale form content">
    <div class="row">
        <div class="col col-md-6">
            <?= $this->Form->create($sale) ?>
                <legend><?= __($action.' Venta') ?></legend>
                <?php
                    echo $this->Form->control('company_id',['label'=>'Cliente','empty'=>true,'required'=>true,'options'=>$companies]);
                    echo $this->Form->control('instrument_id',['label'=>'Instrumento vendido','type'=>'select','empty'=>true,'required'=>true,'options'=>$instruments]);
                    echo $this->Form->control('instruments',['label'=>'Cantidad de instrumentos vendidos','type'=>'number']);
                    echo $this->Form->control('max_date',['label'=>'Fecha máxima para emitir instrumentos','type'=>'date']);
                    echo $this->Form->control('country',['label'=>'País de aplicación','empty'=>true, 'options' => $countries]);
                ?>
            <?= $this->Form->button(__('Guardar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
<?php
    // dd($sale);
?>