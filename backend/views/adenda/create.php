<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Adendas */

$this->title = 'Create Adendas';
$this->params['breadcrumbs'][] = ['label' => 'Adendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adendas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsEquipamento' => $modelsEquipamento,
    ]) ?>

</div>
