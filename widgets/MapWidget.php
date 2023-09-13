<?php
namespace app\widgets;

use yii\base\Widget;
use common\models\Point;
use common\models\Violation;

class MapWidget extends Widget
{
    public $attributes = [];

    public $defaultOptions = [
        'width' => '100%',
        'height' => '300px',
        'zoom' => 14,
        'center_x' => '56.010563',
        'center_y' => '92.852572'
    ];

    public $point;
    public $points;
    public $model;
    public $id_user;
    public $date;
    public $violations;
    public $objectData;

    public function run()
    {        
        $points = [$this->point];

        $this->defaultOptions['center_x'] = $this->point['x'];
        $this->defaultOptions['center_y'] = $this->point['y'];

        if (empty($this->defaultOptions['center_y']))
        {
            $this->defaultOptions['center_y'] = '92.89325';
            $this->defaultOptions['center_x'] = '56.01528';
        }

        return $this->render('map',[
            'uniq_id'=>time().rand(0,9999),
            'points'=> $points,
            'options' => $this->defaultOptions,
            'is_editable'=>!empty($this->model)?'true':'false'
        ]);
    }
}
