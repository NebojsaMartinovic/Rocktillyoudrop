<?php

class Controller{
    public function model($model){
        require_once 'models/'.$model.'.php';
        return new $model();
    }

    public function view($view,$data = []){
        if(file_exists('views/'.$view.'.php')){
            require_once 'views/'.$view.'.php';
        }else{
            die('View does not exist');
        }
    }
}
