<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Cedencias */

$this->title = 'Editar Cedencia';
$this->params['breadcrumbs'][] = ['label' => 'Cedencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cedencias-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modelsEquipamento' => $modelsEquipamento,
    ]) ?>

</div>
