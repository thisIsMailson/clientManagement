<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AdendaEquipamentos */

$this->title = 'Create Adenda Equipamentos';
$this->params['breadcrumbs'][] = ['label' => 'Adenda Equipamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adenda-equipamentos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
