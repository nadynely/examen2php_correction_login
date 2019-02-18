<?php

class Association extends Db {

    protected $id_association;
    protected $id_vehicule;
    protected $id_conducteur;

    const TABLE_NAME = 'association_vehicule_conducteur';

    public function __construct(int $id_vehicule, int $id_conducteur, int $id_association = null) {

        $this->setIdAssociation($id_association);
        $this->setIdVehicule($id_vehicule);
        $this->setIdConducteur($id_conducteur);

    }

    public function idAssociation() { return $this->id_association; }
    public function idVehicule() { return $this->id_vehicule; }
    public function idConducteur() { return $this->id_conducteur; }

    public function setIdAssociation($id_association) {
        $this->id_association = $id_association;
        return $this;
    }

    public function setIdVehicule($id_vehicule) {
        $this->id_vehicule = $id_vehicule;
        return $this;
    }

    public function setIdConducteur($id_conducteur) {
        $this->id_conducteur = $id_conducteur;
        return $this;
    }

    /**
     * CRUD
     */

    public static function findAll() {

        $datas = Db::dbFind(self::TABLE_NAME);

        $associations = [];


        foreach($datas as $data) {

            $associations[] = new Association(
                intval($data['id_vehicule']),
                intval($data['id_conducteur']),
                intval($data['id_association'])
            );
        }

        return $associations;
    }

    public static function findOne(int $id) {
        $data = Db::dbFind(self::TABLE_NAME, [
            ['id_association', '=', $id]
        ]);

        if (count($data) > 0) $data = $data[0];
        else throw new Exception('L\'association n\'existe pas.');


        $association = new Association(
            intval($data['id_vehicule']),
            intval($data['id_conducteur']),
            intval($data['id_association'])
        );

        return $association;
    }

    public function save() {
        $data = [
            'id_vehicule' => $this->idVehicule(),
            'id_conducteur' => $this->idConducteur(),
        ];

        if($this->idAssociation() > 0) return $this->update($data);

        $this->setIdAssociation( Db::dbCreate(self::TABLE_NAME, $data) );

        return $this;
    }

    protected function update(array $data) {

        $data['id_association'] = $this->idAssociation();

        Db::dbUpdate(self::TABLE_NAME, $data, 'id_association');
        return $this;
    }

    public function delete() {
        
        Db::dbDelete(self::TABLE_NAME, [
            'id_association' => $this->idAssociation()
        ]);

        Db::dbDelete(Association::TABLE_NAME, [
            'id_association' => $this->idAssociation()
        ]);

        return;
    }

    public function conducteur() {
        return Conducteur::findOne($this->idConducteur());
    }

    public function vehicule() {
        return Vehicule::findOne($this->idVehicule());
    }
}