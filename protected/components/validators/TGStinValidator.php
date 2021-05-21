<?php

namespace app\components\validators;

use yii\validators\Validator;

class TGStinValidator extends Validator
{

    public $regExPattern = '/^([0][1-9]|[1-2][0-9]|[3][0-7])([a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}[1-9a-zA-Z]{1}[zZ]{1}[0-9a-zA-Z]{1})+$/';

    public function validateAttribute($model, $attribute)
    {
        if (preg_match($this->regExPattern, $model->$attribute)) {
            $model->addError($attribute, 'Not valid Aadhar Card Number');
        }
    }
}