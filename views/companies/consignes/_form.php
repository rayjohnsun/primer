<?php

use app\components\Type;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="consignes-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'adres_en')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'adres_ru')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'status')->checkbox() ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'country_id')->dropDownlist($countries, [
                'prompt' => 'Select'
            ]) ?>
            <?= $form->field($model, 'director')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
