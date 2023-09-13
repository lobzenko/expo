<?php

namespace app\extensions\seo;

use yii\base\Widget;
use Yii;

class SeoInputWidget extends Widget
{
	public $model;
    public $form;

    public function run()
    {
		$records = $this->model->loadSeoData();

    	return $this->render('inputs',[
            'records'=>$records,
            'form'=>$this->form,
        ]);
    }
}