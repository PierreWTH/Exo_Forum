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

            return $this->getOneOrNullResult(
                DAO::select($sql, ['email' => $email], false),
                $this->className
            );
        }

        public function findOneByPseudo($pseudo)
        {
            $sql = "SELECT *
                    FROM ".$this->tableName." u 
                    WHERE u.pseudo = :pseudo";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['pseudo' => $pseudo], false),
                $this->className
            );
        }

        public function retrievePassword($email)
        {
            $sql = "SELECT password
            FROM " .$this->tableName." u
            WHERE u.email = :email";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['email' => $email], false),
                $this->className
            );


        }

        public function hasRole($role)
        {
            $sql = "SELECT role
            FROM " .$this->tableName." u
            WHERE u.role = :role";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['role' => $role], false),
                $this->className
            );
        }





    }