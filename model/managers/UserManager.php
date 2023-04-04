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

        // Retrouver un user en passant par son mail 
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

        // Retrouver un user par son pseudo
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

        // Retrouver un mot de passe en passant par l'email
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

        // Bannir un utilisateur 
        public function userBanner($id, $level)
        {
            $sql = "UPDATE user
            SET banStatus = :level
            WHERE id_user = :id";

                DAO::update($sql, ['level' => $level, 'id' => $id], false);
           
        }

        // Bannir un utilisateur 
        public function attributeRole($id, $role)
        {
            $sql = "UPDATE user
            SET role = :role
            WHERE id_user = :id";

                DAO::update($sql, ['role' => $role, 'id' => $id], false);
           
        }

        // Ajouter un avatar
        public function avatarAdder($id, $avatar)
        {
            $sql = "UPDATE user
            SET avatar = :avatar
            WHERE id_user = :id";

                DAO::update($sql, ['avatar' => $avatar, 'id' => $id], false);
           
        }

    }