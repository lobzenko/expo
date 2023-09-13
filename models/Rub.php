<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "db_rub".
 *
 * @property int $id_rub
 * @property string $name
 * @property int|null $state
 */
class Rub extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'db_rub';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['state'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_rub' => 'ID',
            'name' => 'Название',
            'state' => 'Активно',
        ];
    }

    public static function getStates($state =0)
    {
        $states = [
            1=>'Активный',
            0=>'Не активный',
        ];

        if (empty($state))
            return $states;

        return $states[$state]?:'Неизвестный статус';
    }

    public function getStateLabel()
    {
        switch ($this->state) {
            case 1:
                return '<span class="badge rounded-pill bg-success font-size-12">Активный</span>';
                break;
            case 0:
                return '<span class="badge rounded-pill bg-dark font-size-12">Не активный</span>';
                break;
            default:
                return '<span class="badge rounded-pill bg-light font-size-12">Статус не определен</span>';
                break;
        }
    }
}
