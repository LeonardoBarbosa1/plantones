<?php

/* @var $this \yii\web\View */
/* @var $content string */

\hail812\adminlte3\assets\AdminLteAsset::register($this);
$this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700');
$this->registerCssFile('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css');
\hail812\adminlte3\assets\PluginAsset::register($this)->add(['fontawesome', 'icheck-bootstrap']);

$this->registerCss("
    body{
        background-image: url('/img/fundo-login-register.avif'); /* Substitua pela URL da sua imagem */
        background-size: cover; /* Faz a imagem cobrir toda a área */
        background-position: center; /* Centraliza a imagem */
        background-repeat: no-repeat; /* Não repete a imagem */
    }
");
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Plantones | <?= Yii::$app->view->params['paramName'] ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body class="hold-transition login-page">
<?php  $this->beginBody() ?>
<div class="login-box">
    <div class="login-logo" style="text-align: center;">
        <img src="/img/Plantones.png" alt="Logo Plantones" style="width: 180px; border-radius: 90px; max-width: 100%; height: auto;">
    </div>
    <!-- /.login-logo -->

    <?= $content ?>
</div>
<!-- /.login-box -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>