<?php

class VehiculesController {
    public function index() {

        $vehicules = Vehicule::findAll();
        view('vehicules.index', compact('vehicules'));
    }

    public function delete($id) {

        $vehicule = Vehicule::findOne($id);
        $vehicule->delete();

        Header('Location: ' . url('vehicules'));

    }

    public function save() {

        $vehicule = new Vehicule(
            $_POST['marque'],
            $_POST['modele'],
            $_POST['couleur'],
            $_POST['immatriculation'],
            intval($_POST['id_vehicule'])
        );
        $vehicule->save();
        
        Header('Location: ' . url('vehicules'));
    }
}