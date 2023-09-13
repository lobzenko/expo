<?php
/**
 * RelationBehavior class file.
 *
 * @author Lobzenko Mikhail
 */
namespace app\extensions\seo;

use Yii;
//use app\models;
use yii\db\ActiveRecord;
use yii\base\ErrorException;
use yii\base\Behavior;
use app\models\Seo;

class SeoBehavior extends Behavior
{
	// записи
	public $seodata = [];

	public $seofields = [];

	// имя релейшена
	/* public $relation;

		public $jtable;

		public $required = false;
	*/
	public $index=1;

	public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterSave',
            ActiveRecord::EVENT_AFTER_INSERT => 'afterSave',
        ];
    }

	/**
	 * @param string $model_name
	 */
	public function loadSeoData()
	{
		// если уже загружены
		if (!empty($this->seodata))
			return $this->seodata;

		$this->seodata = [];

		$seodata = Seo::find()->where([
								'id_object'=>$this->owner->primaryKey,
								'model'=>$this->getClassname()
							])
							->indexBy('name')
							->all();

		foreach ($this->seofields as $key => $field)
		{
			if (isset($seodata[$key]))
				$this->seodata[$key] = $seodata[$key];
			else
			{
				$this->seodata[$key] = new Seo;
				$this->seodata[$key]->type = $field['type'];
				$this->seodata[$key]->title =  $field['title'];
			}
		}

		return $this->seodata;
	}

	protected function getClassname()
	{
		$model_type = get_class($this->owner);
        $model_type = substr($model_type, strrpos($model_type, "\\")+1);

        return $model_type;
	}

	public function beforeValidate($event)
	{
		// загружаем новые файлы
		foreach ($this->seofields as $field => $settings)
		{
			// если модель сохраняеся без фоток
			if (empty($_POST['Seo'][$field]))
				continue;

			$model= Seo::find()->where([
				'name'=>$field,
				'model'=>$this->getClassname(),
				'type'=>$settings['type'],
				'id_object'=>$this->owner->primaryKey,
			])->one();

			if (empty($model))
				$model= new Seo;

			$model->attributes = $_POST['Seo'][$field];
			$model->name = $field;
			$model->model = $this->getClassname();
			$model->type = $settings['type'];
			$model->title = $settings['title'];

			if (isset($settings['value']) && empty($model->text))
				$model->text =  $settings['value']();

			if (!$model->validate())
				$this->owner->addError($this->owner->tableSchema->primaryKey[0],'Ошибка ввода SEO данных');

			$this->seodata[$field] = $model;
		}
	}

	public function setDefaultSeo()
	{
		foreach ($this->seofields as $field => $settings)
		{
			$model= Seo::find()->where([
				'name'=>$field,
				'model'=>$this->getClassname(),
				'type'=>$settings['type'],
				'id_object'=>$this->owner->primaryKey,
			])->one();

			if (empty($model))
			{
				$model= new Seo;
				$model->name = $field;
				$model->model = $this->getClassname();
				$model->id_object = $this->owner->primaryKey;
				$model->type = $settings['type'];
				$model->title = $settings['title'];
			}

			if (isset($settings['value']))
				$model->text =  $settings['value']();

			if (!$model->save())
				print_r($model->errors);
		}
	}

	public function afterSave($event)
	{
		$Owner = &$this->owner;

		$id_object = $this->owner->primaryKey;

		foreach ($this->seodata as $key => $model)
		{
			$model->id_object = $id_object;
			$model->save();
		}
	}

	public function beforeDelete($event)
	{
		Seo::deleteAll(['id_object'=>Yii::$app->owner->primaryKey,'model'=>$this->getClassname()]);
	}
}