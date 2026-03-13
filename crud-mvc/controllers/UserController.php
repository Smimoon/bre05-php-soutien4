<?php
    
    class UserController extends AbstractController {
        private UserManager $um;
        public function __construct()
        {
            $this->um = new UserManager();
        }
        
        public function show(int $id):void
        {
            $route = "users/show.phtml";
            $user = $this->um->findOne($id);
            $this->render($route, ["user" => $user]);
        }
        public function create():void
        {
            $route = "users/create.phtml";
            $this->render($route, []);
        }
        public function checkCreate():void
        {
            if(isset($_POST["email"], $_POST["firstName"], $_POST["lastName"])){
                
                $regexEmail = "/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/";
                // regex qui permet de vérifier la validité de l'adresse email (contient @ et un . suivi d'au moins 2 caractères).
                
                $email = htmlspecialchars($_POST["email"]);
                $firstName = htmlspecialchars($_POST["firstName"]);
                $lastName = htmlspecialchars($_POST["lastName"]);
                
                if (preg_match($regexEmail, $email)&& !empty($email) && !empty(trim($firstName)) && !empty(trim($lastName))) {
                    // preg_match pour vérifier la correspondance de $email avec la regex !empty pour vérifier que le champ n'est pas vide, trim pour supprrimer les espaces.
                    $newUser = new User($email, $firstName, $lastName);
                    
                    $this->um->create($newUser);
                    $this->redirect("index.php");
                }
            }
            else{
                // TODO : gestion d'erreur
            }
            
        }
        public function update(int $id):void
        {
            $user = $this->um->findOne($id);
            
            $route = "users/update.phtml";
            $this->render($route, ["user" => $user]);
        }
        public function checkUpdate(int $id):void
        {
            if(isset($_POST["email"], $_POST["firstName"], $_POST["lastName"])){
                
                $regexEmail = "/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/";
                // regex qui permet de vérifier la validité de l'adresse email (contient @ et un . suivi d'au moins 2 caractères).
                
                $email = htmlspecialchars($_POST["email"]);
                $firstName = htmlspecialchars($_POST["firstName"]);
                $lastName = htmlspecialchars($_POST["lastName"]);
                
                if (preg_match($regexEmail, $email)&& !empty($email) && !empty(trim($firstName)) && !empty(trim($lastName))) {
                    // preg_match pour vérifier la correspondance de $email avec la regex !empty pour vérifier que le champ n'est pas vide, trim pour supprrimer les espaces.
                    $user = new User($email, $firstName, $lastName);
                    $user->setId($id);
                    $this->um->update($user);
                    $this->redirect("index.php");
                    
                }
                else {
                    // TODO : gestion d'erreur
                    $this->redirect("index.php?route=update_user");
                }
            }
            else {
                // TODO : gestion d'erreur
                $this->redirect("index.php?route=update_user");
            }
        }
        
        public function delete(int $id):void
        {
            $this->um->delete($id);
            $this->redirect("index.php");
        }
        public function list():void
        {
            $route = "users/list.phtml";
            $data= $this->um->findAll();
            $this->render($route, $data);
        }
    }
?>