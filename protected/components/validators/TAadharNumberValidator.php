<?php

namespace app\components\validators;

use yii\validators\Validator;

class TAadharNumberValidator extends Validator
{

    public $regExPattern = '/^\d{4}\s\d{4}\s\d{4}$/';

    public function validateAttribute($model, $attribute)
    {
        if (preg_match($this->regExPattern, $model->$attribute)) {
            $model->addError($attribute, 'Not valid Aadhar Card Number');
        }
    }
}