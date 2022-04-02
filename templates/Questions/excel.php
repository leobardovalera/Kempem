
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="questions form content">
    <?= $this->Form->create(null,['type' => 'file']) ?>
        <fieldset>
            <legend><?= __('Administrar preguntas por Excel') ?></legend>
            <?php
                echo $this->Form->control('file',['label' => 'Archivo en excel','type' => 'file']);
            ?>        
        </fieldset>
        <p><a href="/preguntas.xlsx" target="_blank">Descargar Formato de muestra</a></p>
        <h4>Instrucciones</h4>
        <ol>
            <li>Descargue el formato de prueba</li>
            <li>Llene el formato con las preguntas según las siguientes especificaciones
                <ul>
                    <li><b>Identificador:</b> Número único de la pregunta</li>
                    <li><b>Idioma:</b> Idioma en la que está la pregunta. (ES, EN, PT)</li>
                    <li><b>Tipo:</b> Tipo de pregunta según los siguientes valores
                        <ul>
                            <li><i>YN:</i> Si/No</li>
                            <li><i>17:</i> Escala 1..7</iYN>
                            <li><i>DE:</i> Desarrollo</17>
                            <li><i>TX:</i> Texto</DE>
                            <li><i>NU:</i> Número</TX>
                            <li><i>DT:</i> Fecha</NU>
                            <li><i>EM:</i> Email</DT>
                            <li><i>CB:</i> Checkbox</EM>
                            <li><i>YE:</i> Año</CB>
                            <li><i>SE:</i> Selección</YE>
                            <li><i>RA:</i> Radio</SE></li>
                        </ul>
                    </li>

                    <li><b>Requerida:</b> Indica si la pregunta es requerida o no al momento de ser respondida (Si o No)</li>
                    <li><b>Categorias:</b> Términos separados por coma para clasificar las preguntas</li>
                    <li><b>Enunciado1:</b> Enunciado versión 1 de la pregunta</li>
                    <li><b>Enunciado2:</b> Enunciado versión 2 de la pregunta</li>
                    <li><b>Enunciado3:</b> Enunciado versión 3 de la pregunta</li>
                    <li><b>Opciones:</b> Para las preguntas de tipo CB, SE y RA; Esta columna se usa para definir las opciones separadas por coma</li>
                </ul>
            </li>
            <li>El proceso buscará las preguntas existentes que tengan el mismo identificador e idioma</li>
            <li>Si consigue una pregunta con el mismo identificador y pregunta la actualiza, sino la crea nueva</li>
        </ol>
        <?= $this->Form->button(__('Subir')) ?>
    <?= $this->Form->end() ?>
</div>

<?php $this->append('script'); ?>
<link href="/css/tagsinput.css" rel="stylesheet" type="text/css">
<script src="/js/tagsinput.js"></script>
<?php $this->end(); ?>
