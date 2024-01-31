<?php 
  use yii\widgets\ActiveForm;

  $this->params['breadcrumbs'][] = 'Корзина';
?>

<div class="container">     
  <p class="pre-header">КОРЗИНА</p>
  <h2 class="mb-5">ВАШ ЗАКАЗ</h2> 

  <div class="row mb-5">
      <div class="col-md-6">
          <div class="card">
              <div class="card-body p-0">
                  <a href="/cart/remove?id=<?=$model->id_subplace?>" class="remove-cart" href="#">&times;</a>
                  <div class="row">
                      <div class="col-5">
                        <img src="<?=$model->media->showThumb(['w'=>350])?>">
                      </div>
                      <div class="col-7">
                          <div class="py-4 ps-0 pe-4 d-flex flex-column justify-content-between fs-18 h-100">                              
                              <div>
                                <b><?=$model->name?></b>
                                <p class="text-muted"><?=$model->place->name?></p>
                              </div>
                              <div class="text-right">
                                  <b><?php if (!empty($model->price)){?><?=$model->price?>/<?=$model->price_type?><?php }?></b>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-md-6">
        <?php $form = ActiveForm::begin([
            'id'=>'cart-form',
            'enableAjaxValidation'=>false,
            'enableClientValidation'=>false,
            'enableClientScript' => false,
        ]); ?>

        <div class="mb-4">
          <?= $form->field($order, 'name')->textInput(['placeholder' => 'Ваше имя*','required'=>'true'])->label(false) ?>
        </div>
        <div class="mb-4">
        <?= $form->field($order, 'phone')->textInput(['placeholder' => 'Ваш мобильный телефон*','required'=>'true'])->label(false) ?>
        </div>
        <div class="mb-4">
        <?= $form->field($order, 'email')->textInput(['placeholder' => 'Ваш e-mail*','required'=>'true'])->label(false) ?>
        </div>
        <div class="row mb-4">
            <div class="col-6">
                <?= $form->field($order, 'date')->textInput(['placeholder' => 'Дата','type'=>'date','required'=>'true'])->label(false) ?>
            </div>
            <div class="col-6">
                <?= $form->field($order, 'time')->textInput(['placeholder' => 'Время','type'=>"time",'required'=>'true'])->label(false) ?>
            </div>
        </div>

        <div class="form-check mb-5">
          <input class="form-check-input" type="checkbox" value="" required id="flexCheckChecked">
          <label class="form-check-label" for="flexCheckChecked">
            Подтверждаю, что ознакомлен с <a class="fw-bold" href="#">политикой конфиденциальности</a> и даю <a class="fw-bold" href="#">согласие на обработку ваших персональных данных</a>
          </label>
        </div>

        <button class="btn btn-primary btn-lg w-100" type="submit">Оформить предзаказ</button>
        <?php ActiveForm::end(); ?>
      </div>
  </div>
</div>

<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body px-4 py-5 text-center">
            <p class="fs-18 fw-bold">Ваша заявка успешно отправлена!</p>
            <p>Мы свяжемся с вами в ближайшее время, чтобы обсудить детали заявки</p>
            
            <a href="/" class="btn btn-lg btn-primary">Вернуться на главную</a>
      </div>
    </div>
  </div>
</div>