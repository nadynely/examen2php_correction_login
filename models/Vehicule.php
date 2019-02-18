<?php

class Vehicule extends Db {

    protected $id_vehicule;
    protected $marque;
    protected $modele;
    protected $couleur;
    protected $immatriculation;

    const TABLE_NAME = 'vehicule';

    public function __construct(string $marque, string $modele, string $couleur, string $immatriculation, int $id_vehicule = null) {

        $this->setIdVehicule($id_vehicule);
        $this->setMarque($marque);
        $this->setModele($modele);
        $this->setCouleur($couleur);
        $this->setImmatriculation($immatriculation);

    }

    public function idVehicule() { return $this->id_vehicule; }
    public function marque() { return $this->marque; }
    public function modele() { return $this->modele; }
    public function couleur() { return $this->couleur; }
    public function immatriculation() { return $this->immatriculation; }


    public function setIdVehicule($id_vehicule) {
        $this->id_vehicule = $id_vehicule;
        return $this;
    }

    public function setMarque($marque) {
        if (strlen($marque) === 0) throw new Exception('Le champ marque ne peut pas être vide.');

        $this->marque = $marque;
        return $this;
    }

    public function setModele($modele) {
        if (strlen($modele) === 0) throw new Exception('Le champ modele ne peut pas être vide.');

        $this->modele = $modele;
        return $this;
    }

    public function setCouleur($couleur) {
        if (strlen($couleur) === 0) throw new Exception('Le champ couleur ne peut pas être vide.');

        $this->couleur = $couleur;
        return $this;
    }

    public function setImmatriculation($immatriculation) {
        if (strlen($immatriculation) === 0) throw new Exception('Le champ immatriculation ne peut pas être vide.');

        $this->immatriculation = $immatriculation;
        return $this;
    }

    /**
     * CRUD
     */

    public static function findAll() {

        $datas = Db::dbFind(self::TABLE_NAME);

        $vehicules = [];

        foreach($datas as $data) {
            $vehicules[] = new Vehicule(
                $data['marque'],
                $data['modele'],
                $data['couleur'],
                $data['immatriculation'],
                intval($data['id_vehicule'])
            );
        }

        return $vehicules;
    }

    public static function findOne(int $id) {
        $data = Db::dbFind(self::TABLE_NAME, [
            ['id_vehicule', '=', $id]
        ]);

        if (count($data) > 0) $data = $data[0];
        else throw new Exception('Le véhicule n\'existe pas.');


        $vehicule = new Vehicule(
            $data['marque'],
            $data['modele'],
            $data['couleur'],
            $data['immatriculation'],
            intval($data['id_vehicule'])
        );

        return $vehicule;
    }

    public function save() {
        $data = [
            'marque' => $this->marque(),
            'modele' => $this->modele(),
            'couleur' => $this->couleur(),
            'immatriculation' => $this->immatriculation(),
        ];

        if($this->idVehicule() > 0) return $this->update($data);

        $this->setIdVehicule( Db::dbCreate(self::TABLE_NAME, $data) );

        return $this;
    }

    protected function update(array $data) {

        $data['id_vehicule'] = $this->idVehicule();

        Db::dbUpdate(self::TABLE_NAME, $data, 'id_vehicule');
        return $this;
    }

    public function delete() {
        
        Db::dbDelete(self::TABLE_NAME, [
            'id_vehicule' => $this->idVehicule()
        ]);

        Db::dbDelete(Association::TABLE_NAME, [
            'id_vehicule' => $this->idVehicule()
        ]);

        return;
    }

}
