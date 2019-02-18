<?php ob_start(); ?>

    <table class="table table-striped text-center">
        <tr>
            <th>id_conducteur</th>
            <th>prenom</th>
            <th>nom</th>
            <th>modification</th>
            <th>suppression</th>
        </tr>

        <?php foreach ($conducteurs as $conducteur) : ?>

            <tr>
                <td><?= $conducteur->idConducteur() ?></td>
                <td><?= $conducteur->prenom() ?></td>
                <td><?= $conducteur->nom() ?></td>
                <td>
                    <a  class="edit-conducteur" 
                        data-id="<?= $conducteur->idConducteur() ?>"
                        data-prenom="<?= $conducteur->prenom() ?>"
                        data-nom="<?= $conducteur->nom() ?>"
                        href="#"
                    >
                            <i class="fas fa-pen"></i>
                    </a>
                </td>
                <td><a class="delete" href="<?= url('conducteurs/' . $conducteur->idConducteur() . '/delete') ?>"><i class="fas fa-trash"></i></a></td>
            </tr>
        <?php endforeach; ?>
    </table>


<form action="<?= url('conducteurs/save') ?>" method="post">

    <input id="conducteurId" type="hidden" name="id_conducteur">

    <label for="conducteurPrenom">Prénom</label>
    <input type="text" id="conducteurPrenom" class="form-control" name="prenom" required>

    <label for="conducteurNom">Nom</label>
    <input type="text" id="conducteurNom" class="form-control" name="nom" required>


    <hr>

    <button id="conducteurSubmit" type="submit" class="btn btn-primary">Ajouter ce conducteur</button>
</form>


<?php $content = ob_get_clean(); ?>

<?php view('template', compact('content')); ?>