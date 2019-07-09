<?php

namespace app\commands;

use yii\console\Controller;

class FireController extends Controller
{
    public function actionIndex(){
        echo "\n";
        echo "Yii2 Firestarter Template :: 🔥\n";
        echo "\n";
    }

    public function actionCommit()
    {
        echo shell_exec('php vendor/bin/php-commitizen commit "'.__DIR__.'/../config/commitizen.php"');
    }
}