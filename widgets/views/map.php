<?php
use yii\helpers\Html;

$this->registerJsFile('https://api-maps.yandex.ru/2.1/?apikey=470f45ee-814e-4da5-9963-50863e27985f
&lang=ru_RU',['depends'=>[\yii\web\JqueryAsset::className()],'position'=>\yii\web\View::POS_END]);
$uniq_id = substr(md5(time().rand(0,9999)),0,10);
?>
<div id="map<?=$uniq_id?>" style="width: <?=$options['width']?>; height: <?=$options['height']?>"></div>

<?php

$jsonPoints = json_encode($points);

$script = <<< JS
    var map$uniq_id;

    function createPlacemark(coords) {
        return new ymaps.Placemark(coords, {
        }, {
            preset: 'islands#redDotIcon',
            draggable: true
        });
    }
    

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
    }

    ymaps.ready(init);

    function init () {
        map$uniq_id = new ymaps.Map('map$uniq_id', {
            center: [{$options['center_x']}, {$options['center_y']}],
            zoom: {$options['zoom']},
            controls: ['smallMapDefaultSet']
        }, {
            searchControlProvider: 'yandex#search'
        });

        if ($is_editable)
        {
            map$uniq_id.events.add('click', function (e) {
                map$uniq_id.geoObjects.each(function(mark){
                    map$uniq_id.geoObjects.remove(mark);
                });

                let coords = e.get('coords');        

                var myPlacemark = createPlacemark(coords);
                map$uniq_id.geoObjects.add(myPlacemark);

                $("#place-latitude").val(coords[0]);
                $("#place-longitude").val(coords[1]);

                if ($("#place-address").val()=='')
                {
                    ymaps.geocode(coords).then(function (res) {
                        var firstGeoObject = res.geoObjects.get(0);

                        var address = '';
                        var street = firstGeoObject.getThoroughfare() || firstGeoObject.getPremise();

                        if (street)
                            address += street;

                        var house = firstGeoObject.getPremiseNumber();

                        if (house)
                            address += ', '+house;

                        $("#place-address").val(address);
                    });
                }
            });
        }

        updatePoints(map$uniq_id, $jsonPoints)
    }
JS;

$this->registerJs($script, yii\web\View::POS_END);
