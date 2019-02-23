<?php

use yii\helpers\Html;

$this->title = 'Update: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Organizations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="organizations-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' 	=> $model,
        'countries' => $countries,
        'types'		=> $types,
    ]) ?>

</div>
