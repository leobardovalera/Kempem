<?php
/**
 * Copyright 2010 - 2019, Cake Development Corporation (https://www.cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2018, Cake Development Corporation (https://www.cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
$this->extend('/layout/TwitterBootstrap/dashboard'); 
$this->set('pageHeader','<i class="fas fw fa-user"></i> Accesos');

$Users = ${$tableAlias};
$companies = TableRegistry::get('Companies')->find('list');
?>
<div class="users form">
    <?= $this->Form->create($Users); ?>
    <fieldset>
        <legend><?= __d('cake_d_c/users', 'Editar acceso') ?></legend>
        <?php
        echo $this->Form->control('username', ['label' => __d('cake_d_c/users', 'Nombre de usuario')]);
        echo $this->Form->control('email', ['label' => __d('cake_d_c/users', 'Correo Electrónico')]);
        echo $this->Form->control('first_name', ['label' => __d('cake_d_c/users', 'Nombres')]);
        echo $this->Form->control('last_name', ['label' => __d('cake_d_c/users', 'Apellidos')]);
        echo $this->Form->control('company_id', ['label' => __d('cake_d_c/users', 'Empresa'),'empty' => true,'options' => $companies]);
        echo $this->Form->control('role',['label'=>'Perfil','type'=>'select','empty'=>true,'options' => $roles]);
        // echo $this->Form->control('token', ['label' => __d('cake_d_c/users', 'Token')]);
        // echo $this->Form->control('token_expires', [
        //     'label' => __d('cake_d_c/users', 'Token expires')
        // ]);
        // echo $this->Form->control('api_token', [
        //     'label' => __d('cake_d_c/users', 'API token')
        // ]);
        // echo $this->Form->control('activation_date', [
        //     'label' => __d('cake_d_c/users', 'Activation date')
        // ]);
        // echo $this->Form->control('tos_date', [
        //     'label' => __d('cake_d_c/users', 'TOS date')
        // ]);
        echo $this->Form->control('active', [
            'label' => __d('cake_d_c/users', 'Active')
        ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__d('cake_d_c/users', 'Submit')) ?>
    <?= $this->Form->end() ?>
    <?php if (Configure::read('OneTimePasswordAuthenticator.login')) : ?>
        <fieldset>
            <legend>Reset Google Authenticator</legend>
            <?= $this->Form->postLink(
                __d('cake_d_c/users', 'Reset Google Authenticator Token'), [
                'plugin' => 'CakeDC/Users',
                'controller' => 'Users',
                'action' => 'resetOneTimePasswordAuthenticator', $Users->id
            ], [
                'class' => 'btn btn-danger',
                'confirm' => __d(
                    'cake_d_c/users',
                    'Are you sure you want to reset token for user "{0}"?', $Users->username
                )
            ]);
            ?>
        </fieldset>
    <?php endif; ?>
</div>
