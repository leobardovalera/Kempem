<?php
    $this->extend('/layout/TwitterBootstrap/dashboard'); 
    $this->set('pageHeader','<i class="fas fw fa-user"></i> Accesos');
?>
<div class="users form">
    <?= $this->Flash->render('auth') ?>
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __d('cake_d_c/users', 'Cambio de contraseña') ?></legend>
        <?php if ($validatePassword) : ?>
            <?= $this->Form->control('current_password', [
                'type' => 'password',
                'required' => true,
                'label' => __d('cake_d_c/users', 'Contraseña actual')]);
            ?>
        <?php endif; ?>
        <?= $this->Form->control('password', [
            'type' => 'password',
            'required' => true,
            'label' => __d('cake_d_c/users', 'Nueva contraseña')]);
        ?>
        <?= $this->Form->control('password_confirm', [
            'type' => 'password',
            'required' => true,
            'label' => __d('cake_d_c/users', 'Confirmar contraseña')]);
        ?>

    </fieldset>
    <?= $this->Form->button(__d('cake_d_c/users', 'Enviar')); ?>
    <?= $this->Form->end() ?>
</div>