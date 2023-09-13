<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "db_banner".
 *
 * @property int $id_banner
 * @property string $name
 * @property int $place
 * @property string $code
 * @property int $show
 */
class Banner extends \yii\db\ActiveRecord
{
    const PLACE_MAIN = 0;

    public $places = [
        0=>'На сайте',
        1=>'Учебный центр',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'db_banner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['place', 'show','ord'], 'integer'],
            [['code','url'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_banner' => 'ID',
            'name' => 'Название',
            'place' => 'Место',
            'url' => 'URL',
            'code' => 'Код',
            'show' => 'Активный',
            'ord' => 'Порядок',
        ];
    }

    public function getMedia()
    {
        return $this->hasOne(Media::className(), ['id_media' => 'id_media']);
    }

    public function getMediaMobile()
    {
        return $this->hasOne(Media::className(), ['id_media' => 'id_media_mobile']);
    }

    public function behaviors()
    {
        return [
            'multiupload' => [
                'class' => \app\extensions\multifile\MultiUploadBehavior::className(),
                'relations'=>
                [
                    'media'=>[
                        'model'=>'Media',
                        'fk_cover' => 'id_media',
                        'cover' => 'media',
                    ],
                    'mediaMobile'=>[
                        'model'=>'Media',
                        'fk_cover' => 'id_media_mobile',
                        'cover' => 'mediaMobile',
                    ],
                ],
                'cover'=>'media'
            ],
        ];
    }
}
