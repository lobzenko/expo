<?php 
    use yii\widgets\ActiveForm;
    use yii\helpers\Html;

    $model = new \app\models\Contact;
?>
<div class="bg-brown">
  <div class="container py-5">
      <p class="pre-header"><?=$sub_title?></p>
      <h2 class="mb-5"><?=$title?></h2>
      <div class="row">
        <div class="col-lg-8">
            <?php $form = ActiveForm::begin([
                'action'=>'/site/contact',
                'id'=>'contact-form',
                //'fieldsTemplates'=>'{input}{error}'
            ]); ?>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <?=Html::activeTextInput($model,"name",['class'=>'form-control','required'=>true,'placeholder'=>'Ваше имя*']);?>                        
                    </div>
                    <div class="col-md-6 mb-4">
                        <?=Html::activeTextInput($model,"phone",['class'=>'form-control','required'=>true,'placeholder'=>'Ваш мобильный телефон*']);?>
                    </div>
                    <div class="col-md-6 mb-4">
                        <?=Html::activeTextInput($model,"email",['class'=>'form-control','required'=>true,'type'=>'email','placeholder'=>'Ваш e-mail*']);?>                        
                    </div>
                    <div class="col-md-6 mb-4">
                        <?=Html::activeTextInput($model,"firm",['class'=>'form-control','placeholder'=>'Название организации']);?>                        
                    </div>                        
                </div>

                <?=Html::activeTextArea($model,"firm",['class'=>'form-control  mb-4','placeholder'=>'Дополнительный комментарий']);?>                        
                
                <div class="form-check mb-5">
                  <input class="form-check-input" type="checkbox" value="" required id="flexCheckChecked">
                  <label class="form-check-label" for="flexCheckChecked">
                    Подтверждаю, что ознакомлен с <a class="fw-bold" href="#">политикой конфиденциальности</a> и даю <a class="fw-bold" href="#">согласие на обработку ваших персональных данных</a>
                  </label>
                </div>
                <button class="btn btn-lg btn-white" type="submit">Отправить заявку</button>
            <?php ActiveForm::end(); ?>
        </div>
      </div>
  </div>
</div>
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body px-4 py-5 text-center">
            <p class="fs-18 fw-bold">Ваша сообщение успешно отправлено!</p>
            <p>Мы свяжемся с вами в ближайшее время, чтобы обсудить детали</p>
            
            <button type="button" class="btn-close btn btn-lg btn-primary" data-bs-dismiss="modal" aria-label="Close">Вернуться на главную</button>
      </div>
    </div>
  </div>
</div>