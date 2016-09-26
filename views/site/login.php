

<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-login">

    <div class="login-message"> 
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?php
    $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => ['class' => 'form-horizontal'],
                'fieldConfig' => [
                    'template' => "{label}\n <div class=\"center\"><div class=\"col-sm-6 col-md-4 col-lg-4 \">{input}</div>\n<div class=\" col-sm-7 col-md-5 col-lg-7\">{error}</div></div>",
                    'labelOptions' => ['class' => 'col-lg-1 col-md-1 control-label'],
                ],
    ]);
    ?>

    <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'placeholder' => 'Write your email address']) ?>

    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Write your password']) ?>
    <div class="remember-checkbox">
        <?=
        $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-1 col-lg-3 col-md-3\">{input} {label}</div>\n<div class=\"col-lg-8 col-md-8 col-sm-8\">{error}</div>",
        ])
        ?>
    </div>
    <div class="form-group">
        <div class="col-lg-offset-1 col-sm-10 col-md-11 col-lg-11">
            <div class="forgot-pas">
                <?= Html::a(Yii::t("app", "Forgotten  password") . "?", ["/site/forgot"]) ?>
                <br>
            </div>
            <br>
            <div class="login-button">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
