<?php
    class Router{
        private UserController $uc;
        
        public function __construct()
        {
            $this->uc = new UserController();
        }
        
        public function handleRequest(array $get):void
        {
            if(isset($get["route"])){
                if($get["route"] === "show_user" && isset($get["user_id"])){
                    $this->uc->show($get["user_id"]);
                    
                }
                else if($get["route"] === "create_user"){
                    $this->uc->create();
                    
                }
                else if($get["route"] === "check_create_user"){
                    $this->uc->checkCreate();
                    // aucun template
                }
                else if($get["route"] === "update_user" && isset($get["user_id"])){
                    $this->uc->update($get["user_id"]);
                    
                }
                else if($get["route"] === "check_update_user" && isset($get["user_id"])){
                    $this->uc->checkUpdate($get["user_id"]);
                    // aucun template
                }
                else if($get["route"] === "delete_user" && isset($get["user_id"])){
                    $this->uc->delete($get["user_id"]);
                    // aucun template
                }
                else{
                    $this->uc->list();
                    
            }
            }
            else{
                $this->uc->list();
            }
        }
    }