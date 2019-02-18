<?php ob_start(); ?>


<form action="<?= url('signup') ?>" method="post" class="form">

    <div class="form-group">
        <label for="loginEmail">E-mail</label>
        <input id="loginEmail" name="email" type="email" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="loginPseudo">Pseudo</label>
        <input id="loginPseudo" name="pseudo" type="pseudo" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="loginPassword">Mot de passe</label>
        <input id="loginPassword" name="password" type="password" class="form-control" required>

    </div>

    <div class="form-group">
        <label for="loginPasswordConfirm">Mot de passe (confirmation)</label>
        <input id="loginPasswordConfirm" name="password_confirm" type="password" class="form-control" required>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success">Créer mon compte</button>
    </div>

</form>

<?php $content = ob_get_clean(); ?>

<?php view('template', compact('content')); ?>