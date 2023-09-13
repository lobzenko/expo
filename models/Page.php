<?php

namespace app\models;

use Yii;
use creocoder\nestedsets\NestedSetsBehavior;
/**
 * This is the model class for table "cnt_page".
 *
 * @property integer $id_page
 * @property integer $id_parent
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $text
 * @property string $alias
 * @property integer $hidemenu
 * @property integer $ord
 * @property integer $secure
 */
class Page extends \yii\db\ActiveRecord
{
    const templates = [
        0=>'Обычная страница',
        1=>'Страница Компании',
    ];

    public function getVarsByTemplate()
    {
        $vars = [
            1=>[
                'contact'=>[
                    'name'=>'Контакты',
                    'type'=>Vars::TYPE_TEXT,
                ],
                'bank_info'=>[
                    'name'=>'Банковские реквизиты',
                    'type'=>Vars::TYPE_TEXT,
                ],
                'partners'=>[
                    'name'=>'Партнеры',
                    'type'=>Vars::TYPE_MENU,
                ]
            ]
        ];

        if (isset($vars[$this->template]))
        {
            $models = $this->getVars()->indexBy('alias')->all();
            $output = [];

            foreach ($vars[$this->template] as $key => $var)
            {
                if (!isset($models[$key.'_'.$this->id]))
                {
                    $newVar = new Vars;
                    $newVar->name = $var['name'];
                    $newVar->id_page = $this->id;
                    $newVar->alias = $key.'_'.$this->id;
                    $newVar->type = $var['type'];
                    $newVar->content = '';
                    $newVar->save();

                    $output[$newVar->id_var] = $output;
                }
                else
                    $output[$models[$key.'_'.$this->id]->id_var] = $models[$key.'_'.$this->id];
            }

            return $output;
        }
        else
            return false;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cnt_page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','alias'],'required'],
            [['id_parent', 'hidemenu', 'ord', 'secure', 'enabled','template'], 'integer'],
            [['description', 'content'], 'string'],
            [['title', 'keywords', 'alias'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            
            'id_parent' => 'Родительский элемент',
            'title' => 'Название',
            'description' => 'Описание',
            'keywords' => 'Keywords',
            'content' => 'Содержимое',
            'alias' => 'URL',
            'hidemenu' => 'Скрыть в меню',
            'ord' => 'Ord',
            'secure' => 'Delete protected',
            'enabled' => 'Активно',
            'template'=> 'Шаблон',
        ];
    }    

    public function getUrl()
    {
        return $this->alias;
    }
    
    public function getVars()
    {
        return $this->hasMany(Vars::className(), ['id_page' => 'id']);
    }

    public function getVar($alias)
    {
        $var = Vars::find()->where(['alias'=>$alias.'_'.$this->id])->one();

        if (!empty($var))
            return $var->getFormatValue();

        return null;
    }

    public function getBlocks()
    {
        return $this->hasMany(Block::class, ['id_page' => 'id'])->orderBy('ord ASC');
    }
    
    public function getSeos()
    {
        return $this->hasMany(Seo::className(), ['id_object' => 'id'])->where(['model'=>'Page']);
    }

    public function behaviors()
    {
        return [
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
                    'bottom-text'=>[
                        'type'=>Seo::RICHTEXT,
                        'title' => 'SEO текст внизу',
                    ],
                ],
            ],
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                // 'treeAttribute' => 'tree',
                // 'leftAttribute' => 'lft',
                // 'rightAttribute' => 'rgt',
                // 'depthAttribute' => 'depth',
            ],
        ];
    } 

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find()
    {
        return new PageQuery(get_called_class());
    }


    public function afterSave($insert,$changedAttributes)
    {
        if (!empty($changedAttributes['alias']) || $insert)
        {
            $parents = $this->parents()->all();

            $url = [];
               
            foreach ($parents as $parent)
                $url[] = $parent->alias;

            $url[] = $this->alias;

            array_shift($url);

            $oldUrl = $this->url;

            $this->url = '/'.implode('/',$url);

            $this->updateAttributes(['url',$this->url]);

            $sql = "UPDATE cnt_page SET url = REPLACE(url,'$oldUrl','$this->url') WHERE id = ".$this->id;
            Yii::$app->db->createCommand($sql)->execute();
        }

        parent::afterSave($insert, $changedAttributes);    

        return true;
    }
}
