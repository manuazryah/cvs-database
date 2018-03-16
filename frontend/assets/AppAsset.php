<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'plugins/bootstrap/css/bootstrap.min.css',
        'plugins/flexslider/flexslider.css',
        'plugins/font-awesome/css/font-awesome.min.css',
        'https://use.fontawesome.com/releases/v5.0.8/css/all.css',
        'plugins/themify/themify-icons.css',
        'css/style.css',
        'css/responsive.css',
        'https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i',
    ];
    public $js = [
        'js/jquery.min.js',
        'plugins/bootstrap/js/bootstrap.min.js',
        'plugins/flexslider/jquery.flexslider-min.js',
        'js/jquery.counterup.min.js',
        'js/waypoints.min.js',
        'js/counter.js',
        'js/flexslider.js',
        'js/common.js',
        'https://www.google.com/recaptcha/api.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
