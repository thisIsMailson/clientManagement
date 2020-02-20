
<?php
 $admin = \Yii::$app->user->identity->role_id == 1;
 $identity = \Yii::$app->user->identity;
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image"> 
                <?php 
                    $img = '<img src="'. $identity->photo .'" class="img-circle"
                                 alt="User Image"/>';  
                    echo $img;

                ?>
            </div>
            <div class="pull-left info">
                <p><?php echo $identity->name; ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Dashboard', 'icon' => 'fas fa-dashboard','url' => ['site/index']
                ],      
                        [
                            'label' => 'Adendas',
                            'icon' => 'fas fa-paperclip',
                            'url' => '?r=adenda',
                            'active' => $this->context->route == 'adenda/index',
                        ],
                        [
                            'label' => 'Cedências',
                            'icon' => 'fas fa-chain',
                            'url' => '?r=cedencias',
                            'active' => $this->context->route == 'cedencias/index',
                        ],
                        [
                            'label' => 'Contatos',
                            'icon' => 'fas fa-chain-broken',
                            'url' => '?r=contatos',
                            'active' => $this->context->route == 'contatos/index',
                        ],
                        ['label' => 'Configurações', 'options' => ['class' => 'header']],
                        [
                            'label' => 'Parametrização',
                            'icon' => 'fas fa-cogs',
                            'url' => '#',
                            'items' => [
                                [
                                    'label' => 'Canais',
                                    'icon' => 'fas fa-eye',
                                    'url' => '?r=canal',
                                    'active' => $this->context->route == 'canal/index',
                                ],
                                [
                                    'label' => 'Clientes',
                                    'icon' => 'fas fa-users',
                                    'url' => '?r=clientes',
                                    'active' => $this->context->route == 'clientes/index',
                                ],
                                [
                                    'label' => 'Concelhos',
                                    'icon' => 'fas fa-globe',
                                    'url' => '?r=concelho',
                                    'active' => $this->context->route == 'concelho/index',
                                ],
                                [
                                    'label' => 'Metas',
                                    'icon' => 'fas fa-bullseye',
                                    'url' => '?r=metas',
                                    'active' => $this->context->route == 'metas/index',
                                    'visible' => $admin
                                ],
                                [
                                    'label' => 'Equipamentos',
                                    'icon' => 'fas fa-mobile',
                                    'url' => '?r=equipamentos',
                                    'active' => $this->context->route == 'equipamentos/index',
                                    
                                ],
                                [
                                    'label' => 'Notificações',
                                    'icon' => 'fas fa-bell',
                                    'url' => '?r=notification',
                                    'active' => $this->context->route == 'notification/index',
                                    'visible' => $admin,
                                ],
                                [
                                    'label' => 'Produtos Gcvt',
                                    'icon' => 'fas fa-product-hunt',
                                    'url' => '?r=produtos',
                                    'active' => $this->context->route == 'produtos/index',
                                ],
                               
                            ],
                        ],
                        [
                            'label' => 'Configurações',
                            'icon' => 'fas fa-cog',
                            'url' => '#',
                            'items' => [
                                [
                                    'label' => 'Ver Perfis',
                                    'icon' => 'fas fa-eye',
                                    'url' => '?r=role',
                                    'active' => $this->context->route == 'role/index',
                                ],
                                [
                                    'label' => 'Ver Permissões',
                                    'icon' => 'fas fa-lock',
                                    'url' => '?r=permission',
                                    'active' => $this->context->route == 'permission/index',
                                ],
                                [
                                    'label' => 'Utilizadores',
                                    'icon' => 'fas fa-users',
                                    'url' => '#',
                                    'items' => [
                                        [
                                            'label' => 'Adicionar Utilizador',
                                            'icon' => 'fas fa-user-plus',
                                            'url' => '?r=user/create',
                                            'active' => $this->context->route == 'user/create',
                                        ],
                                        [
                                            'label' => 'Ver Utilizadores',
                                            'icon' => 'fas fa-eye',
                                            'url' => '?r=user/index',
                                            'active' => $this->context->route == 'cedencias/index',
                                            'active' => $this->context->route == 'user/index',
                                        ]
                                       
                                    ],
                                ],
                               
                            ],'visible' => $admin
                        ],
                        [
                            'label' => 'Exportação',
                            'icon' => 'fas fa-download',
                            'url' => '#',
                            'items' => [
                                [
                                    'label' => 'Adendas Equipamento',
                                    'icon' => 'fas fa-paperclip',
                                    'url' => '?r=adenda-equipamentos',
                                    'active' => $this->context->route == 'adenda-equipamentos/index',
                                ],
                                [
                                    'label' => 'Cedências Equipamento',
                                    'icon' => 'fas fa-chain',
                                    'url' => '?r=cedencia-equipamentos',
                                    'active' => $this->context->route == 'cedencia-equipamentos/index',
                                ],
                            ],
                        ],
                ],
            ]
        ) ?>

    </section>

</aside>
