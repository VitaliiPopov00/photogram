<?php

namespace app\controllers;

use yii\filters\Cors;
use yii\rest\ActiveController;

/**
 * API контроллер
 */
class GalleryController extends ActiveController
{
    public $modelClass = 'app\models\UploadedImages';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // remove authentication filter
        $auth = $behaviors['authenticator'];
        unset($behaviors['authenticator']);

        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => Cors::class,
            'cors' => [
                'Origin' => [
                    (isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : 'http://' . $_SERVER['REMOTE_ADDR'])
                ],
                'Access-Control-Request-Headers' => ['content-type'],
                'Access-Control-Request-Method' => ['GET'],
            ],
        ];

        $behaviors['authenticator'] = $auth;

        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['delete'], $actions['create'], $actions['update']);

        return $actions;
    }
}
