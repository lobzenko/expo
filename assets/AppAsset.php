<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/css/bootstrap.css',
        'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css',
        '/css/styles.css',
    ];
    public $js = [
        'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js',
        'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js',
        '/js/js.cookie.min.js',
        '/js/site.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
