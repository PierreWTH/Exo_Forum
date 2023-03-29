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

        public function topicLocker($id)
        {
        $sql = "UPDATE ".$this->tableName." 
                SET locked = 1
                WHERE id_topic = :id";

                DAO::update($sql, ['id' => $id]);
            
        
        }

        public function topicUnlocker($id)
        {
        $sql = "UPDATE ".$this->tableName." 
                SET locked = 0
                WHERE id_topic = :id";

                DAO::update($sql, ['id' => $id]);
            
        
        }

    }