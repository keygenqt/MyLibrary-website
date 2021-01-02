<?php

namespace admin\controllers;

use common\models\Genre;
use yii\bootstrap4\Html;
use \Yii;

class GenreController extends BaseController
{
    public function actionIndex(): string
    {
        $model = new Genre(['scenario' => Genre::SCENARIO_FILTER]);

        return $this->render('index', [
            'model' => $model
        ]);
    }

    public function actionUpdate($id = null)
    {
        $model = $id === null ? new Genre() : Genre::findOne(['id' => $id]);
        $model->setScenario(Genre::SCENARIO_UPDATE);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', $id == null ? "Successfully added" : "Successfully updated");
                return $this->redirect(['genre/update', 'id' => $model->id]);
            } else {
                Yii::$app->getSession()->setFlash('error', Html::errorSummary($model));
            }
        }
        return $this->render('update', ['model' => $model]);
    }
}
