<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Metas */

$this->title = 'Criar Meta';
$this->params['breadcrumbs'][] = ['label' => 'Metas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="metas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
