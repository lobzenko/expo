<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "db_search".
 *
 * @property int $id_search
 * @property string|null $title
 * @property string $content
 * @property string|null $url
 */
class Search extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'db_search';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'required'],
            [['content'], 'string'],
            [['url'], 'unique'],
            [['title', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_search' => 'Id Search',
            'title' => 'Title',
            'content' => 'Content',
            'url' => 'Url',
        ];
    }
}
