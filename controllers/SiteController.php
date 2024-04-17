<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\UploadedImages;
use app\models\UploadedImagesSearch;
use app\models\UploadImageForm;

class SiteController extends Controller
{
    /**
     * Отправка zip-архива пользователю
     */
    public function actionDownloadImages($id)
    {
        $model = UploadedImages::findOne($id);
        $dir = Yii::getAlias('@app') . "/web";
        $filename = $model->file_name;

        $zip = new \ZipArchive();
        $zipFileName = pathinfo($filename)['filename'] . '.zip';
        $zip->open($zipFileName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        $zip->addFromString($filename, file_get_contents("$dir/gallery/{$filename}"));
        $zip->close();

        Yii::$app->response->sendFile("$dir/$zipFileName");
        unlink("$dir/$zipFileName");
    }

    /**
     * Главная страница, показ всех файлов
     */
    public function actionIndex()
    {
        $searchModel = new UploadedImagesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Страница с загрузкой изображений
     */
    public function actionUpload()
    {
        $model = new UploadImageForm();

        if ($model->load($_FILES) && $model->validate() && $model->saveFile()) {
            return $this->redirect('/');
        }

        return $this->render('upload', [
            'model' => $model
        ]);
    }
}
