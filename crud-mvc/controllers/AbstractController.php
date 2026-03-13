<?php
    abstract class AbstractController{
        public function __construct()
        {
            
        }
        
        protected function render(string $route, array $data):void
        {
            require "templates/layout.phtml";
        }
        protected function redirect(string $route):void 
        {
            header("location: $route");
        }
    }