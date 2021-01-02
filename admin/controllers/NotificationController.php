<?php

namespace admin\controllers;

use common\models\Notification;
use Yii;
use yii\bootstrap4\Html;
use yii\helpers\Url;
use yii\web\Response;

class NotificationController extends BaseController
{
    public function actionIndex(): string
    {
        $model = new Notification(['scenario' => Notification::SCENARIO_FILTER]);

        return $this->render('index', [
            'model' => $model
        ]);
    }

    public function actionUpdate($id = null)
    {
        $model = $id === null ? new Notification() : Notification::findOne(['id' => $id]);
        $model->setScenario(Notification::SCENARIO_UPDATE);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', $id == null ? "Successfully added" : "Successfully updated");
                return $this->redirect(['notification/update', 'id' => $model->id]);
            } else {
                Yii::$app->getSession()->setFlash('error', Html::errorSummary($model));
            }
        }
        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete($id): Response
    {
        $model = Notification::findOne(['id' => $id]);
        if ($model == null) {
            Yii::$app->session->setFlash('error', "Model not found");
        } else {
            $model->delete();
            Yii::$app->session->setFlash('success', "Successfully deleted");
        }
        return $this->redirect(Url::toRoute('notification/index'));
    }
}
