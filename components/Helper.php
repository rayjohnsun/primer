<?php
namespace app\components;

use Yii;

class Helper {
  public static function numbers($from = 0, $to = 30) {
    $numbers = [];
    for ($i = $from; $i <= $to; $i++) {
      $numbers[$i] = $i;
    }
    return $numbers;
  }

  public static function dt($dt) {
    $dt1 = explode(' ', $dt);
    if (isset($dt1[1]) AND strlen($dt1[0]) != 10) {
      unset($dt1[1]);
    }
    $dt2 = explode('.', $dt1[0]);
    if (count($dt2) > 1) {
      $dt3 = array_reverse($dt2);
      $dt = implode('-', $dt3);
      if (isset($dt1[1])) {
        $dt .= ' ' . $dt1[1];
      }
    }
    return $dt;
  }

  public static function message($model) {
    $txt = '<ul>';
    foreach ($model->errors as $key => $value) {
      if (!empty($value)) {
        foreach ($value as $key2 => $value2) {
          $val3 = explode('<br>', $value2);
          foreach ($val3 as $kk => $vv) {
            $txt .= '<li>' . $vv . '</li>';
          }
        }
      }
    }
    $txt .= '</ul>';
    return $txt;
  }

  public static function encodeQuote($value = '') {
    $value = trim($value);
    return str_replace('"', '&quot;', $value);
  }

  public static function decodeQuote($value = '') {
    $value = trim($value);
    return str_replace('&quot;', '"', $value);
  }

  public static function trimEnters($value = "") {
    $value = str_replace(PHP_EOL, "", $value);
    $value = str_replace(["\r\n", "\r", "\n", "\t"], "", $value);
    return $value;
  }

  public static function showMessage() {
    $txt = '';
    if (Yii::$app->session->hasFlash('message')) {
      $txt .= '<div class="alert alert-danger">';
      $txt .= Yii::$app->session->getFlash('message');
      $txt .= '</div>';
    }
    return $txt;
  }
}