<div class="container">     
  <p class="pre-header"><?=$sub_title?></p>
  <h2 class="mb-5"><?=$title?></h2> 

  <div class="d-flex justify-content-between fs-18 mb-5 align-items-center">
    <ul class="nav">
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
        <a class="nav-link <?=(empty($id_rub))?'active':''?> ps-0" aria-current="page" href="/place">Все</a>
      </li>
      <?php foreach ($rubs as $rub){?>        
        <li class="nav-item d-md-inline-block d-none">
          <a class="nav-link <?=($id_rub==$rub->id_rub)?'active':''?>" href="?id=<?=$rub->id_rub?>"><?=$rub->name?></a>
        </li>
      <?php }?>
    </ul>
    <!--div>
        Сортировать по: 
        <div class="dropdown d-inline-block">
          <button class="btn btn-link dropdown-toggle pe-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Популярности
          </button>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="#">Популярности</a></li>
            <li><a class="dropdown-item" href="#">Цене</a></li>
            <li><a class="dropdown-item" href="#">Вместимости</a></li>
          </ul>
        </div>
    </div-->
  </div>

  <div class="row">
    <?php 
      foreach ($records as $data)
        echo $this->render('@app/views/place/_view',['model'=>$data]);
    ?>    
  </div>
</div>