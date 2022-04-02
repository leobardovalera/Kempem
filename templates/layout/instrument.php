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
$version = md5(filemtime($file));

echo '<script>let csrfToken = "'.(isset($_COOKIE['csrfToken'])?$_COOKIE['csrfToken']:'').'";</script>';

$this->Html->css("/css/backend.min.css?v=".$version, ['block' => true]);
$this->Html->css("/fontawesome/css/all.css", ['block' => true]);
?>
    <body>
        <nav class="navbar sticky-top flex-md-nowrap py-2 py-md-4">
            <a href="/" class="logo col-sm-3 col-md-2 mr-0 text-center text-md-left">
                <img src="/img/reporte/2.png" alt="Kempem">
            </a>
        </nav>

    <?php
    echo $this->fetch('content');
    ?>
    </body>
<?php
echo '<script src="/js/backend.min.js?v='.$version.'"></script>';

$this->start('tb_footer');
echo '<div></div>';
$this->end();