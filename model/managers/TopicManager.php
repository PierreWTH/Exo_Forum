<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\TopicManager;

    class TopicManager extends Manager
    {

        protected $className = "Model\Entities\Topic";
        protected $tableName = "topic";


        public function __construct(){
            parent::connect();
        }

        public function listTopicsByCategorie($id) 
        {
            $sql = "SELECT * 
                    FROM ".$this->tableName." t
                    WHERE t.categorie_id = :id";


            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]),
                $this->className
            );
        }

        public function addTopic()
        {
            $sql = "INSERT INTO 
                    FROM ".$this->tableName." t
                    WHERE t.categorie_id = :id";
        } 
    }