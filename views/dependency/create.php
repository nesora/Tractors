<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Dependency */

$this->title = 'Create Dependency';
$this->params['breadcrumbs'][] = ['label' => 'Dependencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dependency-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
