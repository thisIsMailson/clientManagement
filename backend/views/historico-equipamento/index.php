<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\HistoricoEquipamentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Historico Equipamentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="historico-equipamento-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Historico Equipamento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'data_alteracao',
            'equipamento_id',
            'utilizador_id',
            'user_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
