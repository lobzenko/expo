<?php
namespace app\modules\master\components;

use yii\base\Widget;
use app\models\User;
use app\models\Lot;
use app\models\Order;
use app\models\Reserve;
use Yii;

class NavMenuWidget extends Widget
{
	public $menu = [
		'page'=>[
			'title'=>'Структура',
			'icon'=>'bx-sitemap',			
			'submenu'=>[
				'page'=>[
					'title'=>'Страницы',
				],				
				'service'=>[
					'title'=>'Услуги',
				],
				'event'=>[
					'title'=>'События',
					'icon'=>'bx-flag',
				],
				'personal'=>[
					'title'=>'Сотрудники',
				],
			],
		],
		'place'=>[
			'title'=>'Площадки',
			'icon'=>'bx-map',			
			'submenu'=>[
				'place'=>[
					'title'=>'Площадки',
				],
				'rub'=>[
					'title'=>'Типы',
				],
			],
		],		
		'order'=>[
			'title'=>'Заявки',
			'icon'=>'bx-briefcase-alt-2',
		],
		'response'=>[
			'title'=>'Отзывы',
			'icon'=>'bx-mail-send',
		],
		'user'=>[
			'title'=>'Пользователи',
			'icon'=>'bx bx-user',
		],		
		'vars'=>[
			'title'=>'Система',
			'icon'=>'bx bx-cog',
			'submenu'=>[
				'menu'=>[
					'title'=>'Меню и списки',
				],				
				/*'seo'=>[
					'title'=>'Seo тексты',
				],*/
				'vars'=>[
					'title'=>'Переменные',
				],
				/*'vars/sitemap'=>[
					'title'=>'Обновить сайтмап',
				],*/
			]
		]
	];

    public function run()
    {
    	$user = User::findOne(Yii::$app->user->identity->id_user);

		return $this->render('navmenu',[
			'menu'=>$this->menu,
			'user'=>$user,
			'active_url'=>str_replace('/master/','',Yii::$app->request->url)
		]);
	}
}
?>