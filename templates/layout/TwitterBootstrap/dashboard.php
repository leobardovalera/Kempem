<?php
/**
 * @var \Cake\View\View $this
 */
use Cake\Core\Configure;

$file = WWW_ROOT.'css/backend.min.css';
$version = md5(filemtime($file).file_get_contents($file));

$this->Html->css('BootstrapUI.dashboard', ['block' => true]);
$this->Html->css("/css/backend.min.css?v=".$version, ['block' => true]);
$this->Html->css("/fontawesome/css/all.css", ['block' => true]);
$this->Html->css("https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css", ['block' => true]);
$this->Html->css("https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css", ['block' => true]);

$this->prepend('tb_body_attrs', ' class="' . implode(' ', [$this->request->getParam('controller'), $this->request->getParam('action')]) . '" ');
$this->start('tb_body_start');
    ?>
    <script>
        let csrfToken = '<?= isset($_COOKIE['csrfToken'])?$_COOKIE['csrfToken']:''; ?>';
    </script>
    <body <?= $this->fetch('tb_body_attrs') ?>>
        <nav class="navbar sticky-top flex-md-nowrap py-4">
            <a href="/pages/dashboard" class="logo col-sm-3 col-md-2 mr-0">
                <img src="/img/reporte/2.png" alt="Kempem">
            </a>

            <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap">
                    <a class="btn btn-link nav-link px-3" href="/logout">Salir</a>
                </li>
            </ul>
        </nav>

        <div class="container-fluid">
            <div class="row px-4">
                <nav class="col-md-2 d-none d-md-block sidebar">
                    <div class="sidebar-sticky sidebar-menu">
                        <ul class="nav flex-column">
                            <?php if(isset($user)){ ?>
                                <li>
                                    <b><?= $user->first_name ?> <?= $user->last_name ?></b><br>
                                    <?= isset($company)?$company->name.'<br>':'' ?>
                                    <small><?= $roles[$user->role] ?></small><br><br>
                                </li>
                            <?php } ?>
                            <?php  if (isset($role) && ($role == 'admin' || $role == 'superadmin')) { ?>
                                <li><?= $this->Html->link(__('<i class="fas fw fa-building"></i> Clientes'), ['controller' => 'Companies','action' => 'index','plugin' => null], ['class' => 'nav-link','escape' => false]) ?></li>
                            <?php } ?>
                            <?php  if (isset($role) && ($role == 'admin' || $role == 'superadmin')) { ?>
                                <li><a href="/users/index" class="nav-link"><i class="fas fw fa-user"></i> Accesos</a></li>
                            <?php } ?>
                            <li><?= $this->Html->link(__('<i class="fas fw fa-receipt"></i> Ventas'), ['controller' => 'Sales','action' => 'index','plugin' => null], ['class' => 'nav-link','escape' => false]) ?></li>
                            <li><?= $this->Html->link(__('<i class="fas fw fa-thermometer-half"></i> Aplicaciones'), ['controller' => 'Evaluations','action' => 'index','plugin' => null], ['class' => 'nav-link','escape' => false]) ?></li>
                            <?php  if (isset($role) && ($role == 'admin' || $role == 'superadmin')) { ?>
                                <li><?= $this->Html->link(__('<i class="fas fw fa-thermometer"></i> Instrumentos'), ['controller' => 'Instruments','action' => 'index','plugin' => null], ['class' => 'nav-link','escape' => false]) ?></li>
                            <?php } ?>
                            <?php  if (isset($role) && ($role == 'admin' || $role == 'superadmin')) { ?>
                                <li><?= $this->Html->link(__('<i class="fas fw fa-question"></i> Preguntas'), ['controller' => 'Questions','action' => 'index','plugin' => null], ['class' => 'nav-link','escape' => false]) ?></li>
                            <?php } ?>
                            <?php  if (isset($role) && ($role == 'admin' || $role == 'superadmin')) { ?>
                                <li><?= $this->Html->link(__('<i class="fas fw fa-file-excel"></i> Excel'), ['controller' => 'Questions','action' => 'excel','plugin' => null], ['class' => 'nav-link','escape' => false]) ?></li>
                            <?php } ?>
                            <?php  if (isset($role) && ($role == 'admin' || $role == 'superadmin')) { ?>
                                <li><?= $this->Html->link(__('<i class="fas fw fa-terminal"></i> Scripts'), ['controller' => 'Scripts','action' => 'index','plugin' => null], ['class' => 'nav-link','escape' => false]) ?></li>
                            <?php } ?>
                            
                        </ul>
                    </div>
                </nav>
                <main role="main" class="main col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                    <h1 class="page-header">
                        <?= $pageHeader; ?>
                        <?php  if (isset($role) && ($role == 'admin' || $role == 'superadmin')) { ?>
                        <?= $this->Html->link(__('<i class="fa fw fa-plus"></i>'), ['action' => 'add'], ['class' => 'btn btn-primary float-right nav-link','escape' => false]) ?>
                        <?php } ?>
                    </h1>
    <?php
    /**
     * Default `flash` block.
     */
    if (!$this->fetch('tb_flash')) {
        $this->start('tb_flash');
        if (isset($this->Flash)) {
            echo $this->Flash->render();
        }
        $this->end();
    }
$this->end();

$this->start('tb_body_end');
echo '</body>';
echo '<script src="/js/tinymce/tinymce.min.js?v='.$version.'"></script>';
echo '<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>';

echo '
    <script type="text/javascript">
        tinymce.init({
            selector: ".tinymce"
        });
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $(".select2").select2();
        });
    </script>'; 
$this->end();


$this->start('tb_footer');
echo '<script src="/js/backend.min.js?v='.$version.'"></script>';
$this->end();

$this->append('content', '</main></div></div>');
echo $this->fetch('content');
