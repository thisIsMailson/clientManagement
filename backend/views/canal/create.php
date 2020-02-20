<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Canal */

$this->title = 'Criar Canal';
$this->params['breadcrumbs'][] = ['label' => 'Canals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="canal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
