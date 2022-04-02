<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SelectedQuestion $selectedQuestion
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Html->link(__('Edit Selected Question'), ['action' => 'edit', $selectedQuestion->id], ['class' => 'nav-link']) ?></li>
<li><?= $this->Form->postLink(__('Delete Selected Question'), ['action' => 'delete', $selectedQuestion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $selectedQuestion->id), 'class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Listar Selected Questions'), ['action' => 'index'], ['class' => 'nav-link']) ?> </li>
<li><?= $this->Html->link(__('Nuevo Selected Question'), ['action' => 'add'], ['class' => 'nav-link']) ?> </li>
<li><?= $this->Html->link(__('Listar Sections'), ['controller' => 'Sections', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Nuevo Section'), ['controller' => 'Sections', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Listar Questions'), ['controller' => 'Questions', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Nuevo Question'), ['controller' => 'Questions', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Listar Answers'), ['controller' => 'Answers', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Nuevo Answer'), ['controller' => 'Answers', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="selectedQuestions view large-9 medium-8 columns content">
    <h3><?= h($selectedQuestion->id) ?></h3>
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th scope="row"><?= __('Section') ?></th>
                <td><?= $selectedQuestion->has('section') ? $this->Html->link($selectedQuestion->section->name, ['controller' => 'Sections', 'action' => 'view', $selectedQuestion->section->id]) : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Question') ?></th>
                <td><?= $selectedQuestion->has('question') ? $this->Html->link($selectedQuestion->question->id, ['controller' => 'Questions', 'action' => 'view', $selectedQuestion->question->id]) : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Id') ?></th>
                <td><?= $this->Number->format($selectedQuestion->id) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Order') ?></th>
                <td><?= $this->Number->format($selectedQuestion->order) ?></td>
            </tr>
        </table>
    </div>
    <div class="related">
        <h4><?= __('Related Answers') ?></h4>
        <?php if (!empty($selectedQuestion->answers)): ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Instrument Id') ?></th>
                    <th scope="col"><?= __('User Id') ?></th>
                    <th scope="col"><?= __('Question Id') ?></th>
                    <th scope="col"><?= __('Section Id') ?></th>
                    <th scope="col"><?= __('Evaluation Id') ?></th>
                    <th scope="col"><?= __('Selected Question Id') ?></th>
                    <th scope="col"><?= __('Response') ?></th>
                    <th scope="col"><?= __('Value') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($selectedQuestion->answers as $answers): ?>
                <tr>
                    <td><?= h($answers->id) ?></td>
                    <td><?= h($answers->instrument_id) ?></td>
                    <td><?= h($answers->user_id) ?></td>
                    <td><?= h($answers->question_id) ?></td>
                    <td><?= h($answers->section_id) ?></td>
                    <td><?= h($answers->evaluation_id) ?></td>
                    <td><?= h($answers->selected_question_id) ?></td>
                    <td><?= h($answers->response) ?></td>
                    <td><?= h($answers->value) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['controller' => 'Answers', 'action' => 'view', $answers->id], ['class' => 'btn btn-secondary']) ?>
                        <?= $this->Html->link(__('Edit'), ['controller' => 'Answers', 'action' => 'edit', $answers->id], ['class' => 'btn btn-secondary']) ?>
                        <?= $this->Form->postLink( __('Delete'), ['controller' => 'Answers', 'action' => 'delete', $answers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $answers->id), 'class' => 'btn btn-danger']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>
