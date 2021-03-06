<?php
namespace app\models\companies;

use app\models\directions\Countries;
use Yii;

class Buyers extends \app\base\AModel {

  public static function tableName() {
    return 'a_buyers';
  }

  public function rules() {
    return [
      [['title_en', 'title_ru', 'country_id', 'director'], 'required'],
      [['country_id', 'status'], 'integer'],
      [['created_at', 'updated_at'], 'safe'],
      [['title_en', 'title_ru', 'adres_en', 'adres_ru'], 'string', 'max' => 250],
      [['phone', 'email', 'director'], 'string', 'max' => 100],
    ];
  }

  public function attributeLabels() {
    return [
      'id' => 'ID',
      'title_en' => 'Title En',
      'title_ru' => 'Title Ru',
      'adres_en' => 'Adres En',
      'adres_ru' => 'Adres Ru',
      'phone' => 'Phone',
      'email' => 'Email',
      'country_id' => 'Country ID',
      'director' => 'Director',
      'status' => 'Status',
      'created_at' => 'Created At',
      'updated_at' => 'Updated At',
    ];
  }

  public function getCountry() {
    return $this->hasOne(Countries::className(),['id'=>'country_id']);
  }

  public function returnBeforeDelete() {
    $cnt1 = OrgBuyContracts::find()->where([
      'buyer_id' => $this->id,
    ])->count();
    $cnt2 = DilBuyContracts::find()->where([
      'buyer_id' => $this->id,
    ])->count();
    $cnt3 = OrgBuyInvoices::find()->where([
      'buyer_id' => $this->id,
    ])->count();
    $cnt4 = DilBuyInvoices::find()->where([
      'buyer_id' => $this->id,
    ])->count();

    if ($cnt1<1&&$cnt2<1&&$cnt3<1&&$cnt4<1) {
      return true;
    } else {
      Yii::$app->session->setFlash('message', "Error to delete: Organization <strong>{$this->title}</strong> is used.");
    }
    return false;
  }

}
