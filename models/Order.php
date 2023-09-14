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
}
