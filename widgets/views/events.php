<div class="container">
  <p class="pre-header"><?=$sub_title?></p>
  <h2 class="mb-5"><?=$title?></h2>     

  <ul class="nav mb-5">
    <li class="nav-item d-md-none">
        <div class="dropdown d-inline-block">
          <button class="btn p-0 btn-link dropdown-toggle pe-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Все
          </button>
          <ul class="dropdown-menu dropdown-menu-dark">
            <?php foreach ($rubs as $rub){?>
            <li><a class="dropdown-item" href="?id=<?=$rub->id_rub?>"><?=$rub->name?></a></li>
            <?php }?>
          </ul>
        </div>
    </li>
    <li class="nav-item d-md-inline-block d-none">
      <a class="nav-link <?=(empty($id_rub))?'active':''?> ps-0" aria-current="page" href="/event">Все</a>
    </li>
    <?php foreach ($rubs as $rub){?>        
      <li class="nav-item d-md-inline-block d-none">
        <a class="nav-link <?=($id_rub==$rub->id_rub)?'active':''?>" href="?id=<?=$rub->id_rub?>"><?=$rub->name?></a>
      </li>
    <?php }?>
  </ul>
   
  <?php foreach ($events as $key=>$data){?>
  <div class="row mb-lg-4 mb-5">
      <div class="col-md-8 <?=$key%2==0?'order-0':'order-1 order-md-0'?>">
          <?php if (!empty($data->media)){?>
          <img class="mb-4 mb-md-0 w-100" src="<?=$data->media->showThumb(['w'=>730])?>" alt="" />
          <?php }?>
      </div>
      <div class="col-md-4 d-flex flex-column justify-content-end fs-15 <?=$key%2==0?'':'order-0 order-md-1'?>">
        <h4 class="fs-18 text-uppercase mb-0"><?=$data->name?></h4>
        <?php 
            if ($data->date_begin == $data->date_end)
            {
                echo Yii::$app->formatter->asDate($data->date_begin,'long');
            }
            else 
            {
              $year_b = date('Y',$data->date_begin);
              $year_e = date('Y',$data->date_end);

              if ( $year_b == $year_e)
              {

                $month_b = Yii::$app->formatter->asDate($data->date_begin, 'MMMM');//strftime('%B',$data->date_begin);
                $month_e = Yii::$app->formatter->asDate($data->date_end, 'MMMM');//strftime('%B',$data->date_end);

                if ($month_b == $month_e)
                {
                  echo date('d',$data->date_begin).'-'.date('d',$data->date_end).' '.$month_b.' '.date('Y',$data->date_begin).' г.';
                }
                else 
                  echo Yii::$app->formatter->asDate('DDDD MMMM',$data->date_begin).'-'.Yii::$app->formatter->asDate('DDDD MMMM',$data->date_end).' '.date('Y',$data->date_begin).' г.';
              }
              else 
                echo Yii::$app->formatter->asDate($data->date_begin,'long').'-'.Yii::$app->formatter->asDate($data->date_end,'long');
            }
        ?>
        <p class="my-3"><?=$data->description?></p>
        <a class="arrow" href="<?=$data->getUrl()?>">Подробнее</a>
      </div>
  </div>
  <?php }?>
    
  <!--center class="mb-5">
      <a class="more" href="#">ПОКАЗАТЬ ЕЩЁ</a>
  </center-->
</div>