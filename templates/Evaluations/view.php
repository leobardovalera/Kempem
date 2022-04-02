<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Evaluation $evaluation
 */
$status = [
    'NEW' => '',
    'NEW' => '',
    'NEW' => '',
    'NEW' => '',
    'NEW' => '',
]

?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<div class="evaluations view large-9 medium-8 columns content">
    <h3><?= h($evaluation->id) ?></h3>
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th scope="row">Link para contestar</th>
                <td><a href="https://evaluaciones.kempem.es/evaluacion/<?= h($evaluation->id) ?>" target="_blank">https://evaluaciones.kempem.es/evaluacion/<?= h($evaluation->id) ?></a></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Nombres y Apellidos') ?></th>
                <td><?= $evaluation->names ?> <?= $evaluation->lastnames ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Email') ?></th>
                <td><?= $evaluation->email ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Instrumento') ?></th>
                <td><?= $evaluation->has('instrument') ? $evaluation->instrument->name : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Script de evaluación') ?></th>
                <td><?= $evaluation->has('instrument') && $evaluation->instrument->has('script') ? $evaluation->instrument->script->name : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Status') ?></th>
                <td>
                    <?php 
                        if(!empty($evaluation->processed)){
                            echo 'Procesada';
                        }else if(!empty($evaluation->completed)){
                            echo 'Completada';
                        }else if(!empty($evaluation->started)){
                            echo 'Iniciada';
                        }else{
                            echo 'Nueva';
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><?= __('Creada') ?></th>
                <td><?= h($evaluation->created) ?></td>
            </tr>
            <!--tr>
                <th scope="row"><?= __('Enviada') ?></th>
                <td>
                    <?= h($evaluation->sended) ?>
                    <?php if(is_null($evaluation->sended)){ ?>
                        <?= $evaluation->sended?h($evaluation->sended):'<a href="/send/'.$evaluation->id.'" class="btn btn-primary">Enviar</a>' ?>
                    <?php } ?>
                </td>
            </tr-->
            <tr>
                <th scope="row"><?= __('Iniciada') ?></th>
                <td><?= h($evaluation->started) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Progreso') ?></th>
                <td><?= $evaluation->answered.'/'.$evaluation->total ?> <?= number_format($evaluation->answered/$evaluation->total*100,2,',','.') ?>%</td>
            </tr>
            <tr>
                <th scope="row"><?= __('Respuestas') ?></th>
                <td>
                    <a href="/evaluations/respuestas/<?= $evaluation->id ?>" class="btn btn-primary">Ver respuestas</a>
                </td>
            </tr>
            <tr>
                <th scope="row"><?= __('Completada') ?></th>
                <td><?= h($evaluation->completed) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Procesada') ?></th>
                <td><?= h($evaluation->processed) ?></td>
            </tr>
            <?php if(!is_null($evaluation->completed)){ ?>
                <tr>
                    <td colspan="2" class="text-center"><a href="/evaluations/reporte/<?= $evaluation->id ?>" target="_blank" class="btn btn-primary">Descargar informe</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
