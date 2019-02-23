<?php

namespace app\controllers\companies;

use Yii;
use app\components\Status;
use app\components\Type;
use app\models\companies\Dillers;
use app\models\companies\search\DillersSearch;
use app\models\directions\Countries;
use yii\web\NotFoundHttpException;

class DillersController extends \app\base\AController {

  public function behaviors() {
    return $this->generateRules('admin');
  }

  public function getCountries() {
    return Countries::nList('id', 'title_ru', Status::ACTIVE);
  }

  protected function findModel($id) {
    if ($model = Dillers::findOne($id)) {
      return $model;
    }
    throw new NotFoundHttpException('The requested page does not exist.');
  }

  public function actionIndex() {
    $searchModel = new DillersSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
      'countries' => $this->countries
    ]);
  }

  public function actionCreate() {
    $model = new Dillers();
    $model->status = Status::ACTIVE;
    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['index']);
    }
    return $this->render('create', [
      'model' => $model,
      'countries' => $this->countries
    ]);
  }

  public function actionUpdate($id) {
    $model = $this->findModel($id);
    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['index']);
    }
    return $this->render('update', [
      'model' => $model,
      'countries' => $this->countries
    ]);
  }

  public function actionDelete($id) {
    $this->findModel($id)->delete();
    return $this->redirect(['index']);
  }
}
