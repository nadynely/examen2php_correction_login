<?php

class AssociationsController {
    public function index() {

        $associations = Association::findAll();
        $conducteurs = Conducteur::findAll();
        $vehicules = Vehicule::findAll();

        view('associations.index', compact('associations', 'conducteurs', 'vehicules'));
    }

    public function delete($id) {

        $association = Association::findOne($id);
        $association->delete();

        Header('Location: ' . url('associations'));

    }

    public function save() {

        $association = new Association(
            intval($_POST['id_vehicule']), 
            intval($_POST['id_conducteur']), 
            intval($_POST['id_association'])
        );
        $association->save();
        
        Header('Location: ' . url('associations'));
    }
}