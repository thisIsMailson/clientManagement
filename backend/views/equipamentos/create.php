<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Equipamentos */

$this->title = 'Create Equipamentos';
$this->params['breadcrumbs'][] = ['label' => 'Equipamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipamentos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
