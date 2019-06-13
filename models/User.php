<?php

namespace app\models;

use dektrium\user\models\User as BaseUser;
use yii\web\ForbiddenHttpException;

class User extends BaseUser
{
    /**
     * @author Pawel Brzozowski (bizley)
     * @param mixed $token
     * @param null $type
     * @return self
     * @throws ForbiddenHttpException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        if (!preg_match('/^(\d+):(\d+):(.+)$/', $token, $matches)) {
            throw new ForbiddenHttpException('Invalid token provided');
        }
        [, $userId, $stamp, $checksum] = $matches;
        $now = time();
        if ($now > $stamp + 60 || $now < $stamp - 60) {
            throw new ForbiddenHttpException('Invalid token provided | Bad Timestamp');
        }
        $user = static::findIdentity($userId);
        if ($user === null || empty($user->api_key) || !$user->verifyChecksum($stamp, $checksum)) {
            throw new ForbiddenHttpException('Invalid token provided');
        }
        return $user;
    }

    /**
     * @author Pawel Brzozowski (bizley)
     * @param string $stamp
     * @param string $checksum
     * @return bool
     */
    public function verifyChecksum(string $stamp, string $checksum)
    {
        return sha1($stamp . $this->api_key) === $checksum;
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'][] = 'api_key';
        $scenarios['update'][] = 'api_key';
        $scenarios['register'][] = 'api_key';
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules['apiKeyLength'] = ['api_key', 'string', 'max' => 16];

        return $rules;
    }
}