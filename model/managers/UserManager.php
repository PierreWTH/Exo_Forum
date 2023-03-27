<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

    class UserManager extends Manager{

        protected $className = "Model\Entities\User";
        protected $tableName = "user";


        public function __construct(){
            parent::connect();
        }


        public function findOneByEmail($email)
        {
            $sql = "SELECT *
                    FROM ".$this->tableName." a 
                    WHERE a.email = :email";

            return $this->GetOneOrNullResult(
                DAO::select($sql, ['email' => $email], false),
                $this->className
            );
        }

        public function findOneByPseudo($pseudo)
        {
            $sql = "SELECT *
                    FROM ".$this->tableName." u 
                    WHERE u.pseudo = :pseudo";

            return $this->GetOneOrNullResult(
                DAO::select($sql, ['pseudo' => $email], false),
                $this->className
            );
        }







    }