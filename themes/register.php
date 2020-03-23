<?php $v->layout("_template"); ?>

<h1>Registrar</h1>
<div id="register">
<form action="" method="post" class="form" @submit.prevent="SendForm">

    <?php if(isset($success)): ?>
    <div class="col-6">
        <div class="alert alert-success"><?= $success; ?></div>
    </div>
    <?php elseif(isset($error)): ?>
        <div class="col-6">
        <div class="alert alert-danger"><?= $error; ?></div>
    </div>
    <?php endif; ?>

    <div class="form-group col-6">
        <label for="name">Nome <span class="input-required">{{required.name}}</span></label>
        <input type="text" name="name" class="form-control" v-model="registerForm.name">
    </div>

    <div class="form-group col-6">
        <label for="email">Email <span class="input-required">{{required.email}}</span></label>
        <input type="email" name="email" class="form-control" v-model="registerForm.email">
    </div>
    <div class="form-group col-6">
        <label for="pass">Senha <span class="input-required">{{required.pass}}</span></label>
        <input type="password" name="pass" class="form-control" v-model="registerForm.pass">
    </div>

    <div class="form-group col-6 text-right">
        <input class="btn btn-outline-secondary" type="submit" value="Cadastrar">
    </div>
</form>
</div>