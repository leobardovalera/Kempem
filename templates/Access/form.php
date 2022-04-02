<div class="user form content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __($action.' Acceso') ?></legend>
        <?php
            echo $this->Form->control('first_name',['label'=>'Nombres']);
            echo $this->Form->control('last_name',['label'=>'Apellidos']);
            echo $this->Form->control('username',['label'=>'Nombre de usuario']);
            echo $this->Form->control('email',['label'=>'Correo Electrónico']);
            echo $this->Form->control('phone',['label'=>'Teléfono']);
            echo $this->Form->control('company_id',['label'=>'Empresa','empty' => true,'type'=>'select','options' => $companies]);
            echo $this->Form->control('role',['label'=>'Perfil','type'=>'select','options' => $roles]);
            echo $this->Form->control('active',['label'=>'Cuenta habilitada']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Guardar')) ?>
    <?= $this->Form->end() ?>
</div>
