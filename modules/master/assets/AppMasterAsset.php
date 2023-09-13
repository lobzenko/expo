<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\master\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppMasterAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        '/css/admin/bootstrap.min.css',
        '/libs/select2/css/select2.min.css',
        "/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css",
        '/css/admin/icons.min.css',
        '/css/admin/app.min.css',
        '/js/fancybox/jquery.fancybox.min.css',
        '/css/admin/admin.css?3',
    ];
    public $js = [
        '/libs/select2/js/select2.min.js?v=10',
        '/js/fancybox/jquery.fancybox.min.js',
        "/libs/bootstrap/js/bootstrap.bundle.min.js",
        "/libs/metismenu/metisMenu.min.js",
        "/libs/simplebar/simplebar.min.js",
        "/libs/tinymce/tinymce.min.js",
        "/libs/node-waves/waves.min.js",        
        "/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js",
        "/libs/bootstrap-datepicker/locales/bootstrap-datepicker.ru.min.js",
        '/js/admin.js?v=14',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
        'yii\jui\JuiAsset',
    ];
}
