<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Adendas */

$this->title = 'Editar Adenda';
$this->params['breadcrumbs'][] = ['label' => 'Adendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="adendas-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modelsEquipamento' => $modelsEquipamento
    ]) ?>

</div>
