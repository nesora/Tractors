<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div class="wrap <?= (Yii::$app->controller->action->id == 'login') ? 'background-wrapper' : NULL ?>">

            <?php
            NavBar::begin([
               // 'brandLabel' => 'Tractors',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            if (!Yii::$app->user->isGuest) {
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => [
                        ['label' => 'Home', 'url' => ['/site/index']],
                        ['label' => 'User Management', 'url' => ['/login-user/index']],
                        ['label' => 'Tractor Models', 'url' => ['/tractormodel/index']],
                        ['label' => 'Components', 'url' => ['/component/index']],
                        Yii::$app->user->isGuest ? (
                                ['label' => 'Login', 'url' => ['/site/login']]
                                ) : (
                                '<li>'
                                . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                                . Html::submitButton(
                                        'Logout (' . Yii::$app->user->identity->email . ')', ['class' => 'btn btn-link']
                                )
                                . Html::endForm()
                                . '</li>'
                                )
                    ],
                ]);
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]);
            }
            NavBar::end();
            ?>

            <div class="container">
                <?= $content ?>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; RosS  <?= date('Y') ?></p>
                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

        <?php $this->endBody() ?>

    </body>
</html>
<?php $this->endPage() ?>
