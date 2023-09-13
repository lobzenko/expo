<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "db_menu_element".
 *
 * @property int $id_element
 * @property int $id_media
 * @property int $id_menu
 * @property string $name
 * @property int $ord
 * @property int $description
 */
class MenuElement extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'db_menu_element';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ord'], 'default', 'value' => 0],
            [['id_media', 'id_menu', 'ord', 'active'], 'integer'],
            [['name'], 'required'],
            [['emojie'],'safe'],
            [['name','url','description'], 'string', 'max' => 255],
        ];
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


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_element' => 'ID',
            'id_media' => 'Id Media',
            'id_menu' => 'Id Menu',
            'name' => 'Название',
            'active' => 'Активно',
            'url' => 'Url',
            'ord' => 'Порядок',
            'description' => 'Описание',
            'emojie'=> 'Иконка',
        ];
    }

    public function afterSave($insert,$changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $sql = "UPDATE db_menu_element SET ord = ord + 1 WHERE ord >= $this->ord AND id_menu = $this->id_menu AND id_element <> $this->id_element";

        Yii::$app->db->createCommand($sql)->execute();

        return true;
    }

    public function getMedia()
    {
        return $this->hasOne(Media::className(), ['id_media' => 'id_media']);
    }
}
