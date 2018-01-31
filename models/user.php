<?php

class User extends ActiveRecord{
    public static $tableName = 'users';
    public static $keyColumn = 'id';
    public $name;
    public $email;
    public $password;


    public function register($data){
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->password = $data['password'];

        $this->insert();
    }

    public function findUserByEmail($userEmail){
       $users = static::getAll();
        foreach($users as $user){
            if($user->email == $userEmail){
                return true;
            }
        }

    }

    public function login($email,$password){
        $users = static::getAll();
        foreach($users as $user){
            if($user->email == $email){
                 $hashed_password = $user->password;
                if(password_verify($password,$hashed_password)){
                    return $user;
                }else{
                    return false;
                }
            }
        }
    }

    public function getUserById($id){
        $user = static::get($id);
        return $user;
    }
}









