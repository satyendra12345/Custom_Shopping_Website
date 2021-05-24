<?php

namespace app\components\helpers;


/**
 * Setup Commands for first time
 *
 * @author sattu
 *        
 */
trait TLogHelper
{

    public static function log($strings)
    {
        if (php_sapi_name() == "cli") {
            echo get_called_class() . ' : ' . $strings . PHP_EOL;
        } else {
            \Yii::debug(get_called_class() . ' : ' . $strings);
        }
    }
}