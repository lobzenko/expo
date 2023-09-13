<?php
use yii\helpers\Html;
use app\modules\master\assets\AppMasterAsset;
$this->beginPage()?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="/favicon.ico">

        <?php $this->head()?>
        <?php AppMasterAsset::register($this);?>
        <?=Html::csrfMetaTags() ?>
    </head>
    <body data-layout="horizontal" class="<?=$this->params['bodyclass']??''?>">
    <?php $this->beginBody(); ?>
        <div id="layout-wrapper">
            <div class="topnav">
                <div class="container-fluid">
                    <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
                        <div class="collapse navbar-collapse d-flex justify-content-between" id="topnav-menu-content">
                            <?=app\modules\master\components\NavMenuWidget::widget()?>
                            <div class="dropdown d-inline-block">
                                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-user-circle"></i>
                                    <span class="d-none d-xl-inline-block ms-1" key="t-henry"><?=Yii::$app->user->identity->email?></span>
                                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="/user/update?id=<?=Yii::$app->user->id?>"><span key="t-profile">Профиль</span></a>
                                    <a class="dropdown-item text-danger" href="/site/logout"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Выход</span></a>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <div>
                                <h3 class=""><?=$this->title?></h3>
                                <?=yii\widgets\Breadcrumbs::widget([
                                        'itemTemplate' => '<li class="breadcrumb-item">{link}</li>',
                                        'activeItemTemplate' => '<li class="breadcrumb-item active">{link}</li>',
                                        'homeLink'=> ['label' => 'Главная', 'url' => ['/master']],
                                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                    ]) ?>
                            </div>
                            <div>
                                <?=isset($this->params['button-block']) ? $this->params['button-block']:''?>
                            </div>
                        </div>
                        <?=$content?>
                    </div>
                </div>
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> &copy; Конгресс бюро
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">

                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <div class="rightbar-overlay"></div>
        <?php $this->endBody();?>
    </body>
</html>
<?php $this->endPage();?>