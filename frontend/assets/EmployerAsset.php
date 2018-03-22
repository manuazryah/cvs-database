<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class EmployerAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'dash/css/bootstrap.css',
        'http://fonts.googleapis.com/css?family=Arimo:400,700,400italic',
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
        'dash/css/linecons.css',
        'dash/css/xenon-core.css',
        'dash/css/xenon-components.css',
        'dash/css/xenon-skins.css',
        'dash/css/site.css',
    ];
    public $js = [
        'dash/js/bootstrap.min.js',
        'dash/js/TweenMax.min.js',
        'dash/js/resizeable.js',
        'dash/js/joinable.js',
        'dash/js/xenon-api.js',
        'dash/js/xenon-toggles.js',
        /*
         * for chart
         */
        'dash/js/xenon-widgets.js',
        'dash/js/xenon-custom.js',
//        'js/devexpress-web-14.1/js/globalize.min.js',
//        'js/devexpress-web-14.1/js/dx.chartjs.js',
        'dash/js/toastr.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
