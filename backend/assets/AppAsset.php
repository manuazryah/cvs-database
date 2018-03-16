<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.css',
        'http://fonts.googleapis.com/css?family=Arimo:400,700,400italic',
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
        'css/linecons.css',
        'css/xenon-core.css',
        'css/xenon-components.css',
        'css/xenon-skins.css',
        'css/site.css',
    ];
    public $js = [
        'js/bootstrap.min.js',
        'js/TweenMax.min.js',
        'js/resizeable.js',
        'js/joinable.js',
        'js/xenon-api.js',
        'js/xenon-toggles.js',
        /*
         * for chart
         */
        'js/xenon-widgets.js',
        'js/xenon-custom.js',
//        'js/devexpress-web-14.1/js/globalize.min.js',
//        'js/devexpress-web-14.1/js/dx.chartjs.js',
        'js/toastr.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
