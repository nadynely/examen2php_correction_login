<?php

class Conducteur extends Db {

    protected $id_conducteur;
    protected $prenom;
    protected $nom;

    const TABLE_NAME = 'conducteur';
    

    public function __construct(string $prenom, string $nom, int $id_conducteur = null) {

        $this->setIdConducteur($id_conducteur);
        $this->setPrenom($prenom);
        $this->setNom($nom);

    }

    public function idConducteur() { return $this->id_conducteur; }
    public function prenom() { return $this->prenom; }
    public function nom() { return $this->nom; }

    public function setIdConducteur($id_conducteur) { 
        $this->id_conducteur = $id_conducteur;
        return $this;
    }

    public function setPrenom($prenom) {
        if (strlen($prenom) === 0) throw new Exception('Le champ prenom ne peut pas être vide.');

        $this->prenom = $prenom;
        return $this;
    }

    public function setNom($nom) {
        if (strlen($nom) === 0) throw new Exception('Le champ nom ne peut pas être vide.');

        $this->nom = $nom;
        return $this;
    }

    /**
     * CRUD
     */

    public static function findAll() {

        $datas = Db::dbFind(self::TABLE_NAME);

        $conducteurs = [];

        foreach($datas as $data) {
            $conducteurs[] = new Conducteur(
                $data['prenom'],
                $data['nom'],
                intval($data['id_conducteur'])
            );
        }

        return $conducteurs;
    }

    public static function findOne(int $id) {
        $data = Db::dbFind(self::TABLE_NAME, [
            ['id_conducteur', '=', $id]
        ]);

        if (count($data) > 0) $data = $data[0];
        else throw new Exception('Le conducteur n\'existe pas.');


        $conducteur = new Conducteur(
            $data['prenom'],
            $data['nom'],
            intval($data['id_conducteur'])
        );

        return $conducteur;
    }

    public function save() {
        $data = [
            'prenom' => $this->prenom(),
            'nom' => $this->nom(),
        ];

        if($this->idConducteur() > 0) return $this->update($data);

        $this->setIdConducteur( Db::dbCreate(self::TABLE_NAME, $data) );

        return $this;
    }

    protected function update(array $data) {

        $data['id_conducteur'] = $this->idConducteur();

        Db::dbUpdate(self::TABLE_NAME, $data, 'id_conducteur');
        return $this;
    }

    public function delete() {
        
        Db::dbDelete(self::TABLE_NAME,[
            'id_conducteur' => $this->idConducteur()
        ]);

        Db::dbDelete(Association::TABLE_NAME, [
            'id_conducteur' => $this->idConducteur()
        ]);

        return;
    }
}