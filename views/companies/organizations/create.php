<?php

use yii\helpers\Html;

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Organizations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="organizations-create">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' 	=> $model,
		'countries' => $countries,
		'types'		=> $types,
	]) ?>

</div>
