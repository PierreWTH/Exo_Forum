<?php
    namespace Model\Entities;

    use App\Entity;

    final class Categorie extends Entity{

        private $id;
        private $nomCategorie;

        public function __construct($data){         
            $this->hydrate($data);        
        }


        // get value ID
        public function getId()
        {
                return $this->id;
        }

       // set value ID
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        //get value nomCategorie 
        public function getNomCategorie()
        {
                return $this->nomCategorie;
        }

        // set value nomCategorie
        public function setNomCategorie($nomCategorie)
        {
                $this->nomCategorie = $nomCategorie;

                return $this;
        }
}