<?php 
    $this->registerJsFile('https://api-maps.yandex.ru/2.1/?apikey=470f45ee-814e-4da5-9963-50863e27985f&lang=ru_RU',['position'=>\yii\web\View::POS_END]);
    $uniq_id = substr(md5(time().rand(0,9999)),0,10);

    $points = [];
    foreach (app\models\Place::find()->all() as $key => $data) {
        $points[] = [
            'x'=>$data->latitude,
            'y'=>$data->longitude,
            'content'=>'<a href="'.$data->getUrl().'">'.$data->name.'</a>',
        ];
    }
?>
<div class="container py-5">
    <p class="pre-header"><?=$sub_title?></p>
    <h2 class="mb-5"><?=$title?></h2>    
    <div id="map<?=$uniq_id?>" style="height: 400px;"></div>

<?php

$jsonPoints = json_encode($points);

$script = <<< JS
    var map$uniq_id;

    function updatePoints(mapObject, pointsArray)
    {
        mapObject.geoObjects.removeAll();

        for (let counter = 0; counter < pointsArray.length; counter++)
        {
            let pointTemp  = new ymaps.Placemark([pointsArray[counter]['x'], pointsArray[counter]['y']], {
                    balloonContentBody: pointsArray[counter]['content'],
                }, {
                    preset: pointsArray[counter]['icon']
                });
            mapObject.geoObjects.add(pointTemp);
        }

        mapObject.setBounds(mapObject.geoObjects.getBounds());
    }

    ymaps.ready(init);

    function init () {
        map$uniq_id = new ymaps.Map('map$uniq_id', {
            center: [0, 0],
            zoom: 10,
            controls: ['smallMapDefaultSet']
        }, {
            searchControlProvider: 'yandex#search'
        });

        updatePoints(map$uniq_id, $jsonPoints)
    }
JS;

$this->registerJs($script, yii\web\View::POS_END);
?>
</div>