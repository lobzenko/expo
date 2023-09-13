<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "db_response".
 *
 * @property int $id
 * @property string|null $author
 * @property string|null $content
 * @property int|null $state
 * @property int|null $created_at
 */
class Response extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'db_response';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author','content'], 'required'],
            [['content'], 'string'],
            [['state', 'created_at'], 'integer'],
            [['author'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author' => 'Автор',
            'content' => 'Содержание',
            'state' => 'Активен',
            'created_at' => 'Дата',
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
