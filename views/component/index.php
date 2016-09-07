<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Components';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="component-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Add Component', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'instock',
            [
                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                'label' => 'Tractor Model Used In',
                'value' => function ($data) {
                    return $data->getTractorModel()->one()->model; // $data['name'] for array data, e.g. using SqlDataProvider.
                },
            ],
            [
                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                'label' => 'Dependent Component',
                'value' => function ($data) {
                    return count($data->dependencies);
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
