<?php ob_start(); ?>

    <table class="table table-striped text-center">
        <tr>
            <th>id_vehicule</th>
            <th>marque</th>
            <th>modele</th>
            <th>couleur</th>
            <th>immatriculation</th>
            <th>modification</th>
            <th>suppression</th>
        </tr>

        <?php foreach ($vehicules as $vehicule) : ?>

            <tr>
                <td><?= $vehicule->idVehicule() ?></td>
                <td><?= $vehicule->marque() ?></td>
                <td><?= $vehicule->modele() ?></td>
                <td><?= $vehicule->couleur() ?></td>
                <td><?= $vehicule->immatriculation() ?></td>
                <td>
                    <a  class="edit-vehicule" 
                        data-id="<?= $vehicule->idVehicule() ?>"
                        data-marque="<?= $vehicule->marque() ?>"
                        data-modele="<?= $vehicule->modele() ?>"
                        data-couleur="<?= $vehicule->couleur() ?>"
                        data-immatriculation="<?= $vehicule->immatriculation() ?>"
                        href="#"
                    >
                            <i class="fas fa-pen"></i>
                    </a>
                </td>
                <td><a class="delete" href="<?= url('vehicules/' . $vehicule->idVehicule() . '/delete') ?>"><i class="fas fa-trash"></i></a></td>
            </tr>
        <?php endforeach; ?>
    </table>


<form action="<?= url('vehicules/save') ?>" method="post">

    <input id="vehiculeId" type="hidden" name="id_vehicule">

    <label for="vehiculeMarque">Marque</label>
    <input type="text" id="vehiculeMarque" class="form-control" name="marque" required>

    <label for="vehiculeModele">Modèle</label>
    <input type="text" id="vehiculeModele" class="form-control" name="modele" required>

    <label for="vehiculeCouleur">Couleur</label>
    <input type="text" id="vehiculeCouleur" class="form-control" name="couleur" required>

    <label for="vehiculeImmatriculation">Immatriculation</label>
    <input type="text" id="vehiculeImmatriculation" class="form-control" name="immatriculation" required>


    <hr>

    <button id="vehiculeSubmit" type="submit" class="btn btn-primary">Ajouter ce véhicule</button>
</form>

<?php $content = ob_get_clean(); ?>

<?php view('template', compact('content')); ?>