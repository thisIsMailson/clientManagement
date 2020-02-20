<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Contatos */

$this->title = 'Editar Contato';
$this->params['breadcrumbs'][] = ['label' => 'Contatos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="contatos-update">

    <?= $this->render('_form', [
       	'model' => $model,'client'=> $client, 'value'=>[], 'product'=>$product,
    ]) ?>

</div>
