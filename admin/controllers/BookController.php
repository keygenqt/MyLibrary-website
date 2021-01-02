<?php

namespace admin\controllers;

use common\models\Book;
use Yii;
use yii\bootstrap4\Html;
use yii\web\Response;

class BookController extends BaseController
{
    public function actionIndex(): string
    {
        $model = new Book(['scenario' => Book::SCENARIO_FILTER]);

        return $this->render('index', [
            'model' => $model
        ]);
    }

    public function actionUpdate($id = null)
    {
        $model = $id === null ? new Book() : Book::findOne(['id' => $id]);
        $model->setScenario(Book::SCENARIO_UPDATE);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', $id == null ? "Successfully added" : "Successfully updated");
                return $this->redirect(['book/update', 'id' => $model->id]);
            } else {
                Yii::$app->getSession()->setFlash('error', Html::errorSummary($model));
            }
        }
        return $this->render('update', ['model' => $model]);
    }
}
