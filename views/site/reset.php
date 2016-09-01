<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Reset Password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset">
    <h1><?= Html::encode($this->title) ?></h1>


    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('success') ?>

        </div>
    <?php endif; ?>

   
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-3">

            <?= $form->field($model, 'newpassword')->passwordInput(['placeholder' => 'Write your new password']) ?>
            <?= $form->field($model, 'newpasswordconfirm')->passwordInput(['placeholder' => 'Write again your new password']) ?>

        </div>

    </div>

    <div class="form-group">

        <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'reset-button']) ?>

    </div>

    <?php ActiveForm::end(); ?>


</div>
