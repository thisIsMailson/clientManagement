<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Notification */

$this->title = 'Editar Notificação';
$this->params['breadcrumbs'][] = ['label' => 'Notifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="notification-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'user' => $user
    ]) ?>

</div>
