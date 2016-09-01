<?php

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LoginUserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="login-user-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
    ]);
    ?>

    <?php ActiveForm::end(); ?>

</div>
