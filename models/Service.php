<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "db_service".
 *
 * @property int $id_service
 * @property int|null $id_media
 * @property int|null $state
 * @property string $name
 * @property int|null $ord
 * @property string|null $description
 */
class Service extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'db_service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_media', 'state', 'ord'], 'integer'],
            [['name'], 'required'],
            [['name', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_service' => 'ID',
            'id_media' => 'Id Media',
            'state' => 'Статус',
            'name' => 'Название',
            'ord' => 'Порядок',
            'description' => 'Описание',
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

    public function getMedia()
    {
        return $this->hasOne(Media::className(), ['id_media' => 'id_media']);
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
                ],
                'cover'=>'media'
            ],
        ];
    }
}
