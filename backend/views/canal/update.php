<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Canal */

$this->title = 'Editar Canal';
$this->params['breadcrumbs'][] = ['label' => 'Canals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="canal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
