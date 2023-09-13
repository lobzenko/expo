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
          <img class="mb-4 mb-md-0" src="<?=$data->media->showThumb(['w'=>730])?>" alt="" />
      </div>
      <div class="col-md-4 d-flex flex-column justify-content-end fs-15 <?=$key%2==0?'':'order-0 order-md-1'?>">
        <h4 class="fs-18 text-uppercase mb-0"><?=$data->name?></h4>
        24-25 ноября 2022 г.
        <p class="my-3"><?=$data->description?></p>
        <a class="arrow" href="/event/<?=$data->id_event?>">Подробнее</a>
      </div>
  </div>
  <?php }?>
    
  <!--center class="mb-5">
      <a class="more" href="#">ПОКАЗАТЬ ЕЩЁ</a>
  </center-->
</div>