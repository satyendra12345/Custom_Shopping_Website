<?php

namespace app\components\helpers;


/**
 * Setup Commands for first time
 *
 * @author satyendra
 *        
 */
class TRegExHelper
{

    const PATTERN_EMAIL = '/[a-z0-9_.\-\+]+@[a-z0-9\-]+\.([a-z]+)(?:\.[a-z]+)?/i';

    public static function findMatching($subject, $pattern)
    {
        if (preg_match_all($pattern, $subject, $matches)) {
            return $matches;
        }
        return null;
    }
}