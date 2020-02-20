<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

$img = '<img src="'. \Yii::$app->user->identity->photo .'" class="img-circle" alt="User Image" width="25px"; heigth="25px"/>';
$user_identity = \Yii::$app->user->identity;
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">GC</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <?php
                    $notifications = (new \yii\db\Query())
                            ->select('observacao, contato_id, id')
                            ->from('notification')
                            ->where('estado like "ativo" AND user_id = '.$user_identity->id)
                            ->distinct()
                            ->orderby('id desc')
                            ->all();
                    $obs = ($notifications);
                    
                    $count = count($notifications);
                ?>

                <!-- Messages: style can be found in dropdown.less-->
                

                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-bell-o"></i>
                      <span class="label label-warning"><?php echo $count ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if($count == 1) { ?>
                            <li class="header">Tens <?php echo $count ?> notificação nova</li>
                        <?php } elseif ($count > 1) { ?>
                            <li class="header">Tens <?php echo $count ?> notificações novas</li>
                        <?php } ?>
                      <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu">
                            <?php if ($count > 0) { ?>
                                <?php foreach (array_values($obs) as $key) { ?>
                                    <li id="notification" value="<?php echo $key['id'] ?>">
                                        <a href="?r=contatos%2Fupdate&id=<?php echo $key['contato_id']?>">
                                            <?php 
                                                echo $img;
                                            ?>
                                            <?php echo $key['observacao'] . ' - contato nº ' . $key['contato_id']; ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                        </ul>
                      </li>
                      <li class="footer"><a href="?r=notification/index">Ver todos</a></li>
                    </ul>
                </li>
                <!-- Tasks: style can be found in dropdown.less -->
          
                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php 
                            $profilePhoto = '<img src="'. $user_identity->photo .'" class="user-image"
                                 alt="User Image" width="50px"; heigth="50px";/>';
                             echo $profilePhoto;
                            ?>
                        <span class="hidden-xs"><?php echo $user_identity->name; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <?php $img = '<img src="'. $user_identity->photo .'" class="img-circle"
                                 alt="User Image" width="10px"; heigth="10px";/>';
                                 echo $img;
                            ?>
                           

                            <p>
                                <?php echo  $user_identity->name; ?>
                                <small> <?php echo $user_identity->email;  ?></small>
                                <small> <?php echo $user_identity->username;  ?></small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <?= Html::a(
                                    'Perfil',
                                    ['/site/profile'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
             
            </ul>
        </div>
    </nav>
</header>

<?php 
$script = <<< JS
    
    // $('#notification').click(function() {
    //     alert($(this).val());
    // }); 

JS;
$this->registerJs($script);

?>