<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cnt_vars".
 *
 * @property integer $id_var
 * @property string $name
 * @property string $alias
 * @property string $content
 * @property string $type
 * @property string $options
 */
class Vars extends \yii\db\ActiveRecord
{

    const TYPE_TEXT = 0;
    //const TYPE_BANNER = 1;
    const TYPE_MENU = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cnt_vars';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'alias'], 'required'],
            [['content'], 'string'],
            [['name', 'alias'], 'string', 'max' => 255],
            [['alias'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_var' => 'Id Var',
            'name' => 'Название',
            'alias' => 'Alias',
            'content' => 'Содержание',
            //'type' => 'Type',
            //'options' => 'Options',
        ];
    }


    public function getFormatValue()
    {
        if ($this->type == self::TYPE_TEXT)
            return $this->content;

        if ($this->type == self::TYPE_MENU)
        {
            $menu = Menu::find()->where(['id_menu'=>$this->content])->one();
            return $menu;
        }
    }

     public static function getVar($alias)
    {
        $cache = Yii::$app->cache;

        $output = $cache->get("var_$alias");

        if (!empty($output))
            return $output;

        $var = Vars::find()->where([
            'alias'=>$alias,
        ])->one();

        if (empty($var))
        {
            $var = new Vars;
            $var->alias = $alias;
            $var->name = $alias;
            $var->content = '';
            $var->save();
        }

        $cache->add("var_$alias", $var->content, 365*24*3600);

        return $var->content;
    }
}
