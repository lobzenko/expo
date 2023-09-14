<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "db_block".
 *
 * @property int $id_block
 * @property int $id_page 
 * @property int $state
 * @property int $ord
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 * @property int $deleted_at
 * @property int $deleted_by
 */
class Block extends \yii\db\ActiveRecord
{
    public $blocks = [
        'big_banner'=> [
            'label'=>'Большой баннер',
            'vars'=>[
                'title'=>[
                    'name'=>'Заголовок',
                    'type'=>BlockVar::TYPE_STRING,
                ],
                'link'=>[
                    'name'=>'Ссылка',
                    'type'=>BlockVar::TYPE_STRING,
                ],
                'button'=>[
                    'name'=>'Подпись кнопки',
                    'type'=>BlockVar::TYPE_STRING,
                ],
                'image'=>[
                    'name'=>'Изображение',
                    'type'=>BlockVar::TYPE_MEDIA,
                ],
            ],
        ],
        '3column'=> [
            'label'=>'3 колонки с изображениями и ссылкой',
            'vars'=>[
                'sub_title'=>[
                    'name'=>'Подзаголовок',
                    'type'=>BlockVar::TYPE_STRING,
                ],
                'title'=>[
                    'name'=>'Заголовок',
                    'type'=>BlockVar::TYPE_STRING,
                ],
                'description'=>[
                    'name'=>'Описание',
                    'type'=>BlockVar::TYPE_RICHTEXT,
                ],
                'link'=>[
                    'name'=>'Ссылка',
                    'type'=>BlockVar::TYPE_STRING,
                ],
                'link_title'=>[
                    'name'=>'Заголовок ссылки   ',
                    'type'=>BlockVar::TYPE_STRING,
                ],
                'image'=>[
                    'name'=>'Изображение вторая колонка',
                    'type'=>BlockVar::TYPE_MEDIA,
                ],
                'image2'=>[
                    'name'=>'Изображение третья колонка',
                    'type'=>BlockVar::TYPE_MEDIA,
                ],
            ],
        ],
        '3column_reverse'=> [
            'label'=>'3 колонки с 2 изображениями',
            'vars'=>[
                'sub_title'=>[
                    'name'=>'Подзаголовок',
                    'type'=>BlockVar::TYPE_STRING,
                ],
                'title'=>[
                    'name'=>'Заголовок',
                    'type'=>BlockVar::TYPE_STRING,
                ],
                'description'=>[
                    'name'=>'Описание',
                    'type'=>BlockVar::TYPE_RICHTEXT,
                ],                
                'image'=>[
                    'name'=>'Изображение первая колонка',
                    'type'=>BlockVar::TYPE_MEDIA,
                ],
                'image2'=>[
                    'name'=>'Изображение вторая колонка',
                    'type'=>BlockVar::TYPE_MEDIA,
                ],
            ],
        ],
        '2column'=> [
            'label'=>'2 колонки текст с подложкой',
            'vars'=>[
                'sub_title'=>[
                    'name'=>'Подзаголовок',
                    'type'=>BlockVar::TYPE_STRING,
                ],
                'title'=>[
                    'name'=>'Заголовок',
                    'type'=>BlockVar::TYPE_STRING,
                ],
                'column_left'=>[
                    'name'=>'Левая колонка',
                    'type'=>BlockVar::TYPE_RICHTEXT,
                ],                
                'column_right'=>[
                    'name'=>'Правая колонка',
                    'type'=>BlockVar::TYPE_RICHTEXT,
                ],
            ],
        ],
        '2column_image'=> [
            'label'=>'2 колонки с изображением',
            'vars'=>[
                'content'=>[
                    'name'=>'Текст',
                    'type'=>BlockVar::TYPE_RICHTEXT,
                ],
                'image'=>[
                    'name'=>'Изображение',
                    'type'=>BlockVar::TYPE_MEDIA,
                ],
                'align'=>[
                    'name'=>'Ориентация',
                    'type'=>BlockVar::TYPE_SELECT,
                    'values'=>[
                        'left'=>'Изображение слево',
                        'right'=>'Изображение справо'
                    ]
                ],
            ],
        ],
        'form'=> [
            'label'=>'Обратная свзязь',
            'vars'=>[
                'sub_title'=>[
                    'name'=>'Подзаголовок',
                    'type'=>BlockVar::TYPE_STRING,
                    'default'=>'Заявка',
                ],
                'title'=>[
                    'name'=>'Заголовок',
                    'type'=>BlockVar::TYPE_STRING,
                    'default'=>'ОБРАТНАЯ СВЯЗЬ',
                ],
            ],
            'widget'=>'app\widgets\FormWidget',
        ],
        'response'=> [
            'label'=>'Отзывы',
            'vars'=>[
                'sub_title'=>[
                    'name'=>'Подзаголовок',
                    'type'=>BlockVar::TYPE_STRING,                    
                ],
                'title'=>[
                    'name'=>'Заголовок',
                    'type'=>BlockVar::TYPE_STRING,
                ],
            ],
        ],
        'response_full'=> [
            'label'=>'Отзывы развернутые',
            'widget'=>'app\widgets\ResponseWidget',
        ],
        'map'=> [
            'label'=>'Карта площадок',
            'vars'=>[
                'sub_title'=>[
                    'name'=>'Подзаголовок',
                    'type'=>BlockVar::TYPE_STRING,
                ],
                'title'=>[
                    'name'=>'Заголовок',
                    'type'=>BlockVar::TYPE_STRING,                    
                ],
            ],
        ],
        'services'=> [
            'label'=>'Услуги',
            'vars'=>[
                'sub_title'=>[
                    'name'=>'Подзаголовок',
                    'type'=>BlockVar::TYPE_STRING,
                ],
                'title'=>[
                    'name'=>'Заголовок',
                    'type'=>BlockVar::TYPE_STRING,                    
                ],                
                'services'=>[
                    'name'=>'Услуги',
                    'type'=>BlockVar::TYPE_SERVICE,
                ],                
                'template'=>[
                    'name'=>'Вид отображения',
                    'type'=>BlockVar::TYPE_SELECT,
                    'values'=>[
                        'carousel'=>'Карусель',
                        'table'=>'Плитками'
                    ]
                ],
                'limit'=>[
                    'name'=>'Количество',
                    'type'=>BlockVar::TYPE_STRING,                    
                ],
                'background'=>[
                    'name'=>'Цвет фона',
                    'type'=>BlockVar::TYPE_STRING,                    
                ],
                'color'=>[
                    'name'=>'Цвет текста',
                    'type'=>BlockVar::TYPE_STRING,                    
                ],
                'background_image'=>[
                    'name'=>'Изображение фона',
                    'type'=>BlockVar::TYPE_MEDIA,                    
                ],
            ],
        ],
        'header'=> [
            'label'=>'Заголовок + Подзаголовок',
            'vars'=>[
                'sub_title'=>[
                    'name'=>'Подзаголовок',
                    'type'=>BlockVar::TYPE_STRING,
                ],
                'title'=>[
                    'name'=>'Заголовок',
                    'type'=>BlockVar::TYPE_STRING,                    
                ],
                'h'=>[
                    'name'=>'Тег заголовка',
                    'type'=>BlockVar::TYPE_SELECT,
                    'values'=>[
                        'h2'=>'H2',
                        'h1'=>'H1'
                    ]
                ],
            ],
        ],
        'events'=> [
            'label'=>'События',
            'widget'=>'app\widgets\EventWidget',
            'vars'=>[
                'sub_title'=>[
                    'name'=>'Подзаголовок',
                    'type'=>BlockVar::TYPE_STRING,
                ],
                'title'=>[
                    'name'=>'Заголовок',
                    'type'=>BlockVar::TYPE_STRING,                    
                ],
            ],
        ],
        'event'=> [
            'label'=>'Карусель событий',
            'vars'=>[
                'sub_title'=>[
                    'name'=>'Подзаголовок',
                    'type'=>BlockVar::TYPE_STRING,
                ],
                'title'=>[
                    'name'=>'Заголовок',
                    'type'=>BlockVar::TYPE_STRING,                    
                ],
                'limit'=>[
                    'name'=>'Количество',
                    'type'=>BlockVar::TYPE_STRING,                    
                ],
                'background'=>[
                    'name'=>'Цвет фона',
                    'type'=>BlockVar::TYPE_STRING,                    
                ],
                'color'=>[
                    'name'=>'Цвет текста',
                    'type'=>BlockVar::TYPE_STRING,                    
                ],
                'background_image'=>[
                    'name'=>'Изображение фона',
                    'type'=>BlockVar::TYPE_MEDIA,                    
                ],
            ],
        ],
        'places'=> [
            'label'=>'Карусель площадок',
            'vars'=>[
                'sub_title'=>[
                    'name'=>'Подзаголовок',
                    'type'=>BlockVar::TYPE_STRING,
                ],
                'title'=>[
                    'name'=>'Заголовок',
                    'type'=>BlockVar::TYPE_STRING,                    
                ],
                'limit'=>[
                    'name'=>'Количество',
                    'type'=>BlockVar::TYPE_STRING,                    
                ],
            ],
        ],
        'places_full'=> [
            'label'=>'Площадки с фильтром',
            'vars'=>[
                'sub_title'=>[
                    'name'=>'Подзаголовок',
                    'type'=>BlockVar::TYPE_STRING,
                ],
                'title'=>[
                    'name'=>'Заголовок',
                    'type'=>BlockVar::TYPE_STRING,                    
                ],
            ],
            'widget'=>'app\widgets\PlaceWidget',
        ],
        'personal'=> [
            'label'=>'Сотрудники',
            'vars'=>[
                'sub_title'=>[
                    'name'=>'Подзаголовок',
                    'type'=>BlockVar::TYPE_STRING,
                ],
                'title'=>[
                    'name'=>'Заголовок',
                    'type'=>BlockVar::TYPE_STRING,                    
                ],
                'limit'=>[
                    'name'=>'Количество',
                    'type'=>BlockVar::TYPE_STRING,                    
                ],
            ],
        ],
        'content'=> [
            'label'=>'Содержение страницы',
        ],
        'text_block'=> [
            'label'=>'Текстовый блок',
            'vars'=>[
                'content'=>[
                    'name'=>'Текст',
                    'type'=>BlockVar::TYPE_RICHTEXT,
                ],
            ]
        ],
        'html'=> [
            'label'=>'HTML блок',
            'vars'=>[
                'html'=>[
                    'name'=>'HTML',
                    'type'=>BlockVar::TYPE_RICHTEXT,
                ],
            ]
        ],
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cnt_block';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_page', 'ord'], 'default', 'value' => null],
            [['state'], 'default', 'value' => 1],
            [['id_page',  'state', 'ord'], 'integer'],
            [['type'], 'string'],            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_block' => 'ID',
            'id_page' => 'Раздел',            
            'state' => 'Активен',
            'type'=>'Тип блока',
            'ord' => 'Позиция',
        ];
    }

    public function getName()
    {
        //return $this->type;
        return $this->blocks[$this->type]['label'];
    }

    public function getTypesLabels($layout=false)
    {
        $types = [];

        foreach ($this->blocks as $key => $block)
        {
            if ($layout && !empty($block['layout']))
                $types[$key] = $block['label'];
            elseif (!$layout && empty($block['layout']))
                $types[$key] = $block['label'];
        }

        return $types;
    }

    public function getWidget()
    {
        if (!empty($this->blocks[$this->type]['widget']))
            return $this->blocks[$this->type]['widget'];

        return false;
    }

    public function getVars()
    {
        $exist_vars = $this->getBlockVars()->indexBy('alias')->all();

        $vars = [];

        foreach ($this->blocks[$this->type]['vars'] as $key => $var)
        {
            if (!isset($exist_vars[$key]))
            {
                $newVar = new BlockVar;
                $newVar->id_block = $this->id_block;
                $newVar->alias = $key;
                $newVar->type = $var['type'];
                $newVar->value = $var['default']??null;
                $newVar->name = $var['name'];

                if (isset($var['value']))
                    $newVar->value = $var['value'];

                $vars[$newVar->alias] = $newVar;
            }
            else
                $vars[$key] = $exist_vars[$key];
        }

        return $vars;
    }

    public function getBlockVars()
    {
        return $this->hasMany(BlockVar::className(), ['id_block' => 'id_block']);
    }

    public function getPage()
    {        
        if (!empty($this->id_event))
            return $this->hasOne(Event::class, ['id_event' => 'id_event']);
        else if (!empty($this->id_place))
            return $this->hasOne(Place::class, ['id_place' => 'id_place']);
        else     
            return $this->hasOne(Page::class, ['id' => 'id_page']);
    }

}
