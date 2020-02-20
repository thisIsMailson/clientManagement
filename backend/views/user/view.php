<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\AuthAssignment;
/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = 'Gestão de Utilizador';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
function getProfiles($model){
    $auth = new AuthAssignment();
    $result = "";
    foreach ($auth->getProfilesByUser($model->id) as $value) {
       $result .= Html::a($value->item_name, $value->itemName->description).'<br/>';
    }
    return $result;
}
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>User <small>Informações de user: <b><?= $model->id?></small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'username',
                        'auth_key',
                        'email:email',
                        'status',
                        'created_at',
                        'updated_at',
                        [
                            'label' => 'Perfil',
                            'format'=> 'raw',
                            'value' => getProfiles($model),
                        ]
                    ],
                ]) ?>
            </div>
             <p>
                <?= Html::a('<i class="fa fa-plus"></i>'.' Novo Registo', ['create'], ['class' => 'btn btn-primary left']) ?>
                <?= Html::a('<i class="fa fa-trash"></i>'.' Eliminar', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger left',
                    'data' => [
                        'confirm' => 'Deseja realmente eliminar este item?',
                        'method' => 'post',
                    ],
                ]) ?>

                <?= Html::a('<i class="fa fa-list"></i>'.' Ir para lista de user', ['index'], ['class' => 'btn btn-default']) ?>
            </p>
        </div>
    </div>
</div>