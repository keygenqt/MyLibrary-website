<?php

namespace admin\controllers;

use common\models\User;
use Yii;
use yii\bootstrap4\Html;

class UserController extends BaseController
{
    public function actionIndex(): string
    {
        $model = new User(['scenario' => User::SCENARIO_FILTER]);

        return $this->render('index', [
            'model' => $model
        ]);
    }

    public function actionUpdate($id = null)
    {
        $model = $id === null ? new User() : User::findOne(['id' => $id]);
        $id === null ? $model->setScenario(User::SCENARIO_CREATE) : $model->setScenario(User::SCENARIO_UPDATE);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', $id == null ? "Successfully added" : "Successfully updated");
                return $this->redirect(['user/update', 'id' => $model->id]);
            } else {
                Yii::$app->getSession()->setFlash('error', Html::errorSummary($model));
            }
        }
        return $this->render('update', ['model' => $model]);
    }
}
