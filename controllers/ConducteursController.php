<?php

class ConducteursController {
    public function index() {

        $conducteurs = Conducteur::findAll();
        view('conducteurs.index', compact('conducteurs'));
    }

    public function delete($id) {

        $conducteur = Conducteur::findOne($id);
        $conducteur->delete();

        Header('Location: ' . url('conducteurs'));

    }

    public function save() {

        $conducteur = new Conducteur($_POST['prenom'], $_POST['nom'], intval($_POST['id_conducteur']));
        $conducteur->save();
        
        Header('Location: ' . url('conducteurs'));
    }
}