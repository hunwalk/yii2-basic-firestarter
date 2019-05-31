<?php

namespace app;

use dektrium\user\events\FormEvent;
use yii\base\Application;
use yii\base\BootstrapInterface;
use dektrium\user\controllers\RegistrationController;
use yii\base\Event;

class Bootstrap implements BootstrapInterface{

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        Event::on(
            RegistrationController::className(),
            RegistrationController::EVENT_AFTER_REGISTER,
            function ($event) {
                // implement role assignment(s)
            }
        );
    }

}