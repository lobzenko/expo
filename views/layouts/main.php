<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use app\models\Vars;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

</head>
<body>
<?php $this->beginBody() ?>

<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="/"><img src="/i/logo.svg"/></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav fs-18">
        <?php
          $menu = app\models\Menu::find()->where(['alias'=>'top_menu'])->one();          
          if (!empty($menu))
          {
            foreach ($menu->activeElements as $key => $data) {?>
              <li class="nav-item">                
                <a class="nav-link <?=($data->url==Yii::$app->request->url)?'active':''?>" aria-current="page" href="<?=$data->url?>"><?=$data->name?></a>
              </li>
        <?php }
          }
        ?>        
      </ul>
    </div>
  </div>
</nav>


<?php if (!empty($this->params['breadcrumbs'])): ?>
    <div class="container breadcrumbs mt-4 mb-5">
      <?= Breadcrumbs::widget([
        'links' => $this->params['breadcrumbs'],
        'tag'=>'div',
        'itemTemplate' => "{link}>",
        'activeItemTemplate' => "<strong>{link}</strong>",
      ]) ?>
    </div>
<?php endif ?>
<?= Alert::widget() ?>
<?= $content ?>

<footer class="bg-brown pt-5">
    <div class="container">
      <div class="row">
          <div class="col-md-3 col-6 mb-4 mb-md-0">
                <a href="/"><img src="/i/footer_logo.png" alt=""/></a>
          </div>
          <div class="col-md-3 col-6">
              <b>Адрес</b>
              <p><?=nl2br(Vars::getVar('address'))?></p>
          </div>
          <div class="col-md-3 col-6">
              <b>Часы работы</b>
              <p><?=nl2br(Vars::getVar('worktime'))?></p>
          </div>
          <div class="col-md-3 col-6">
              <b>Контакты</b>
              <p><?=nl2br(Vars::getVar('contacts'))?></p>
          </div>            
      </div>
    </div>
    <hr class="my-4">
    <div class="container pb-4">
      <div class="row">
          <div class="col">&copy;2023, All right reserved.</div>
          <div class="col text-right">
            <?php
              $menu = app\models\Menu::find()->where(['alias'=>'footer'])->one();          
              if (!empty($menu))
              {
                foreach ($menu->activeElements as $key => $data) {?>                  
                    <a href="<?=$data->url?>"><strong><?=$data->name?></strong></a>                  
            <?php }
              }
            ?>
          </div>
      </div>          
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
