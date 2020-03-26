<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="shortcut icon" href="#" type="image/x-icon">

    <link rel="stylesheet" href="<?= url("/themes/assets/css/_style.css"); ?>">
    <link rel="stylesheet" href="<?= url("/themes/assets/css/bootstrap.min.css"); ?>">
    <link rel="stylesheet" href="<?= url("/themes/assets/css/all.css"); ?>">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">TO DO <i class="fas fa-mug-hot"></i></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <?php if(!empty($_SESSION["token"])): ?>
                <?php endif; ?>
                <div class="navbar-nav navbar-right ml-auto">
                    <?php if(!empty($_SESSION["token"])): ?>
                        <a class="nav-item nav-link" href="<?= url("/logout"); ?>">Logout</a>
                    <?php else:?>
                        <a class="nav-item nav-link" href="<?= url("/login"); ?>">Login</a>
                    <?php endif; ?>
                </div>  
            </div>
        </nav>

        <main class="main_content">
            <div class="container">
                <?= $v->section("content"); ?>
            </div>
        </main>

        <footer class="footer_main container">
            <?= SITE ?> 2020 | <i class="fas fa-mug-hot"></i>
        </footer> 
    </div>
    
    <script src="<?= url("/themes/assets/js/jquery-3.4.1.min.js"); ?>"></script>   
    <script src="<?= url("/themes/assets/js/bootstrap.min.js"); ?>"></script>   
    <script src="<?= url("/themes/assets/js/bootstrap.bundle.min.js"); ?>"></script>   
    <script type="module" src="<?= url("/themes/assets/js/helpers.js"); ?>"></script>
    <script src="<?= url("/themes/assets/js/vue.js"); ?>"></script>
    <script type="module" src="<?= url("/themes/assets/js/app-vue.js"); ?>"></script>
</body>
</html>