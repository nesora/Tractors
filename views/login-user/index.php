<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LoginUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Login Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'email:email',
            'firstname',
            'lastname',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>