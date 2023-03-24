<?php
    namespace Model\Entities;

    use App\Entity;

    final class Post extends Entity{

        private $id;
        private $texte;
        private $dateCreationPost;
        private $topic;
        private $user;

        public function __construct($data){         
            $this->hydrate($data);        
        }


        // Get value ID 
        public function getId()
        {
                return $this->id;
        }

       // Set value ID
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        // Get value Texte
        public function getTexte()
        {
                return $this->texte;
        }

        // Set value Texte
        public function setTexte($texte)
        {
                $this->texte = $texte;

                return $this;
        }

        // Get dateCreationPost
        public function getDateCreationPost(){
            $formattedDate = $this->dateCreationPost->format("d/m/Y, H:i:s");
            return $formattedDate;
        }

        // Set dateCreationPost
        public function setDateCreationPost($date){
            $this->dateCreationPost = new \DateTime($date);
            return $this;
        }

        // Get value Topic
        public function getTopic()
        {
                return $this->topic;
        }

        // Set value Topic
        public function setTopic($topic)
        {
                $this->topic = $topic;

                return $this;
        }

        // Get value topic
        public function getUser()
        {
                return $this->user;
        }

        // Set value User
        public function setUser($user)
        {
                $this->user = $user;

                return $this;
        }
    }