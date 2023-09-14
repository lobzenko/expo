<?php 
  $this->params['breadcrumbs'][] = 'Портфолио';
?>

<div class="container mb-5">        
  <h1 class="mb-5"><?=$model->name?></h1>

  <?=$model->content?>
</div>

<?= app\widgets\FormWidget::widget();?>