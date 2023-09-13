<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "db_menu".
 *
 * @property int $id_menu
 * @property string $name
 * @property string $alias
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'db_menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'alias'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_menu' => 'ID',
            'name' => 'Название',
            'alias' => 'Alias',
        ];
    }

    public function getElements()
    {
        return $this->hasMany(MenuElement::class, ['id_menu' => 'id_menu'])->orderBy('ord ASC');
    }

    public function getActiveElements()
    {
        return $this->hasMany(MenuElement::class, ['id_menu' => 'id_menu'])->orderBy('ord ASC')->andWhere(['active'=>1]);
    }
}
