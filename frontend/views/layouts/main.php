<?php
    /* @var $this \yii\web\View */
    /* @var $content string */

    use frontend\assets\AppAsset;
    use frontend\models\Categorias;
    use frontend\models\Produtos;
    use frontend\models\Pedidos;
    use frontend\models\PedidosProdutos;
    use common\models\User;
    use yii\bootstrap\Nav;
    use yii\bootstrap\NavBar;
    use yii\helpers\Html;
    use yii\helpers\Url;

    AppAsset::register($this);


    if (!Yii::$app->session->get('carrinho')) {
        Yii::$app->session->set('carrinho', []);
    }

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl'   => Yii::$app->homeUrl,
            'options'    => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        $menuItems = [
            ['label' => 'Home', 'url' => ['/site/index']],
//            ['label' => 'About', 'url' => ['/site/about']],
//            ['label' => 'Contact', 'url' => ['/site/contact']],
        ];
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Cadastrar', 'url' => ['/site/signup']];
            $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
        } else {
            $menuItems[] = '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Sair (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>';
        }

        /** @var Categorias $category */
    foreach (Categorias::find()->where(['parent_id' => NULL])->orderBy('nome')->all() as $category) {
            if (!$subMenu_1 = Categorias::find()->where(['parent_id' => $category->id])->orderBy('nome')->all()) {
                $menuItems[] = ['label' => $category->nome, 'url' => Url::to(['categorias/exibir', 'id' => $category->id])];
            } else {
                $item = [];
                foreach ($subMenu_1 as $subMenu) {
                    $item[] = ['label' => $subMenu->nome, 'url' => Url::to(['categorias/exibir', 'id' => $subMenu->id])];
                }
                $menuItems[] = ['label' => $category->nome, 'items' => $item];
            }
        }
        $menuItems[] = [
                'label' => '<span id="carrinho" class="glyphicon glyphicon-shopping-cart text-' . (empty(Yii::$app->session->get('carrinho')) ? 'danger' : 'success') . '"></span> Carrinho <span id="carrinho-total" class="badge">' . count(Yii::$app->session->get("carrinho")) .'</span>',
                'url' => ['produtos/carrinho']];
        echo Nav::widget([
            'encodeLabels' => FALSE,
            'options'      => ['class' => 'navbar-nav'],
            'items'        => $menuItems,
        ]);
        NavBar::end();
    ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-3 col-xs-pull-0">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Usuários
                    </div>
                    <div class="panel-body">
                        <?php if (Yii::$app->user->isGuest) { ?>
                            <p><a href="<?= Url::to(['site/login']) ?>">Login</a></p>
                            <p><a href="<?= Url::to(['site/signup']) ?>">Cadastrar</a></p>
                        <?php } else { ?>
                            <p>Olá, <b><?= Yii::$app->user->identity->username ?></b></p>
                            <p><a href="<?= Url::to(['site/minhas-compras']) ?>"><span class="fa fa-bar-chart-o fa-fw"></span>Minhas compras</a></p>
                            <p><a href="<?= Url::to(['site/logout']) ?>" data-method="post">Sair</a></p>
                        <?php } ?>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">Produtos vendidos</div>
                    <div class="panel-body">
                        <?php
                            $produtos = Produtos::find()
                                ->innerJoin(PedidosProdutos::tableName(), 'pedidos_produtos.produto_id = produtos.id')
                                ->innerJoin(Pedidos::tableName(), 'pedidos_produtos.pedido_id = pedidos.id')
                                ->where('pedidos.confirmado=1 AND pedidos_produtos.confirmado=1')
                                ->orderBy('pedidos_produtos.quantidades')->all();

                            $cont = 0;
                            foreach ($produtos as $produto): $cont++ ?>
                            <p><a href="<?=Url::to(['produtos/exibir', 'id' => $produto->id])?>"><?= $produto->nome ?></a></p>
                        <?php endforeach;
                        if (!$cont) { ?>
                            <p>Nenhum resultado</p>
                        <?php } ?>

                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">Produtos</div>
                    <div class="panel-body">
                        <?php
                        $cont = 0;
                        foreach (Produtos::find()->orderBy('RAND()')->limit(5)->all() as $produto): $cont++ ?>
                            <p><a href="<?=Url::to(['produtos/exibir', 'id' => $produto->id])?>"><?= $produto->nome ?></a></p>
                        <?php endforeach;
                        if (!$cont) { ?>
                            <p>Nenhum resultado</p>
                        <?php } ?>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">Últimas Compras</div>
                    <div class="panel-body">
                        <?php
                        $cont = 0;
                        foreach (Pedidos::find()->where(['confirmado' => 1, 'pago' => 1])->orderBy('valor_total DESC')->limit(5)->all() as $item): $cont++ ?>
                            <p><?php echo Html::encode($item->nome . ' - (R$ ' . number_format($item->valor_total, '2', ',', '.') . ')') ?></p>
                        <?php endforeach;
                        if (!$cont) { ?>
                            <p>Nenhum resultado</p>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <?=\common\widgets\Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?=Yii::$app->name?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
