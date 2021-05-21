<?php

namespace app\components\validators;

use yii\validators\Validator;

class TPanNumberValidator extends Validator
{

    public $regExPattern = '/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/';

    public function validateAttribute($model, $attribute)
    {
        if (preg_match($this->regExPattern, $model->$attribute)) {
            $model->addError($attribute, 'Not valid Pan Card Number');
        }
    }
}