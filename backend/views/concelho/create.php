<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Concelho */

$this->title = 'Create Concelho';
$this->params['breadcrumbs'][] = ['label' => 'Concelhos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="concelho-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
