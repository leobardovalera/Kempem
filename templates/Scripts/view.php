<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Script $script
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<div class="scripts view large-9 medium-8 columns content">
    <h3><?= h($script->name) ?></h3>
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th scope="row"><?= __('Name') ?></th>
                <td><?= h($script->name) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Location') ?></th>
                <td><?= h($script->location) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Command') ?></th>
                <td><?= h($script->command) ?></td>
            </tr>
        </table>
    </div>
    <div class="row">
        <div class="col">
            <h4><?= __('Descripción') ?></h4>
            <p><?= $this->Text->autoParagraph(h($script->description)); ?></p>
        </div>
    </div>
</div>
