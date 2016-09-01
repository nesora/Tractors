<?php

use yii\helpers\Url;
?>

<div> <p> Please use this link to reset your password : <?= Url::to(["/site/reset", 'token' => $model->token], TRUE); ?> </p>
</div>