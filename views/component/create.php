<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\component */

$this->title = 'Create Component';
$this->params['breadcrumbs'][] = ['label' => 'Components', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="component-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'tractorModels' => $tractorModels,
        'components'=>$components,
    ])
    ?>

</div>
