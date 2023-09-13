<?php 
  $this->params['breadcrumbs'][] = ['label' => 'Площадки', 'url' => ['place']];
  $this->params['breadcrumbs'][] = $model->name;
?>

<div class="container">     
  <p class="pre-header">ПЛОЩАДКИ</p>
  <div class="mb-5 row">
    <div class="col">
      <h1><?=$model->name?></h1> 
    </div>
    <!--div class="col-md-6 text-right">
      <a class="btn btn-primary btn-lg" href="#">Виртуальный тур</a>
    </div-->
  </div>
  
  <div class="row">
    <?php 
      foreach ($records as $data)
        echo $this->render('_view_subplace',['model'=>$data]);
    ?>    
  </div>
</div> 

<div class="modal fade" id="placeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body p-0">
          
      </div>
    </div>
  </div>
</div>