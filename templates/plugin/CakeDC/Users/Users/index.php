<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Instrument[]|\Cake\Collection\CollectionInterface $users
 */
use Cake\ORM\TableRegistry;
$companyTable = TableRegistry::get('Companies');

$roles = [
    'superadmin'=>'Super Administrador',
    'admin'=>'Administrador de empresa',
    'user'=>'Operador',
    'client'=>'Cliente',
];
$this->set('pageHeader','<i class="fas fw fa-user"></i> Accesos');
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">Nombres</th>
        <th scope="col">Empresa</th>
        <th scope="col">Contacto</th>
        <th scope="col">Perfil</th>
        <th scope="col" class="actions"><?= __('Acciones') ?></th>
    </tr>
    </thead>
    <tbody>
        <?php foreach (${$tableAlias} as $user) : ?>
        <?php 
            try {
                $company = $companyTable->get($user->company_id);
            }catch(Exception $e){
                $company->name = "--";
            }
        ?>
        <tr>
            <td>
                <h3><?= h($user->first_name) ?> <?= h($user->last_name) ?></h3>
                <?= h($user->username) ?>
            </td>
            <td><?= h($company?$company->name:'') ?></td>
            <td>
                <?= h($user->email) ?><br>
                <?= h($user->phone) ?>
            </td>
            <td>
                <?= h($roles[$user->role]) ?><br>
                <?= h($user->active?'Activo':'Inactivo') ?>
            </td>
            <td class="actions">
                <?= $this->Html->link(__('<i class="fas fw fa-key"></i>'), ['controller' => 'Users','action' => 'change_password', $user->id], ['title' => __('Cambiar contraseña'), 'class' => 'btn btn-info','escape' => false ]) ?>
                <?= $this->Html->link(__('<i class="fas fw fa-edit"></i>'), ['controller' => 'Users','action' => 'edit', $user->id], ['title' => __('Editar'), 'class' => 'btn btn-secondary','escape' => false ]) ?>
                <?= $this->Form->postLink(__('<i class="fas fw fa-trash"></i> '), ['controller' => 'Users','action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'title' => __('Delete'), 'class' => 'btn btn-danger','escape' => false ]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->first('<< ' . __('Inicio')) ?>
        <?= $this->Paginator->prev('< ' . __('Anterior')) ?>
        <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
        <?= $this->Paginator->next(__('Próximo') . ' >') ?>
        <?= $this->Paginator->last(__('Final') . ' >>') ?>
    </ul>
    <p><?= $this->Paginator->counter(__('Página {{page}} de {{pages}}, mostrando {{current}} registro(s) de {{count}} en total')) ?></p>
</div>
