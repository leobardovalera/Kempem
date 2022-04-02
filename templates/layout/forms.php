<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$file = WWW_ROOT.'css/backend.min.css';
$version = md5(filemtime($file).file_get_contents($file));

$cakeDescription = 'Kempem';

$this->start('tb_footer');
echo '<div></div>';
$this->end();
?>
<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            <?= $cakeDescription ?>:
            <?= $this->fetch('title') ?>
        </title>
        <?= $this->Html->meta('icon') ?>

        <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

        <?php $this->Html->css("/css/backend.min.css?v=".$version, ['block' => true]); ?>

        <script>
            let csrfToken = '<?= isset($_COOKIE['csrfToken'])?$_COOKIE['csrfToken']:''; ?>';
        </script>
        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>
    </head>
    <body>
        <nav class="navbar sticky-top flex-md-nowrap py-4">
            <a href="/" class="logo col-sm-3 col-md-2 mr-0">
                <img src="/img/reporte/2.png" alt="Kempem">
            </a>
        </nav>
        <div class="container-flex w-100 h-100 p-4" id="instrument-wrapper">
            <div class="row h-100">
                <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                    <div class="h-100 d-flex align-items-center">
                        <?= $this->fetch('content') ?>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/script" src="/js/tinymce/tinymce.min.js"></script>
        <script type="text/script" src="/js/backend.min.js"></script>
    </body>
</html>
