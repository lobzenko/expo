<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cnt_block_var".
 *
 * @property int $id_var
 * @property int $id_block
 * @property int $id_media
 * @property int $type
 * @property string $name
 * @property string $alias
 * @property string $value
 */
class BlockVar extends \yii\db\ActiveRecord
{
    const TYPE_STRING = 1;
    const TYPE_MENU = 2;
    const TYPE_TEXT = 3;
    const TYPE_RICHTEXT = 4;
    const TYPE_MEDIA = 5;
    const TYPE_MEDIAS = 6;
    const TYPE_HIDDEN = 7;
    const TYPE_QUESTION = 8;
    const TYPE_PAGE = 9;    
    const TYPE_CHECKBOX = 11;
    const TYPE_DATE = 12;
    const TYPE_USER = 14;
    const TYPE_SELECT = 15;    
    const TYPE_COLOR = 18;
    const TYPE_SERVICE = 19;
    

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cnt_block_var';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_block', 'id_media', 'type'], 'default', 'value' => null],
            [['id_block', 'id_media', 'type'], 'integer'],
            [['value'], 'safe'],
            [['name', 'alias'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_var' => 'Id Var',
            'id_block' => 'Id Block',
            'id_media' => 'Id Media',
            'type' => 'Тип',
            'name' => 'Имя',
            'alias' => 'Alias',
            'value' => 'Значение',
        ];
    }

    public function getMedia()
    {
        return $this->hasOne(Media::className(), ['id_media' => 'id_media']);
    }

    public function getMedias()
    {
        return $this->hasMany(Media::className(), ['id_media' => 'id_media'])->viaTable('dbl_block_var_media', ['id_var' => 'id_var']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert))
        {
            if (is_array($this->value))
                $this->value = json_encode($this->value);

            return true;
        }
        else
            return false;
    }

    public function __toString()
    {
        return $this->value;
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
                    'medias'=>[
                        'model'=>'Media',
                        'fk_cover' => 'id_media',
                        'cover' => 'media',
                        'jtable'=>'dbl_block_var_media',
                    ],
                ],
                'cover'=>'media'
            ],
        ];
    }
}
