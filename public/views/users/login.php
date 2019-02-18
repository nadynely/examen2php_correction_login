<?php ob_start(); ?>

<form action="">
   <div class= "form-group">
       <label for="loginEmail">E-mail</label>
       <input type="loginEmail" name="email" type="email" class="form-control" required>
   </div>

   <div class="form-group">
       <label for="loginPassword">Mot de passe</label>
       <input type="loginPassword" name="password" type="password" class="form-control" required>
    <div>
    <div class="form-group">
       <label for="loginPasswordConfirm">Mot de passe (confirmation)</label>
       <input type="loginPassword" name="password" type="password" class="form-control" required>
   </div>
   <div class="form-group">
        <button type="submit" class="btn btn-success">Se connecter</button>
    </div>
</form>
<?php $content = ob_get_clean(); ?>

<?php view('template', compact('content')); ?>