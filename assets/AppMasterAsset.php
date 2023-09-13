<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

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
        'inspinia/css/plugins/select2/select2.min.css',
        'inspinia/font-awesome/css/font-awesome.css',
        'inspinia/css/animate.css',
        'inspinia/css/plugins/toastr/toastr.min.css',
        'inspinia/css/style.css',
        'js/redactor/redactor.css',
        'inspinia/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css',
        'js/fancybox/jquery.fancybox.min.css',
        'inspinia/css/plugins/sweetalert/sweetalert.css',
        'css/admin.css',
    ];

    public $js = [
        'inspinia/js/plugins/select2/select2.full.min.js',
        //'inspinia/js/plugins/sweetalert/sweetalert.min.js',
        //'js/fancybox/jquery.fancybox.min.js',
        'js/admin.js?v=12',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
