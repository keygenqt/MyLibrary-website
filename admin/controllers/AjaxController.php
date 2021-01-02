<?php

namespace admin\controllers;

use common\models\Genre;
use common\models\User;
use keygenqt\components\ImageHandler;
use Yii;
use yii\base\Exception;
use yii\helpers\Json;
use yii\web\UploadedFile;

/**
 * AjaxController controller
 */
class AjaxController extends BaseController
{
    const IMAGE_BOOK = 'book';
    /**
     * @var mixed|null|bool
     */
    public $enableCsrfValidation = false;

    public function actionSearch($term)
    {
        if (Yii::$app->request->isAjax) {
            $results = [];
            if (is_numeric($term)) {
                /** @var User $model */
                $model = User::findOne(['id' => $term]);

                if ($model) {
                    $results[] = [
                        'id' => $model['id'],
                        'label' => $model['email'] . ' (model id: ' . $model['id'] . ')',
                    ];
                }
            } else {
                $q = addslashes($term);
                foreach (User::find()->where("(`email` like '%{$q}%')")->all() as $model) {
                    $results[] = [
                        'id' => $model['id'],
                        'label' => $model['email'] . ' (model id: ' . $model['id'] . ')',
                    ];
                }
            }
            echo Json::encode($results);
        }
    }

    public function actionSearchGenre($term)
    {
        if (Yii::$app->request->isAjax) {
            $results = [];
            if (is_numeric($term)) {
                /** @var Genre $model */
                $model = Genre::findOne(['id' => $term]);

                if ($model) {
                    $results[] = [
                        'id' => $model['id'],
                        'label' => $model['title'] . ' (model id: ' . $model['id'] . ')',
                    ];
                }
            } else {
                $q = addslashes($term);
                foreach (Genre::find()->where("(`title` like '%{$q}%')")->all() as $model) {
                    $results[] = [
                        'id' => $model['id'],
                        'label' => $model['title'] . ' (model id: ' . $model['id'] . ')',
                    ];
                }
            }
            echo Json::encode($results);
        }
    }

    public function actionUploadImage($type)
    {
        if (Yii::$app->request->isAjax) {
            $url = self::uploadFile($type, 'file');
            if ($url) {
                echo Json::encode([
                    'url' => $url,
                    'error' => false,
                ]);
            } else {
                echo Json::encode([
                    'error' => 'Error upload file.',
                ]);
            }
            exit;
        }
    }

    public static function uploadFile($type, $name)
    {
        $file = UploadedFile::getInstanceByName($name);

        if (!empty($file)) {
            if (
                strpos($file->extension, 'png') !== false ||
                strpos($file->extension, 'jpg') !== false ||
                strpos($file->extension, 'jpeg') !== false
            ) {

                $name = uniqid();

                /** @var ImageHandler $imageHandler */
                $imageHandler = \Yii::$app->get('ih');

                $filePath = Yii::getAlias('/home/keygenqt/dump_images/') . $name . '.png';

                try {
                    switch ($type) {
                        case self::IMAGE_BOOK:
                            $imageHandler->load($file->tempName)
                                ->adaptiveThumb(800, 1200)
                                ->save($filePath, ImageHandler::IMG_JPEG);
                            break;
                    }
                    if (YII_DEBUG) {
                        return "http://192.168.1.68:8080/images/$name.png";
                    } else {
                        return "https://api.mylibraryapp.com/images/$name.png";
                    }

                } catch (Exception $e) {
                    return false;
                }
            }
        }
        return false;
    }
}
