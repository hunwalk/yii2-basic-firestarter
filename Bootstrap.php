<?php

namespace app;

use dektrium\user\controllers\RegistrationController;
use dektrium\user\events\FormEvent;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Event;

class Bootstrap implements BootstrapInterface
{

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        Event::on(
            RegistrationController::className(),
            RegistrationController::EVENT_BEFORE_REGISTER,
            function (FormEvent $event) use ($app) {
                // generating api key
                $form = $event->getForm();
                $form->api_key = $app->security->generateRandomString(16);
                $event->setForm($form);
            }
        );

        Event::on(
            RegistrationController::className(),
            RegistrationController::EVENT_AFTER_REGISTER,
            function ($event) {
                // implement role assignment(s)
            }
        );
    }

}