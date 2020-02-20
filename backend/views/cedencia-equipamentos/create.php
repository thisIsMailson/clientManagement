<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CedenciaEquipamentos */

$this->title = 'Create Cedencia Equipamentos';
$this->params['breadcrumbs'][] = ['label' => 'Cedencia Equipamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cedencia-equipamentos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
