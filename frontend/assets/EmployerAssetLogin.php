<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class EmployerAssetLogin extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'dash/css/bootstrap.min.css',
        'dash/css/font-awesome.min.css',
        'dash/css/animate.min.css',
        'dash/css/custom.css',
        'dash/css/green.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
