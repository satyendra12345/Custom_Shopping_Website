<?php

namespace app\components;

use yii\console\Controller;
use app\components\helpers\TArrayHelper;

class TConsoleController extends Controller
{

    public $force = false;

    public $dryRun = false;

    public function options($actionID)
    {
        return TArrayHelper::merge(parent::options($actionID), [
            'dryRun',
            'force'
        ]);
    }

    public function optionAliases()
    {
        return TArrayHelper::merge(parent::optionAliases(), [
            'd' => 'dryRun',
            'f' => 'force'
        ]);
    }

    public static function shellExec($strings)
    {
        echo shell_exec($strings);
    }

    public static function log($strings)
    {
        if (php_sapi_name() == "cli") {
            echo get_called_class() . ' : ' . $strings . PHP_EOL;
        } else {
            \Yii::debug($strings);
        }
    }
}

