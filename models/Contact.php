<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "db_contact".
 *
 * @property int $id_contact
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string|null $firm
 * @property string|null $comment
 * @property int|null $created_at
 * @property string|null $url
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'db_contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'email'], 'required'],
            [['comment'], 'string'],
            [['created_at'], 'integer'],
            [['name', 'phone', 'firm', 'url'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_contact' => 'Id Contact',
            'name' => 'Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'firm' => 'Firm',
            'comment' => 'Comment',
            'created_at' => 'Created At',
            'url' => 'Url',
        ];
    }
}
