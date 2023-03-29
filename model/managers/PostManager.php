<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\TopicManager;

    class PostManager extends Manager{

        protected $className = "Model\Entities\Post";
        protected $tableName = "post";


        public function __construct(){
            parent::connect();
        }

        public function findPostsByTopic($id) 
        {
            $sql = "SELECT * 
                    FROM ".$this->tableName." p
                    WHERE p.topic_id = :id
                    ORDER BY dateCreationPost";


            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]),
                $this->className
            );
        }

        public function postDeleter($id)
        {
        $sql = "DELETE FROM ".$this->tableName." 
                WHERE id_post = :id";

                DAO::delete($sql, ['id' => $id]);

        $postManager = new PostManager();
        $topicId = 85;

        $sql = "SELECT COUNT(*) AS post_count 
                FROM ".$this->tableName."
                WHERE topic_id = :topicId";

        
        }




    }