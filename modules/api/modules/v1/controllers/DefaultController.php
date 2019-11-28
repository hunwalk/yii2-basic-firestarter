<?php

namespace app\modules\api\modules\v1\controllers;

use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Default controller for the `v1` module
 */
class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'contentNegotiator' => [
                'class' => 'yii\filters\ContentNegotiator',
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }

    /**
     * @param $key
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionGenerateTokenFromKey($key)
    {
        $user = User::find()->where(['api_key' => $key])->one();

        if (!isset($user))
            throw new NotFoundHttpException('Key not found');

        $timestamp = time();

        $secureKey = sha1(strval($timestamp).$key);

        return [
            'timestamp' => $timestamp,
            'key' => $key,
            'token' => "{$user->id}:{$timestamp}:{$secureKey}"
        ];
    }

    /**
     * Return the basic information about this api
     * @return array
     */
    public function actionIndex()
    {
        return [
            'request' => \Yii::$app->request,
            'api' => [
                'version' => $this->module->id,
            ]
        ];
    }
}
