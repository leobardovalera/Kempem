<div class="company form content">
    <div class="row">
        <div class="col col-md-6">
            <?= $this->Form->create($company) ?>
                <legend><?= __($action.' Clientes') ?></legend>
                <?php
                    echo $this->Form->control('name',['label'=>'Nombre','required'=>true]);
                    echo $this->Form->control('description',['label'=>'Descripción','class'=>'tinymce']);
                    echo $this->Form->control('type',['label'=>'Tipo de organización']);
                    echo $this->Form->control('perfil',['label'=>'Perfil de la organización']);
                    echo $this->Form->control('perfil_muestra',['label'=>'Perfil de la muestra']);
                    echo $this->Form->control('logo',['type'=>'file','label'=>'Logo']);
                ?>
                <legend>Información de contacto</legend>
                <?php
                    echo $this->Form->control('contact_fullname',['label'=>'Nombre y apellidos']);
                ?>
                <div class="row">
                    <div class="col">
                        <?php
                            echo $this->Form->control('contact_email',['label'=>'Email']);
                            ?>
                    </div>
                    <div class="col">
                        <?php
                            echo $this->Form->control('contact_phone',['label'=>'Teléfonos']);
                        ?>
                    </div>
                </div>
                <?php
                    echo $this->Form->control('address1',['label'=>'Dirección 1']);
                    echo $this->Form->control('address2',['label'=>'Dirección 2']);
                    ?>
                    <div class="row">
                        <div class="col">
                            <?php
                                echo $this->Form->control('country',['label'=>'País']);
                                echo $this->Form->control('city',['label'=>'Ciudad']);
                            ?>
                        </div>
                        <div class="col">
                            <?php
                                echo $this->Form->control('state',['label'=>'Estado']);
                                echo $this->Form->control('zip',['label'=>'Código postal']);
                            ?>
                        </div>
                    </div>
                    <legend>Información de contacto</legend>
                    <?php
                    echo $this->Form->control('billing',['label'=>'Información de facturación']);
                    echo $this->Form->control('users[]',[
                        'type'=>'select'
                        ,'class'=>'select2'
                        ,'multiple'=>true
                        
                        ,'label'=>'Usuarios'
                        ,'options'=>$users
                        ,'value' => (isset($selectedUsers)) ? $selectedUsers : []
                    ]);
                    ?>
            <?= $this->Form->button(__('Guardar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
<?php
    // dd($company);
?>