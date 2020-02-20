<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Contatos */

$this->title = 'Criar Contato';
$this->params['breadcrumbs'][] = ['label' => 'Contatos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contatos-create">

    <?= $this->render('_form', [
        'model' => $model,'client'=> $client, 'value'=>[], 'product'=>$product
    ]) ?>

</div>
