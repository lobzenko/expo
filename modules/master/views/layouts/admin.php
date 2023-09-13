<?php
use yii\helpers\Html;
use app\assets\AppMasterAsset;
$this->beginPage()?>
<!DOCTYPE html>
<head>
    <!-- Metadata -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maxsoft</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <?php $this->head()?>
    <?php AppMasterAsset::register($this);?>
    <?=Html::csrfMetaTags() ?>
</head>
<body class="top-navigation fixed-sidebar pace-done" data-spy="scroll" data-target="#navbar">
<?php $this->beginBody(); ?>
    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom white-bg">
                <nav class="navbar navbar-static-top" role="navigation">
                    <div class="navbar-header">
                        <button aria-controls="topnavbar" aria-expanded="false" data-target="#topnavbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                            <i class="fa fa-reorder"></i>
                        </button>
                        <a href="#" class="navbar-brand">MaxSoft</a>
                    </div>
                    <div class="navbar-collapse collapse" id="topnavbar">
                        <?=app\modules\master\components\NavMenuWidget::widget()?>
                        <ul class="nav navbar-top-links navbar-right">
                            <li>
                                <a href="/site/logout">
                                    <i class="fa fa-sign-out"></i> Выход
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

            <div id="content_wrapper" class="container-fluid">
                <?php if (!empty($this->params['breadcrumbs'])){?>
                <div class="row wrapper border-bottom page-heading">
                    <div class="col-lg-9">
                        <h2><?=$this->title?></h2>
                        <?=yii\widgets\Breadcrumbs::widget([
                            'homeLink'=> ['label' => 'Главная', 'url' => ['/master']],
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]) ?>
                    </div>
                    <div class="col-lg-3 text-right button-block m-t">
                        <?=isset($this->params['button-block']) ? $this->params['button-block']:''?>
                    </div>
                </div>
                <?php }?>

                <?=$content?>

                <div id="right-sidebar" class="animated">
                    <div class="sidebar-container">

                        <ul class="nav nav-tabs navs-3">

                            <li class="active"><a data-toggle="tab" href="#tab-1">
                                Notes
                            </a></li>
                            <li><a data-toggle="tab" href="#tab-2">
                                Projects
                            </a></li>
                            <li class=""><a data-toggle="tab" href="#tab-3">
                                <i class="fa fa-gear"></i>
                            </a></li>
                        </ul>

                        <div class="tab-content">


                            <div id="tab-1" class="tab-pane active">

                                <div class="sidebar-title">
                                    <h3> <i class="fa fa-comments-o"></i> Latest Notes</h3>
                                    <small><i class="fa fa-tim"></i> You have 10 new message.</small>
                                </div>

                                <div>

                                    <div class="sidebar-message">
                                        <a href="#">
                                            <div class="pull-left text-center">
                                                <img alt="image" class="img-circle message-avatar" src="/inspinia/img/a1.jpg">

                                                <div class="m-t-xs">
                                                    <i class="fa fa-star text-warning"></i>
                                                    <i class="fa fa-star text-warning"></i>
                                                </div>
                                            </div>
                                            <div class="media-body">

                                                There are many variations of passages of Lorem Ipsum available.
                                                <br>
                                                <small class="text-muted">Today 4:21 pm</small>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="sidebar-message">
                                        <a href="#">
                                            <div class="pull-left text-center">
                                                <img alt="image" class="img-circle message-avatar" src="/inspinia/img/a2.jpg">
                                            </div>
                                            <div class="media-body">
                                                The point of using Lorem Ipsum is that it has a more-or-less normal.
                                                <br>
                                                <small class="text-muted">Yesterday 2:45 pm</small>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="sidebar-message">
                                        <a href="#">
                                            <div class="pull-left text-center">
                                                <img alt="image" class="img-circle message-avatar" src="/inspinia/img/a3.jpg">

                                                <div class="m-t-xs">
                                                    <i class="fa fa-star text-warning"></i>
                                                    <i class="fa fa-star text-warning"></i>
                                                    <i class="fa fa-star text-warning"></i>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                Mevolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                                <br>
                                                <small class="text-muted">Yesterday 1:10 pm</small>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="sidebar-message">
                                        <a href="#">
                                            <div class="pull-left text-center">
                                                <img alt="image" class="img-circle message-avatar" src="/inspinia/img/a4.jpg">
                                            </div>

                                            <div class="media-body">
                                                Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the
                                                <br>
                                                <small class="text-muted">Monday 8:37 pm</small>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="sidebar-message">
                                        <a href="#">
                                            <div class="pull-left text-center">
                                                <img alt="image" class="img-circle message-avatar" src="/inspinia/img/a8.jpg">
                                            </div>
                                            <div class="media-body">

                                                All the Lorem Ipsum generators on the Internet tend to repeat.
                                                <br>
                                                <small class="text-muted">Today 4:21 pm</small>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="sidebar-message">
                                        <a href="#">
                                            <div class="pull-left text-center">
                                                <img alt="image" class="img-circle message-avatar" src="/inspinia/img/a7.jpg">
                                            </div>
                                            <div class="media-body">
                                                Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
                                                <br>
                                                <small class="text-muted">Yesterday 2:45 pm</small>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="sidebar-message">
                                        <a href="#">
                                            <div class="pull-left text-center">
                                                <img alt="image" class="img-circle message-avatar" src="/inspinia/img/a3.jpg">

                                                <div class="m-t-xs">
                                                    <i class="fa fa-star text-warning"></i>
                                                    <i class="fa fa-star text-warning"></i>
                                                    <i class="fa fa-star text-warning"></i>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                The standard chunk of Lorem Ipsum used since the 1500s is reproduced below.
                                                <br>
                                                <small class="text-muted">Yesterday 1:10 pm</small>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="sidebar-message">
                                        <a href="#">
                                            <div class="pull-left text-center">
                                                <img alt="image" class="img-circle message-avatar" src="/inspinia/img/a4.jpg">
                                            </div>
                                            <div class="media-body">
                                                Uncover many web sites still in their infancy. Various versions have.
                                                <br>
                                                <small class="text-muted">Monday 8:37 pm</small>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                            </div>

                            <div id="tab-2" class="tab-pane">

                                <div class="sidebar-title">
                                    <h3> <i class="fa fa-cube"></i> Latest projects</h3>
                                    <small><i class="fa fa-tim"></i> You have 14 projects. 10 not completed.</small>
                                </div>

                                <ul class="sidebar-list">
                                    <li>
                                        <a href="#">
                                            <div class="small pull-right m-t-xs">9 hours ago</div>
                                            <h4>Business valuation</h4>
                                            It is a long established fact that a reader will be distracted.

                                            <div class="small">Completion with: 22%</div>
                                            <div class="progress progress-mini">
                                                <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                                            </div>
                                            <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="small pull-right m-t-xs">9 hours ago</div>
                                            <h4>Contract with Company </h4>
                                            Many desktop publishing packages and web page editors.

                                            <div class="small">Completion with: 48%</div>
                                            <div class="progress progress-mini">
                                                <div style="width: 48%;" class="progress-bar"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="small pull-right m-t-xs">9 hours ago</div>
                                            <h4>Meeting</h4>
                                            By the readable content of a page when looking at its layout.

                                            <div class="small">Completion with: 14%</div>
                                            <div class="progress progress-mini">
                                                <div style="width: 14%;" class="progress-bar progress-bar-info"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="label label-primary pull-right">NEW</span>
                                            <h4>The generated</h4>
                                            There are many variations of passages of Lorem Ipsum available.
                                            <div class="small">Completion with: 22%</div>
                                            <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="small pull-right m-t-xs">9 hours ago</div>
                                            <h4>Business valuation</h4>
                                            It is a long established fact that a reader will be distracted.

                                            <div class="small">Completion with: 22%</div>
                                            <div class="progress progress-mini">
                                                <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                                            </div>
                                            <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="small pull-right m-t-xs">9 hours ago</div>
                                            <h4>Contract with Company </h4>
                                            Many desktop publishing packages and web page editors.

                                            <div class="small">Completion with: 48%</div>
                                            <div class="progress progress-mini">
                                                <div style="width: 48%;" class="progress-bar"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="small pull-right m-t-xs">9 hours ago</div>
                                            <h4>Meeting</h4>
                                            By the readable content of a page when looking at its layout.

                                            <div class="small">Completion with: 14%</div>
                                            <div class="progress progress-mini">
                                                <div style="width: 14%;" class="progress-bar progress-bar-info"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="label label-primary pull-right">NEW</span>
                                            <h4>The generated</h4>
                                            <!--<div class="small pull-right m-t-xs">9 hours ago</div>-->
                                            There are many variations of passages of Lorem Ipsum available.
                                            <div class="small">Completion with: 22%</div>
                                            <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                        </a>
                                    </li>

                                </ul>

                            </div>

                            <div id="tab-3" class="tab-pane">

                                <div class="sidebar-title">
                                    <h3><i class="fa fa-gears"></i> Settings</h3>
                                    <small><i class="fa fa-tim"></i> You have 14 projects. 10 not completed.</small>
                                </div>

                                <div class="setings-item">
                            <span>
                                Show notifications
                            </span>
                                    <div class="switch">
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example">
                                            <label class="onoffswitch-label" for="example">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="setings-item">
                            <span>
                                Disable Chat
                            </span>
                                    <div class="switch">
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="collapsemenu" checked class="onoffswitch-checkbox" id="example2">
                                            <label class="onoffswitch-label" for="example2">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="setings-item">
                            <span>
                                Enable history
                            </span>
                                    <div class="switch">
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example3">
                                            <label class="onoffswitch-label" for="example3">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="setings-item">
                            <span>
                                Show charts
                            </span>
                                    <div class="switch">
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example4">
                                            <label class="onoffswitch-label" for="example4">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="setings-item">
                            <span>
                                Offline users
                            </span>
                                    <div class="switch">
                                        <div class="onoffswitch">
                                            <input type="checkbox" checked name="collapsemenu" class="onoffswitch-checkbox" id="example5">
                                            <label class="onoffswitch-label" for="example5">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="setings-item">
                            <span>
                                Global search
                            </span>
                                    <div class="switch">
                                        <div class="onoffswitch">
                                            <input type="checkbox" checked name="collapsemenu" class="onoffswitch-checkbox" id="example6">
                                            <label class="onoffswitch-label" for="example6">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="setings-item">
                            <span>
                                Update everyday
                            </span>
                                    <div class="switch">
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example7">
                                            <label class="onoffswitch-label" for="example7">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="sidebar-content">
                                    <h4>Settings</h4>
                                    <div class="small">
                                        I belive that. Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                        And typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                                        Over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->endBody();?>
    <script src="/inspinia/js/bootstrap.min.js"></script>

    <!-- Mainly scripts -->
    <script src="/inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="/inspinia/js/plugins/flot/jquery.flot.js"></script>
    <script src="/inspinia/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="/inspinia/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="/inspinia/js/plugins/flot/jquery.flot.resize.js"></script>

    <script src="/inspinia/js/plugins/masonary/masonry.pkgd.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="/inspinia/js/inspinia.js"></script>
    <script src="/inspinia/js/plugins/pace/pace.min.js"></script>

    <script src="/js/redactor/redactor.js"></script>

    <!-- jQuery UI -->
    <script src="/inspinia/js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- GITTER -->
    <!--script src="/inspinia/js/plugins/gritter/jquery.gritter.min.js"></script-->

    <!-- Sparkline -->
    <!--script src="/inspinia/js/plugins/sparkline/jquery.sparkline.min.js"></script-->

    <!-- Sparkline demo data  -->
    <!--script src="/inspinia/js/demo/sparkline-demo.js"></script-->

    <script src="/inspinia/js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- Toastr -->
    <script src="/inspinia/js/plugins/toastr/toastr.min.js"></script>
</body>
</html>
<?php $this->endPage();?>