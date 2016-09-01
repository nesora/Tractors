<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\tractormodel */

$this->title = 'Create Tractormodel';
$this->params['breadcrumbs'][] = ['label' => 'Tractormodels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="tractormodel-create">

    <h1> <?= Html::encode($this->title) ?> </h1>

    <?= $this->render('_form', ['model' => $model,]) ?>

</div>

