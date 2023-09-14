<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "db_event".
 *
 * @property int $id_event
 * @property int|null $id_media
 * @property string $name
 * @property int $date_begin
 * @property int $date_end
 * @property int|null $state
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'db_event';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_media', 'state'], 'integer'],
            [['name', 'date_begin', 'date_end'], 'required'],
            [['name','description'], 'string', 'max' => 255],
            [['date_begin', 'date_end','content'],'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_event' => 'ID',
            'id_media' => 'Id Media',
            'name' => 'Название',
            'description' => 'Описание',
            'content' => 'Содержание',
            'date_begin' => 'Дата начала',
            'date_end' => 'Дата конца',
            'state' => 'Статус',
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

    public function beforeValidate()
    {
        $this->alias = strtolower(\app\helpers\helper\Helper::transFileName($this->name));

        if (!empty($this->date_begin) && !is_numeric($this->date_begin))
            $this->date_begin = strtotime($this->date_begin);

        if (!empty($this->date_end) && !is_numeric($this->date_end))
            $this->date_end = strtotime($this->date_end);

        return parent::beforeValidate();
    }

    public function getUrl()
    {
        return '/event/'.$this->alias;
    }

    public function getMedia()
    {
        return $this->hasOne(Media::className(), ['id_media' => 'id_media']);
    }

    public function getSeos()
    {
        return $this->hasMany(Seo::className(), ['id_object' => 'id_event'])->where(['model'=>'Event']);
    }

    public function getRubs()
    {
        return $this->hasMany(Rub::className(), ['id_rub' => 'id_rub'])->viaTable('dbl_rub_event',['id_event'=>'id_event']);
    }

    public function getBlocks()
    {
        return $this->hasMany(Block::class, ['id_event' => 'id_event'])->orderBy('ord ASC');
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
            'yiinput' => [
                'class' => \app\extensions\yiinput\RelationBehavior::class,
                'relations'=> [
                    'rubs'=>[
                        'modelname'=>'Rub',
                        'jtable'=>'dbl_rub_event',
                        'added'=>false,
                    ],
                ]
            ],

            'seo' => [
                'class' => \app\extensions\seo\SeoBehavior::className(),
                'seofields'=>
                [
                    'title'=>[
                        'type'=>Seo::INPUT,
                        'title' => 'SEO заголовок',
                    ],
                    'description'=>[
                        'type'=>Seo::AREA,
                        'title' => 'SEO описание',
                    ],
                ],
            ],
        ];
    }
}
