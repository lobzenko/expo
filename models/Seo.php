<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "seo_date".
 *
 * @property int $id_seo
 * @property int $type
 * @property string $title
 * @property string $descritpion
 * @property string $text
 * @property string $url
 */
class Seo extends \yii\db\ActiveRecord
{
    const INPUT = 1;
    const AREA = 2;
    const RICHTEXT = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seo_date';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type'], 'integer'],
            [['text','name'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_seo' => 'Id Seo',
            'type' => 'Тип',
            'name' => 'Алиас',
            'title' => 'Заголовок',
            'text' => 'Значение',
        ];
    }
}
