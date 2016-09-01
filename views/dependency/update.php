<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Dependency */

$this->title = 'Update Dependency: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Dependencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dependency-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
