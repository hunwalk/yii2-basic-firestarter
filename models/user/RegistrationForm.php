<?php

namespace app\models\user;

use dektrium\user\models\RegistrationForm as BaseRegistrationForm;

class RegistrationForm extends BaseRegistrationForm
{
    /**
     * @var string
     */
    public $api_key;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = ['api_key', 'required'];
        $rules[] = ['api_key', 'string', 'max' => 16];
        return $rules;
    }
}