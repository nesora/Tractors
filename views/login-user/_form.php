<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LoginUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="login-user-form">
    <div class="row">
        <div class="col-lg-4">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Write your email address']) ?>

            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'placeholder' => 'Write your password']) ?>

            <?= $form->field($model, 'firstname')->textInput(['maxlength' => true, 'placeholder' => 'Write your first name']) ?>

            <?= $form->field($model, 'lastname')->textInput(['maxlength' => true, 'placeholder' => 'Write your last name']) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
