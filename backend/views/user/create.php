<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\user */

$this->title = 'Adicionar Utilizador';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'profile'=>$profile,
        'value'=>$value,
    ]) ?>

</div>
