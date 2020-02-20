<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\HistoricoEquipamento */

$this->title = 'Create Historico Equipamento';
$this->params['breadcrumbs'][] = ['label' => 'Historico Equipamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="historico-equipamento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
