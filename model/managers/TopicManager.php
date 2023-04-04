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

        // Lister les topics par catégorie
        public function listTopicsByCategorie($id) 
        {
            $sql = "SELECT t.*, COUNT(p.id_post) as nbPosts, MAX(dateCreationPost) as lastPost
                    FROM ".$this->tableName." t
                    LEFT JOIN post p on t.id_". $this->tableName . " = p.topic_id
                    WHERE t.categorie_id = :id
                    GROUP BY t.id_".$this->tableName ."
                    ORDER BY lastPost DESC";


            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]),
                $this->className
            );
        }

        public function listTopicsAndCount() 
        {
            $sql = "SELECT t.*, COUNT(p.id_post) as nbPosts , MAX(dateCreationPost) as lastPost 
                    FROM ".$this->tableName." t
                    LEFT JOIN post p on t.id_". $this->tableName . " = p.topic_id
                    GROUP BY t.id_".$this->tableName ."
                    ORDER BY lastPost DESC";


            return $this->getMultipleResults(
                DAO::select($sql),
                $this->className
            );
        }

        // Verouiller un topic
        public function topicLocker($id)
        {
        $sql = "UPDATE ".$this->tableName." 
                SET locked = 1
                WHERE id_topic = :id";

                DAO::update($sql, ['id' => $id]);
            
        
        }

        // Déverouiller un topic
        public function topicUnlocker($id)
        {
        $sql = "UPDATE ".$this->tableName." 
                SET locked = 0
                WHERE id_topic = :id";

                DAO::update($sql, ['id' => $id]);
            
        
        }

        // Supprimer un topic
        public function topicDeleter($id)
        {
        
        $sql = "DELETE FROM post 
                WHERE topic_id = :id";

                DAO::delete($sql, ['id' => $id]);

        $sql = "DELETE FROM ".$this->tableName." 
        WHERE id_topic = :id";

                DAO::delete($sql, ['id' => $id]);     
        
        }

}       