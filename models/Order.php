<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "db_order".
 *
 * @property int $id_order
 * @property int|null $id_subplace
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property int|null $created_at
 * @property int|null $date
 * @property int|null $time
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'db_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_subplace', 'created_at'], 'integer'],
            [['name', 'phone', 'email'], 'required'],
            [['name', 'phone', 'email', 'time','date'], 'string', 'max' => 255],
            [['subplaces'],'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_order' => 'ID',
            'id_subplace' => 'Локация',
            'subplaces' => 'Локации',
            'name' => 'ФИО',
            'phone' => 'Телефон',
            'email' => 'Email',
            'created_at' => 'Создано',
            'date' => 'Дата',
            'time' => 'Время',
        ];
    }

    public function getSubplace()
    {
        return $this->hasOne(Subplace::className(), ['id_subplace' => 'id_subplace']);
    }

    public function getPlaces()
    {
        $places = json_encode($this->subplaces);

        if (empty($places))
            return [];

        $id_subpales = array_keys($places);

        if (empty($id_subpales))
            return [];

        $models = Subplace::find()->where(['id_subplace'=>$id_subpales])->indexBy('id_subpales')->all();


        foreach ($models as $index=>$model)
        {
            $model->time = $places[$index]['time']??'';
            $model->date = $places[$index]['date']??'';
        }    

        return $models;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert))
        {
            if (is_array($this->subplaces))
                $this->subplaces = json_encode($this->subplaces);

            return true;
        }
        else
            return false;
    }
}
