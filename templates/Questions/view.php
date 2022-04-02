<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Question $question
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Html->link(__('Edit Question'), ['action' => 'edit', $question->id], ['class' => 'nav-link']) ?></li>
<li><?= $this->Form->postLink(__('Delete Question'), ['action' => 'delete', $question->id], ['confirm' => __('Are you sure you want to delete # {0}?', $question->id), 'class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Listar Questions'), ['action' => 'index'], ['class' => 'nav-link']) ?> </li>
<li><?= $this->Html->link(__('Nuevo Question'), ['action' => 'add'], ['class' => 'nav-link']) ?> </li>
<li><?= $this->Html->link(__('Listar Answers'), ['controller' => 'Answers', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Nuevo Answer'), ['controller' => 'Answers', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Listar Selected Questions'), ['controller' => 'SelectedQuestions', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Nuevo Selected Question'), ['controller' => 'SelectedQuestions', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="questions view large-9 medium-8 columns content">
    <h3><?= h($question->id) ?></h3>
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th scope="row"><?= __('Identifier') ?></th>
                <td><?= h($question->identifier) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Type') ?></th>
                <td><?= h($question->type) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Options') ?></th>
                <td><?= h($question->options) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Id') ?></th>
                <td><?= $this->Number->format($question->id) ?></td>
            </tr>
        </table>
    </div>
    <div class="related">
        <h4><?= __('Related Answers') ?></h4>
        <?php if (!empty($question->answers)): ?>
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
                <?php foreach ($question->answers as $answers): ?>
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
                        <?= $this->Html->link(__('View'), ['controller' => 'Answers', 'action' => 'view', $answers->id], ['class' => 'btn btn-secondary','escape' => false ]) ?>
                        <?= $this->Html->link(__('<i class="fas fw fa-pencil"></i> '), ['controller' => 'Answers', 'action' => 'edit', $answers->id], ['class' => 'btn btn-secondary','escape' => false ]) ?>
                        <?= $this->Form->postLink( __('Delete'), ['controller' => 'Answers', 'action' => 'delete', $answers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $answers->id), 'class' => 'btn btn-danger','escape' => false ]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Selected Questions') ?></h4>
        <?php if (!empty($question->selected_questions)): ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Section Id') ?></th>
                    <th scope="col"><?= __('Question Id') ?></th>
                    <th scope="col"><?= __('Order') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($question->selected_questions as $selectedQuestions): ?>
                <tr>
                    <td><?= h($selectedQuestions->id) ?></td>
                    <td><?= h($selectedQuestions->section_id) ?></td>
                    <td><?= h($selectedQuestions->question_id) ?></td>
                    <td><?= h($selectedQuestions->order) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['controller' => 'SelectedQuestions', 'action' => 'view', $selectedQuestions->id], ['class' => 'btn btn-secondary','escape' => false ]) ?>
                        <?= $this->Html->link(__('<i class="fas fw fa-pencil"></i> '), ['controller' => 'SelectedQuestions', 'action' => 'edit', $selectedQuestions->id], ['class' => 'btn btn-secondary','escape' => false ]) ?>
                        <?= $this->Form->postLink( __('Delete'), ['controller' => 'SelectedQuestions', 'action' => 'delete', $selectedQuestions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $selectedQuestions->id), 'class' => 'btn btn-danger','escape' => false ]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>
