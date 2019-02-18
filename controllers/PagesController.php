<?php

class PagesController extends Db {

    public function home() {

        view('pages.home');

    }

    public function divers() {
        ob_start();
    
        /**
         * 
         */
        echo "<h3>Afficher le nombre de conducteurs: </h3>";
        $req = 'SELECT COUNT(*) as nb FROM conducteur';
        $res = Db::dbQuery($req);
        echo $res[0]['nb'];
        echo '<hr>';

        /**
         * 
         */
        echo "<h3>Afficher le nombre de véhicules: </h3>";
        $req = 'SELECT COUNT(*) as nb FROM vehicule';
        $res = Db::dbQuery($req);

        echo $res[0]['nb'];
        echo '<hr>';

        /**
         *
         */
        echo "<h3>Afficher le nombre d'associations: </h3>";
        $req = 'SELECT COUNT(*) as nb FROM association_vehicule_conducteur';
        $res = Db::dbQuery($req);

        echo $res[0]['nb'];
        echo '<hr>';

        /**
         * 
         */

        echo "<h3>Afficher les véhicules n'ayant pas de conducteur</h3>";
        $req= ' SELECT vehicule.id_vehicule, marque, modele, couleur, immatriculation
                FROM vehicule
                LEFT JOIN association_vehicule_conducteur
                    ON association_vehicule_conducteur.id_vehicule = vehicule.id_vehicule
                WHERE id_conducteur IS NULL';
        $res = Db::dbQuery($req);

        echo "<table class='table'>";
        foreach($res as $v) {
            ?>
            <tr>
                <td><?= $v['id_vehicule'] ?></td>
                <td><?= $v['marque'] ?></td>
                <td><?= $v['modele'] ?></td>
                <td><?= $v['couleur'] ?></td>
                <td><?= $v['immatriculation'] ?></td>
            </tr>
            <?php 
        }

        echo '</table>';
        echo '<hr>';

        /**
         * 
         */
        echo '<h3>Afficher les conducteurs n\'ayant pas de véhicule</h3>';
        $req = '    SELECT conducteur.id_conducteur, prenom, nom
                    FROM conducteur
                    LEFT JOIN association_vehicule_conducteur
                        ON association_vehicule_conducteur.id_conducteur = conducteur.id_conducteur
                    WHERE id_vehicule IS NULL';
        $res = Db::dbQuery($req);

        echo "<table class='table'>";
        foreach ($res as $v) {
            ?>
            <tr>
                <td><?= $v['id_conducteur'] ?></td>
                <td><?= $v['prenom'] ?></td>
                <td><?= $v['nom'] ?></td>
            </tr>
            <?php 
        }

        echo '</table>';

        /**
         * 
         */
        echo '<h3>Afficher les véhicules conduits par Philippe Pandre</h3>';
        $req = "    SELECT vehicule.id_vehicule, marque, modele, couleur, immatriculation
                    FROM vehicule
                    INNER JOIN association_vehicule_conducteur
                        ON association_vehicule_conducteur.id_vehicule = vehicule.id_vehicule

                    INNER JOIN conducteur
                        ON conducteur.id_conducteur = association_vehicule_conducteur.id_conducteur
                        
                    WHERE prenom = 'Philippe'
                    AND nom = 'Pandre'";
        $res = Db::dbQuery($req);

        echo "<table class='table'>";
        foreach ($res as $v) {
            ?>
            <tr>
                <td><?= $v['id_vehicule'] ?></td>
                <td><?= $v['marque'] ?></td>
                <td><?= $v['modele'] ?></td>
                <td><?= $v['couleur'] ?></td>
                <td><?= $v['immatriculation'] ?></td>
            </tr>
            <?php 
        }

        echo '</table>';
        echo '<hr>';

        /**
         * 
         */
        echo '<h3>Afficher tous les conducteurs (meme ceux qui nont pas de correspondance) ainsi que les vehicules</h3>';
        $req = "    SELECT modele, prenom
                    FROM conducteur

                    LEFT JOIN association_vehicule_conducteur
                        ON association_vehicule_conducteur.id_conducteur = conducteur.id_conducteur

                    LEFT JOIN vehicule
                        ON	vehicule.id_vehicule = association_vehicule_conducteur.id_vehicule";
        $res = Db::dbQuery($req);

        echo "<table class='table'>";
        foreach ($res as $v) {
            ?>
            <tr>
                <td><?= $v['modele'] == null ? 'null' : $v['modele'] ?></td>
                <td><?= $v['prenom'] == null ? 'null' : $v['prenom'] ?></td>
            </tr>
            <?php 
        }

        echo '</table>';
        echo '<hr>';
        /**
         * 
         */
        echo '<h3>Afficher tous les conducteurs et tous les vehicules (même ceux qui nònt pas de correspondance)</h3>';
        $req = "    SELECT modele, prenom
                    FROM vehicule

                    LEFT JOIN association_vehicule_conducteur
                        ON association_vehicule_conducteur.id_vehicule = vehicule.id_vehicule

                    LEFT JOIN conducteur
                        ON	conducteur.id_conducteur = association_vehicule_conducteur.id_conducteur";
        $res = Db::dbQuery($req);

        echo "<table class='table'>";
        foreach ($res as $v) {
            ?>
            <tr>
                <td><?= $v['modele'] == null ? 'null' : $v['modele'] ?></td>
                <td><?= $v['prenom'] == null ? 'null' : $v['prenom'] ?></td>
            </tr>
            <?php 
        }

        echo '</table>';
        echo '<hr>';

        /**
         * 
         */
        echo '<h3>Afficher tous les conducteurs et tous les vehicules, peu importe les correpsondances</h3>';
        $req = "    SELECT modele, prenom
                    FROM conducteur

                    LEFT JOIN association_vehicule_conducteur
                        ON association_vehicule_conducteur.id_conducteur = conducteur.id_conducteur

                    LEFT JOIN vehicule
                        ON	vehicule.id_vehicule = association_vehicule_conducteur.id_vehicule
                        
                    UNION

                    SELECT modele, prenom
                    FROM vehicule

                    LEFT JOIN association_vehicule_conducteur
                        ON association_vehicule_conducteur.id_vehicule = vehicule.id_vehicule

                    LEFT JOIN conducteur
                        ON	conducteur.id_conducteur = association_vehicule_conducteur.id_conducteur";
        $res = Db::dbQuery($req);

        echo "<table class='table'>";
        foreach ($res as $v) {
            ?>
            <tr>
                <td><?= $v['modele'] == null ? 'null' : $v['modele'] ?></td>
                <td><?= $v['prenom'] == null ? 'null' : $v['prenom'] ?></td>
            </tr>
            <?php 
        }

        echo '</table>';



        







        $content = ob_get_clean();
        view('template', compact('content'));
    }
}