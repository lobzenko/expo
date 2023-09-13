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
            'label'=>'3 колонки с изображениями',
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
                    'default'=>'Заявка',
                ],
                'title'=>[
                    'name'=>'Заголовок',
                    'type'=>BlockVar::TYPE_STRING,
                    'default'=>'ОБРАТНАЯ СВЯЗЬ',
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
                'template'=>[
                    'name'=>'Вид отображения',
                    'type'=>BlockVar::TYPE_SELECT,
                    'values'=>[
                        'carousel'=>'Карусель',
                        'table'=>'Плитками'
                    ]
                ],
                'limit'=>[
                    'name'=>'Количетсво',
                    'type'=>BlockVar::TYPE_STRING,                    
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
                    'name'=>'Количетсво',
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
                    'name'=>'Количетсво',
                    'type'=>BlockVar::TYPE_STRING,                    
                ],
            ],
        ],
        /*'footer'=> [
            'label'=>'Подвал сайта',
            'vars'=>[
                'menu'=>[
                    'name'=>'Меню',
                    'type'=>BlockVar::TYPE_MENU,
                ],
                'phone'=>[
                    'name'=>'Телефон/факс',
                    'type'=>BlockVar::TYPE_RICHTEXT,
                ],
                'address'=>[
                    'name'=>'Адрес',
                    'type'=>BlockVar::TYPE_RICHTEXT,
                ],
                'service_mail'=>[
                    'name'=>'Отдел служебных писем',
                    'type'=>BlockVar::TYPE_RICHTEXT,
                ],
                'people_request'=>[
                    'name'=>'Обращения граждан',
                    'type'=>BlockVar::TYPE_RICHTEXT,
                ],
                'trust_phone'=>[
                    'name'=>'Телефон доверия',
                    'type'=>BlockVar::TYPE_RICHTEXT,
                ],
            ],
            'layout'=>true,
        ],
        'news'=> [
            'label'=>'Новостной блок',
            'widget'=>'frontend\widgets\NewsWidget',
            'vars'=>[
                'title'=>[
                    'name'=>'Заголовок',
                    'type'=>BlockVar::TYPE_STRING,
                ],
                'menu'=>[
                    'name'=>'Меню в табах',
                    'type'=>BlockVar::TYPE_MENU,
                ],
            ]
        ],
        'news_single'=> [
            'label'=>'Новостной блок, без меню',
            'widget'=>'frontend\widgets\NewsWidget',
            'vars'=>[
                'title'=>[
                    'name'=>'Заголовок',
                    'type'=>BlockVar::TYPE_STRING,
                ],
                'button_text'=>[
                    'name'=>'Подпись кнопки',
                    'type'=>BlockVar::TYPE_STRING,
                ],
                'button_color'=>[
                    'name'=>'Цвет кнопки',
                    'type'=>BlockVar::TYPE_SELECT,
                    'values'=>[
                        ''=>'Белая',
                        'btn__primary'=>'Золотой'
                    ]
                ],
                'background'=>[
                    'name'=>'Фон',
                    'type'=>BlockVar::TYPE_SELECT,
                    'values'=>[
                        ''=>'Серый',
                        'press_invert'=>'Белый'
                    ]
                ],
                'id_page'=>[
                    'name'=>'Раздел новостей',
                    'type'=>BlockVar::TYPE_PAGE,
                ],
            ]
        ],
        'photoflip'=> [
            'label'=>'Гид по городу',
            'vars'=>[
                'title'=>[
                    'name'=>'Заголовок',
                    'type'=>BlockVar::TYPE_STRING,
                ],
                'menu'=>[
                    'name'=>'Меню',
                    'type'=>BlockVar::TYPE_MENU,
                ],
                'medias'=>[
                    'name'=>'Галерея',
                    'type'=>BlockVar::TYPE_MEDIAS,
                ]
            ]
        ],
        'poll'=> [
            'label'=>'Голосование',
            'widget'=> 'frontend\widgets\PollWidget',
            'vars'=>[
                'menu'=>[
                    'name'=>'Меню справо',
                    'type'=>BlockVar::TYPE_MENU,
                ],
                'id_poll_question'=>[
                    'name'=>'Вопрос для вывода',
                    'type'=>BlockVar::TYPE_QUESTION,
                ],
                'button'=>[
                    'name'=>'Подпись кнопки',
                    'type'=>BlockVar::TYPE_STRING,
                ],
                'button_url'=>[
                    'name'=>'Ссылка кнопки',
                    'type'=>BlockVar::TYPE_STRING,
                ],
            ]
        ],
        'video_section'=> [
            'label'=>'Видео блок',
            //'widget'=> 'frontend\widgets\ServiceSearchWidget',
            'vars'=>[
                'name'=>[
                    'name'=>'Название',
                    'type'=>BlockVar::TYPE_STRING,
                ],
                'cover'=>[
                    'name'=>'Обложка',
                    'type'=>BlockVar::TYPE_MEDIA,
                ],
                'youtube'=>[
                    'name'=>'Ссылка Youtube',
                    'type'=>BlockVar::TYPE_STRING,
                ],
            ]
        ],
        'event_blockquote'=> [
            'label'=>'Цитата',
            'vars'=>[
                'title'=>[
                    'name'=>'Заголовок',
                    'type'=>BlockVar::TYPE_STRING,
                ],
                'content'=>[
                    'name'=>'Описание',
                    'type'=>BlockVar::TYPE_RICHTEXT,
                ],
                
            ]
        ],        
        'event_programm'=> [
            'label'=>'Программа мероприятия',
            'vars'=>[
                'collection'=>[
                    'name'=>'Список',
                    'type'=>BlockVar::TYPE_RICHTEXT,
                ],
            ]
        ],
        'event_main'=> [
            'label'=>'Шапка события',
            'vars'=>[
                'title'=>[
                    'name'=>'Заголовок',
                    'type'=>BlockVar::TYPE_STRING,
                ],
                'cover'=>[
                    'name'=>'Обложка',
                    'type'=>BlockVar::TYPE_MEDIAS,
                ],
                'cover_mobile'=>[
                    'name'=>'Обложка мобильная',
                    'type'=>BlockVar::TYPE_MEDIAS,
                ],
                'content'=>[
                    'name'=>'Описание',
                    'type'=>BlockVar::TYPE_STRING,
                ],
                'countdown_title'=>[
                    'name'=>'Заголовок обратного отсчета',
                    'type'=>BlockVar::TYPE_STRING,
                ],
                'countdown'=>[
                    'name'=>'Дата начала',
                    'type'=>BlockVar::TYPE_DATE,
                ],
                
                'id_page'=>[
                    'name'=>'Раздел для программ мероприятий',
                    'type'=>BlockVar::TYPE_PAGE,
                ],
                'background'=>[
                    'name'=>'Подложка под текст',
                    'type'=>BlockVar::TYPE_CHECKBOX,
                ],
            ]
        ],
        'service_search'=> [
            'label'=>'Поиск муниципальных услуг',
            'widget'=> 'frontend\widgets\ServiceSearchWidget',
            'vars'=>[
                'title'=>[
                    'name'=>'Заголовок',
                    'type'=>BlockVar::TYPE_STRING,
                ],
                'services'=>[
                    'name'=>'Слайды сервисов',
                    'type'=>BlockVar::TYPE_MENU,
                ],
            ]
        ],
        'service_menu'=> [
            'label'=>'Жизненные ситуации',
            'widget'=> 'frontend\widgets\ServiceSituationWidget',
            'vars'=>[
                'bytype'=>[
                    'name'=>'Разделение на Юр/Физ лица',
                    'type'=>BlockVar::TYPE_CHECKBOX,
                ],
            ]
        ],
        'partners'=> [
            'label'=>'Партнеры',
            'widget'=>'frontend\widgets\MenuWidget',
            'vars'=>[
                'menu'=>[
                    'name'=>'Партнеры',
                    'type'=>BlockVar::TYPE_MENU,
                ],
                'template'=>[
                    'name'=>'Шаблон',
                    'type'=>BlockVar::TYPE_SELECT,
                    'values'=>[
                        'partners'=>'Как блок на странице',
                        'partners_full'=>'На всю страницу'
                    ]
                ],
            ]
        ],
        'grid'=> [
            'label'=>'Сетка ссылок',
            'widget'=>'frontend\widgets\MenuWidget',
            'vars'=>[
                'menu'=>[
                    'name'=>'Меню',
                    'type'=>BlockVar::TYPE_MENU,
                ],
                'template'=>[
                    'name'=>'Шаблон',
                    'type'=>BlockVar::TYPE_HIDDEN,
                    'value'=>'grid'
                ],
            ]
        ],
        'tabs'=> [
            'label'=>'Белый блок с табами',
            'widget'=>'frontend\widgets\MenuWidget',
            'vars'=>[
                'menu'=>[
                    'name'=>'Меню',
                    'type'=>BlockVar::TYPE_MENU,
                ],
            ]
        ],
        'events'=> [
            'label'=>'Городские проекты и события',
            'widget'=>'frontend\widgets\ProjectWidget',
            'vars'=>[
                'title'=>[
                    'name'=>'Заголовок',
                    'type'=>BlockVar::TYPE_STRING,
                ],
                'id_page'=>[
                    'name'=>'Раздел',
                    'type'=>BlockVar::TYPE_PAGE,
                ],
            ]
        ],
        */
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
        if (!empty($this->id_service))
            return $this->hasOne(Service::class, ['id_service' => 'id_service']);
        else if (!empty($this->id_place))
            return $this->hasOne(Place::class, ['id_place' => 'id_place']);
        else     
            return $this->hasOne(Page::class, ['id' => 'id_page']);
    }

}
