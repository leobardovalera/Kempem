<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Evaluation $evaluation
 */
use Cake\I18n\Time;

?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<div class="evaluations view large-9 medium-8 columns content">
    <h3><?= h($evaluation->id) ?></h3>
    <div class="table-responsive">
        <table class="table table-striped">

        <?php foreach($evaluation->instrument->options['sections'] as $s){ ?>
            <?php if(!empty($s['name'])){ ?>
                <tr>
                    <td colspan="5">
                        <h3><?= $s['name'] ?></h3>
                    </td>
                </tr>
            <?php } ?>
            <?php if(!empty($s['questions'])){ ?>
                <?php foreach($s['questions'] as $q){ ?>
                    <tr class="<?= !isset($q['answer'])?"text-danger":""?>">
                        <th width="10%"><?= $q['question']?></th>
                        <td>
                            <h6><?= $q['enunciado'] ?></h6>
                            <?= isset($q['date'])?(Time::parse(strtotime($q['date'])))->i18nformat('d/M/Y H:m:s'):''?>
                        </td>
                        <td width="10%"><?= isset($q['answer'])?$q['answer']:'No contestada'?></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        <?php } ?>


                <th scope="row">Link para contestar</th>
                <td><a href="https://evaluaciones.kempem.es/evaluacion/<?= h($evaluation->id) ?>" target="_blank">https://evaluaciones.kempem.es/evaluacion/<?= h($evaluation->id) ?></a></td>
        </table>
    </div>
</div>
