<?php

class Post extends ActiveRecord{
    public static $tableName = 'posts';
    public static $keyColumn = 'id';
    public $title;
    public $body;
    public $img;
    public $user_id;

    private $db;

    public function __construct(){
        $this->db = Connect::getInstance();
    }

    public function getPosts(){
        $sql = $this->db->query('SELECT *,
                          posts.id AS postId,
                          users.id AS userId,
                          posts.created_at AS postCreated,
                          users.created_at AS userCreated
                          FROM posts
                          INNER JOIN users
                          ON posts.user_id = users.id
                          ORDER BY posts.created_at
                          DESC
                          ');

        $results = $sql->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public function getPostById($id){
        $post = static::get($id);
        return $post;
    }

    public function addPost($data){
        $this->user_id = $data['user_id'];
        $this->title = $data['title'];
        $this->body = $data['body'];
        $this->img = $data['img'];

        $this->insert();
    }

    public function updatePost($data){
        $this->title = $data['title'];
        $this->body = $data['body'];
        $this->img = $data['img'];
        $post = static::update($data['id'], array('title' => $this->title,'body' => $this->body,'img' => $this->img));
        return $post;
    }

    public function deletePost($id){
        $this->remove($id);
    }


}








