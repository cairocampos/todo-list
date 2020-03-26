<?php $v->layout("_template"); ?>



<h1>Login</h1>
<div id="login">
<form action="" method="post" class="form" @submit.prevent="SendForm">

    <?php if(isset($error)): ?>
        <div class="col-6">
        <div class="alert alert-danger"><?= $error; ?></div>
    </div>
    <?php endif; ?>

    <div class="form-group col-6">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" v-model="registerForm.email">
    </div>
    <div class="form-group col-6">
        <label for="pass">Senha</label>
        <input type="password" name="pass" class="form-control" v-model="registerForm.pass">
    </div>

    <div class="form-group col-6 text-right">
        <input class="btn btn-outline-primary" type="submit" value="Entrar">
        <hr>
    </div>
    <div class="form-group col-6">
        <a href="<?= url("/register"); ?>" class="stretched-link">Registrar</a>
    </div>
</form>
</div>