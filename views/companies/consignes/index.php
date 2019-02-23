<?php

use app\components\Helper;
use app\components\Status;
use app\components\Type;
use yii\bootstrap\Html;
use yii\grid\GridView;

$this->title = 'Consignes';
$this->params['breadcrumbs'][] = $this->title;

?>

<?=Helper::showMessage() ?>

<div class="organizations-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Consignes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'title_ru',
            'adres_ru',
            'phone',
            'email:email',
            'director',
            [
                'attribute' => 'country_id',
                'filter'    => Html::activeDropDownList($searchModel, 'country_id', $countries, ['class'=>'form-control','prompt' => 'All']),
                'value'     => 'country.title',
            ],
            [
                'attribute' => 'status',
                'value' => function ($m) {return Status::label($m->status);},
                'format'=> 'raw',
                'filter'=> Html::activeDropDownList($searchModel, 'status', Status::get(), ['class'=>'form-control','prompt' => 'All']),
            ],
            [
                'attribute' => 'created_at',
                'value' => function ($m) {return date("d.m.Y H:i", strtotime($m->created_at));}
            ],
            [
                'class'     => 'yii\grid\ActionColumn',
                'template'  => '<div class="b_style">{update}&nbsp;&nbsp;&nbsp;{delete}</div>',
            ],
        ],
    ]); ?>
</div>
