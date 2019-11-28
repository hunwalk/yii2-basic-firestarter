<?php

namespace app\modules\api\modules\v1\controllers\user;

use app\models\User;
use dektrium\user\controllers\SettingsController as BaseSettingsController;
use dektrium\user\models\Profile;
use dektrium\user\traits\AjaxValidationTrait;
use dektrium\user\traits\EventTrait;
use Yii;
use yii\base\ExitException;
use yii\base\InvalidConfigException;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;

/**
 * Class SettingsController
 * @package app\modules\api\modules\v1\controllers\user
 *
 * In theory, we could use extend here the rest controller,
 * however, the user module is fairly complex for that.
 * Either way, we would have to overwrite everything, so..
 * have fun :)
 */
class SettingsController extends Controller
{
    // Yes, we are going to fire off some events, even if we update some data
    // through this api
    use EventTrait;
    use AjaxValidationTrait;

    public $enableCsrfValidation = false;

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'contentNegotiator' => [
                'class' => 'yii\filters\ContentNegotiator',
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
            'bearerAuth' => [
                'class' => HttpBearerAuth::className(),
                'only' => ['profile'],
            ],
        ];
    }

    /**
     * @return array
     * @throws ExitException
     * @throws HttpException
     * @throws InvalidConfigException
     *
     * I am going to be honest with you, i tweaked this a little bit, leaving behind the finder component.
     * This controller is only for demonstration, but you can use it like this, if you find it useful.
     * Also some basic information:
     * If you pass the HttpBearerAuth, that means Yii logged you in with that user.
     * So you can use Yii::$app->user to get the required data, as you would get when you logged in
     * using sessions
     */
    public function actionProfile()
    {
        /** @var User|null $user */
        $user = User::find()->where(['id' => Yii::$app->user->identity->getId()])->one();
        $model = isset($user) ? $user->profile : null;

        // If HttpBearerAuth works, this Exception below will never happen. But.. you know.
        // You can't be cautious enough when developing
        if (!isset($model))
            throw new HttpException(500, 'Something weird happened. We logged you in, but we can`t find the user in the database');

        //This is some legacy dektrium code below.
        if ($model == null) {
            $model = Yii::createObject(Profile::className());
            $model->link('user', Yii::$app->user->identity);
        }

        $event = $this->getProfileEvent($model);

        $this->performAjaxValidation($model);

        $this->trigger(BaseSettingsController::EVENT_BEFORE_PROFILE_UPDATE, $event);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $this->trigger(BaseSettingsController::EVENT_AFTER_PROFILE_UPDATE, $event);

            return [
                'saved' => true,
                'message' => Yii::t('user', 'Your profile has been updated'),
                'profile' => $model,
            ];
        }

        return [
            'profile' => $model,
        ];
    }


}