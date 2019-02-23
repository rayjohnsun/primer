<?php
namespace app\models\companies;

use app\components\Status;
use app\models\directions\Countries;
use Yii;

class Organizations extends \app\base\AModel {

  public static function tableName() {
    return 'a_organizations';
  }

  public function rules() {
    return [
      [['title_en', 'title_ru', 'country_id', 'director'], 'required'],
      [['country_id', 'status'], 'integer'],
      [['created_at', 'updated_at'], 'safe'],
      [['title_en', 'title_ru', 'adres_en', 'adres_ru'], 'string', 'max' => 250],
      [['phone', 'email', 'director'], 'string', 'max' => 100],
      [['status'], 'in', 'range' => Status::list()],
      [['title_en', 'title_ru', 'director', 'adres_en', 'adres_ru', 'phone', 'email'], 'trim'],
    ];
  }

  public function attributeLabels() {
    return [
      'id' => 'ID',
      'title_en' => 'Название (en)',
      'title_ru' => 'Название (ru)',
      'adres_en' => 'Адрес (ne)',
      'adres_ru' => 'Адрес (ru)',
      'phone' => 'Номер телефона',
      'email' => 'Email',
      'country_id' => 'Страна',
      'director' => 'Директор',
      'status' => 'Статус',
      'created_at' => 'Создан',
      'updated_at' => 'Редактирован',
    ];
  }

  public function getCountry() {
    return $this->hasOne(Countries::className(), ['id' => 'country_id']);
  }

  public function returnBeforeDelete() {
    $cnt1 = OrgDilContracts::find()->where([
      'organization_id' => $this->id,
    ])->count();
    $cnt2 = OrgBuyContracts::find()->where([
      'organization_id' => $this->id,
    ])->count();
    $cnt3 = OrgDilInvoices::find()->where([
      'organization_id' => $this->id,
    ])->count();
    $cnt4 = OrgBuyInvoices::find()->where([
      'organization_id' => $this->id,
    ])->count();
    $_id = static::find()->orderBy([
      'id' => SORT_DESC,
    ])->one()->id;

    if ($cnt1<1&&$cnt2<1&&$cnt3<1&&$cnt4<1&&$_id!=$this->id){
      return true;
    } else {
      Yii::$app->session->setFlash('message', "Error to delete: Organization <strong>{$this->title}</strong> is used.");
    }
    return false;
  }
  
}
