<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Cedencias */

$this->title = 'Create Cedencias';
$this->params['breadcrumbs'][] = ['label' => 'Cedencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cedencias-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_adendaForm', [
        'model' => $model,
        'modelsEquipamento' => $modelsEquipamento,
        'cedencia'=>$cedencia
    ]) ?>

</div>
