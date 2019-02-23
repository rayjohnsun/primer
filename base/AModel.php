<?php
namespace app\base;

use yii\helpers\ArrayHelper;

class AModel extends \yii\db\ActiveRecord {

  public static function nList($index, $value, $where = []) {
    if (!is_array($where)) {
      $where = ['status' => $where];
    }
    $res = static::find()
      ->select([$index, $value])
      ->where($where)
      ->all();
    return ArrayHelper::map($res, $index, $value);
  }

  public function getNTitle() {
    if (isset($this->title)) {
      return $this->title;
    } else if (isset($this->title_ru)) {
      return $this->title_ru;
    } else if (isset($this->description)) {
      return $this->description;
    } else if (isset($this->description_ru)) {
      return $this->description_ru;
    } else {
      return $this->id;
    }
  }

  public function beforeSave($insert) {
    if (parent::beforeSave($insert)) {
      if (method_exists($this, 'returnBeforeSave')) {
        return $this->returnBeforeSave();
      } else if (method_exists($this, 'runBeforeSave')) {
        $this->runBeforeSave();
      }
      return true;
    }
    return false;
  }

  public function afterSave($insert, $changedAttributes) {
    parent::afterSave($insert, $changedAttributes);
    if ($insert) {
      if (method_exists($this, 'runAfterSave')) {
        $this->runAfterSave();
      }
    } else {
      if (method_exists($this, 'runAfterUpdate')) {
        $this->runAfterUpdate();
      }
    }
  }

  public function beforeDelete() {
    if (parent::beforeDelete()) {
      if (method_exists($this, 'returnBeforeDelete')) {
        return $this->returnBeforeDelete();
      } else if (method_exists($this, 'runBeforeDelete')) {
        $this->runBeforeDelete();
      }
      return true;
    }
    return false;
  }

}