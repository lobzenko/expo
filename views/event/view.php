<?php 
  $this->params['breadcrumbs'][] = 'Портфолио';
?>

<div class="container mb-5">        
  <p class="pre-header">
    <?php 
        if ($model->date_begin == $model->date_end)
        {
            echo Yii::$app->formatter->asDate($model->date_begin,'long');
        }
        else 
        {
          $year_b = date('Y',$model->date_begin);
          $year_e = date('Y',$model->date_end);

          if ( $year_b == $year_e)
          {

            $month_b = Yii::$app->formatter->asDate($model->date_begin, 'MMMM');//strftime('%B',$model->date_begin);
            $month_e = Yii::$app->formatter->asDate($model->date_end, 'MMMM');//strftime('%B',$model->date_end);

            if ($month_b == $month_e)
            {
              echo date('d',$model->date_begin).'-'.date('d',$model->date_end).' '.$month_b.' '.date('Y',$model->date_begin).' г.';
            }
            else 
              echo Yii::$app->formatter->asDate('DDDD MMMM',$model->date_begin).'-'.Yii::$app->formatter->asDate('DDDD MMMM',$model->date_end).' '.date('Y',$model->date_begin).' г.';
          }
          else 
            echo Yii::$app->formatter->asDate($model->date_begin,'long').'-'.Yii::$app->formatter->asDate($model->date_end,'long');
        }
    ?>
  </p>
  <h1 class="mb-5"><?=$model->name?></h1>

  <?=$model->content?>
</div>

<?= app\widgets\FormWidget::widget();?>