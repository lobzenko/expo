<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "db_place".
 *
 * @property int $id_place
 * @property int|null $id_media
 * @property string $name
 * @property string|null $address
 * @property string|null $coords
 * @property string|null $area
 * @property int|null $capacity
 * @property float|null $price
 * @property int|null $state
 * @property int|null $order
 */
class Place extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'db_place';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_media', 'capacity', 'state', 'order','template'], 'integer'],
            [['name'], 'required'],
            [['price'], 'number'],
            [['name', 'address', 'latitude','longitude', 'area'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_place' => 'ID',
            'id_media' => 'Id Media',
            'name' => 'Название',
            'address' => 'Адрес',            
            'area' => 'Площадь  ',
            'capacity' => 'Вместимость',
            'price' => 'Минимальная цена',
            'state' => 'Статус',
            'order' => 'Порядок',
            'template'=>'Шаблон',
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

    public function getUrl()
    {
        return '/place/'.$this->id_place;
    }

    public function getMedia()
    {
        return $this->hasOne(Media::className(), ['id_media' => 'id_media']);
    }

    public function behaviors()
    {
        return [
            'yiinput' => [
                'class' => \app\extensions\yiinput\RelationBehavior::class,
                'relations'=> [
                    'rubs'=>[
                        'modelname'=>'Rub',
                        'jtable'=>'dbl_rub_place',
                        'added'=>false,
                    ],
                ]
            ],
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

    public function getSubplaces()
    {
        return $this->hasMany(Subplace::className(), ['id_place' => 'id_place']);
    }

    public function getRubs()
    {
        return $this->hasMany(Rub::className(), ['id_rub' => 'id_rub'])->viaTable('dbl_rub_place',['id_place'=>'id_place']);
    }

    public function getBlocks()
    {
        return $this->hasMany(Block::class, ['id_place' => 'id_place'])->orderBy('ord ASC');
    }
    
    public function getSeos()
    {
        return $this->hasMany(Seo::className(), ['id_object' => 'id_place'])->where(['model'=>'Place']);
    }
}
