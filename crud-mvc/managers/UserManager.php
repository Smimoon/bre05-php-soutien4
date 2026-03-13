<?php
    class UserManager extends AbstractManager{
        public function __construct()
        {
            Parent::__construct();
        }

        public function create(User $user):void
        {
            $query = $this->db->prepare(
                'INSERT INTO users (email, first_name, last_name) VALUES (:email, :first_name, :last_name)'
            );
            
            $parameters = [
                'email' => $user->getEmail(),
                'first_name' => $user->getFirstName(),
                'last_name' => $user->getLastName()
            ];
            
            $query->execute($parameters);
            $id = $this->db->lastInsertId();
            $user->setId($id);
        }
        
        public function update(User $user):void
        {
             $query = $this->db->prepare(
                'UPDATE users 
                SET email = :email, first_name = :first_name, last_name = :last_name
                WHERE id = :id'
            );
            
            $parameters = [
                
                'email' => $user->getEmail(),
                'first_name' => $user->getFirstName(),
                'last_name' => $user->getLastName(),
                'id' => $user->getId()
            ];
            
            $query->execute($parameters);
        }
        
        public function delete(int $id):void
        {
            $query = $this->db->prepare(
                'DELETE FROM users WHERE id = :id'
            );
            $parameters = [
                'id'=> $id
            ];
            $query->execute($parameters);
        }
        
        public function findOne(int $id):User
        {
            $query = $this->db->prepare(
                'SELECT * FROM users WHERE id = :id'
            );
            
            $parameters = [
                'id' => $id
            ];
            
            $query->execute($parameters);
            
            $result=$query->fetch(PDO::FETCH_ASSOC);
            
            if($result){
                $user = new User($result["email"], $result["first_name"], $result["last_name"]);
                $user->setId($id);
                return $user;
            }
            else{
                return NULL;
            }
        }
        
        public function findAll():array
        {
            $query = $this->db->prepare(
                'SELECT * FROM users'
            );
            
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_ASSOC);
            $users = [];
            if($results !== false){
                foreach($results as $result){
                    $user= new User($result["email"], $result["first_name"], $result["last_name"]);
                    $user->setId($result["id"]);
                    $users[]=$user;
                    }
            return $users;
            }
            else{
                return NULL;
            }
        }
    }
?>