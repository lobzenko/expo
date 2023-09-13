<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "db_subplace".
 *
 * @property int $id_subplace
 * @property int|null $id_place
 * @property int|null $id_media
 * @property string $name
 * @property int|null $price
 * @property int|null $price_type
 * @property int|null $area
 * @property string|null $capacity
 * @property string|null $comment
 */
class Subplace extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'db_subplace';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_place', 'id_media', 'price', 'area'], 'integer'],
            [['name'], 'required'],
            [['comment'], 'string'],
            [['name', 'capacity', 'price_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_subplace' => 'ID',
            'id_place' => 'Id Place',
            'id_media' => 'Id Media',
            'name' => 'Название',
            'price' => 'Цена',
            'price_type' => 'Цена за',
            'area' => 'Площадь',
            'capacity' => 'Вместимость',
            'comment' => 'Дополнение',
        ];
    }


    public function getMedia()
    {
        return $this->hasOne(Media::className(), ['id_media' => 'id_media']);
    }

    public function getMedias()
    {
        return $this->hasMany(Media::class, ['id_media' => 'id_media'])->viaTable('cntl_media_subplace',['id_subplace'=>'id_subplace']);
    }

    public function behaviors()
    {
        return [
            'multiupload' => [
                'class' => \app\extensions\multifile\MultiUploadBehavior::className(),
                'relations'=>
                [
                    'medias'=>[
                        'model'=>'Media',
                        'jtable'=>'cntl_media_subplace',
                        'fk_cover' => 'id_media',
                        'cover' => 'media',
                    ],
                ],
                'cover'=>'media'
            ],
        ];
    }

    public function getPlace()
    {
        return $this->hasOne(Place::className(), ['id_place' => 'id_place']);
    }
}
