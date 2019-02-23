<?php
namespace app\rbac;

use Yii;
use yii\rbac\Rule;

class UserRule extends Rule {
  public $name = 'allusers';
  
  public function execute($user_id, $item, $params) {
    if (!Yii::$app->user->isGuest) {
      $role = Yii::$app->user->identity->role_id;
      if ($role === $item->name) {
        return true;
      }
      $childs = Yii::$app->authManager->getChildren($role);
      if (!empty($childs)) {
        if (isset($childs[$item->name])) {
          return true;
        } else {
          foreach ($childs as $key => $value) {
            $childs2 = Yii::$app->authManager->getChildren($value->name);
            if (isset($childs2[$item->name])) {
              return true;
            }
          }
        }
      }
    }
    return false;
  }
}