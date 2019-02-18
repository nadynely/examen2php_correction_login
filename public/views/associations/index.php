<?php ob_start(); ?>

    <table class="table table-striped text-center">
        <tr>
            <th>id_association</th>
            <th>conducteur</th>
            <th>vehicule</th>
            <th>modification</th>
            <th>suppression</th>
        </tr>

        <?php foreach($associations as $association) : ?>

            <tr>
                <td><?= $association->idAssociation() ?></td>
                <td><?= $association->conducteur()->prenom() . ' ' . $association->conducteur()->nom() . '<br>' . $association->conducteur()->idConducteur() ?></td>
                <td><?= $association->vehicule()->marque() . ' ' . $association->vehicule()->modele() . '<br>' . $association->vehicule()->idVehicule() ?></td>
                <td>
                    <a  class="edit-association" 
                        data-id="<?= $association->idAssociation() ?>"
                        data-idconducteur="<?= $association->idConducteur() ?>"
                        data-idvehicule="<?= $association->idVehicule() ?>"
                        href="#"
                    >
                            <i class="fas fa-pen"></i>
                    </a>
                </td>
                <td><a class="delete" href="<?= url('associations/' . $association->idAssociation() . '/delete') ?>"><i class="fas fa-trash"></i></a></td>
            </tr>
        <?php endforeach; ?>
    </table>


<form action="<?= url('associations/save')?>" method="post">

    <input id="associationId" type="hidden" name="id_association">

    <label for="associationIdConducteur">Conducteur</label>
    <select id="associationIdConducteur" class="form-control" name="id_conducteur">
        <option disabled selected>Choisir...</option>
        <?php foreach($conducteurs as $conducteur) : ?>
        <option value="<?= $conducteur->idConducteur() ?>"><?= $conducteur->prenom() ?> <?= $conducteur->nom() ?></option>
        <?php endforeach; ?>
    </select>

    <label for="associationIdVehicule">Véhicule</label>
    <select id="associationIdVehicule" class="form-control" name="id_vehicule">
        <option disabled selected>Choisir...</option>
        <?php foreach($vehicules as $vehicule) : ?>
        <option value="<?= $vehicule->idVehicule() ?>"><?= $vehicule->marque() ?> - <?= $vehicule->modele() ?> (<?= $vehicule->immatriculation() ?>)</option>
        <?php endforeach; ?>
    </select>

    <hr>

    <button id="associationSubmit" type="submit" class="btn btn-primary">Ajouter cette association</button>
</form>

<?php $content = ob_get_clean(); ?>

<?php view('template', compact('content')); ?>