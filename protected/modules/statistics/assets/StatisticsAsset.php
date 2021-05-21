<?php
namespace app\modules\statistics\assets;

use yii\web\AssetBundle;

class StatisticsAsset extends AssetBundle
{

    /**
     *
     * @inheritdoc
     */
    public $sourcePath = '@app/modules/statistics/assets/src';

    /**
     *
     * @inheritdoc
     */
    public $css = [
        'css/jquery.mCustomScrollbar.css'
    ];

    public $js = [
        'js/chart.bundle.min.js',
        'js/jquery.mCustomScrollbar.concat.min.js',
        'js/chart_config.js'
    ];
}
