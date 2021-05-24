<?php

namespace app\components\helpers;

use yii\helpers\ArrayHelper;

/**
 * Setup Commands for first time
 *
 * @author satyendra
 *        
 */
class TArrayHelper extends ArrayHelper
{

    public static function first(&$array)
    {
        if (! is_array($array))
            return $array;
        if (! count($array))
            return null;
        reset($array);
        return $array[key($array)];
    }

    public static function last(&$array)
    {
        if (! is_array($array))
            return $array;
        if (! count($array))
            return null;
        end($array);
        return $array[key($array)];
    }
}
