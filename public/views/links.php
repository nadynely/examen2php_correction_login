<a href="<?= url(''); ?>" class="text-white">Accueil</a>

<!-- TODO: n'afficher conducteurs/associations/vehicules/divers que si l'user est logué -->


<a href="<?= url('conducteurs'); ?>" class="text-white">Conducteurs</a>
<a href="<?= url('associations'); ?>" class="text-white">Associations</a>
<a href="<?= url('vehicules'); ?>" class="text-white">Véhicules</a>
<a href="<?= url('divers'); ?>" class="text-white">Divers</a>

<?php if (isset($_SESSION['user'])) : ?>
    <a href="<?= url('logout'); ?>" class="text-white">Deconnexion</a>
<?php else : ?>
    <a href="<?= url('signup'); ?>" class="text-white">Créer un compte</a>
    <a href="<?= url('login'); ?>" class="text-white">Connexion</a>
<?php endif; ?>