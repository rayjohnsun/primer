<?php
namespace app\base;

use Yii;

class AController extends \yii\web\Controller {
  public function generateRules($newRules) {
  	if (is_array($newRules)) {
  		$rules = $newRules;
  	} else {
	  	$rules = [
	      [
	        'allow' => true,
	        'actions' => ['index', 'create', 'update', 'delete'],
	        'roles' => [$newRules],
	      ],
	    ];
  	}
  	return [
      'access' => [
        'class' => \yii\filters\AccessControl::className(),
        'rules' => $rules,
      ],
      'verbs' => [
        'class' => \yii\filters\VerbFilter::className(),
        'actions' => [
          'delete' => ['POST'],
        ],
      ],
    ];
  }

  public function generateDP($model) {
  	return $model->search(Yii::$app->request->queryParams);
  }
}