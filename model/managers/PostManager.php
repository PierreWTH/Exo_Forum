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

        // Récuperer un topic a partir d'un post
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

        // Supprimer un post
        public function postDeleter($id)
        {

        $topicId = $this->findOneById($id)->getTopic()->getId();
            

        $deletePostRequest = "DELETE FROM ".$this->tableName." 
                WHERE id_post = :id";

                DAO::delete($deletePostRequest, ['id' => $id]);
                

        $countPostRequest = "SELECT COUNT(*) AS post_count 
                FROM ".$this->tableName."
                WHERE topic_id = :topicId";

        
        $nbrPost = DAO::select($countPostRequest, ['topicId' => $topicId], false);
        
            if (intval($nbrPost['post_count']) == 0)
            {
                $topicManager = new topicManager();
                $topicManager->topicDeleter($topicId);
            }
        
            return $nbrPost;
        }

    }
        
        
        