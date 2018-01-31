<?php

class Posts extends Controller{
    public function __construct(){
        if(!isLoggedIn()){
            redirect('users/login');
        }
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }

    public function index(){
        $posts = $this->postModel->getPosts();

        $data = array(
            'posts' => $posts
        );
        $this->view('posts/index',$data);
    }

    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            if(isset($_FILES['img'])){
              $file_name = $_FILES['img']['name'];
              $file_size =$_FILES['img']['size'];
              $file_tmp =$_FILES['img']['tmp_name'];
              $file_type=$_FILES['img']['type'];
              move_uploaded_file($file_tmp,"img/".$file_name);

        }


            $data = array(
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'img' => $file_name,
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => '',
                'img_err' => ''

            );

            if(empty($data['title'])){
                $data['title_err'] = 'Please enter title';
            }

            if(empty($data['body'])){
                $data['body_err'] = 'Please enter body';
            }

            if(empty($data['img'])){
                $data['img_err'] = "Please upload image";
            }

            if(empty($data['title_err']) && empty($data['body_err']) && empty($data['img_err'])){
                $this->postModel->addPost($data);
                flash('post_message','Post Added');
                redirect('posts');
            }else{
                $this->view('posts/add',$data);
            }

        }else{
            $data = array(
                'title' => '',
                'body' => '',
                'img' => '',
                'title_err' => '',
                'body_err' => '',
                'img_err' => ''

            );

            $this->view('posts/add',$data);
        }
    }

    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            if(isset($_FILES['img'])){
              $file_name = $_FILES['img']['name'];
              $file_size =$_FILES['img']['size'];
              $file_tmp =$_FILES['img']['tmp_name'];
              $file_type=$_FILES['img']['type'];
              move_uploaded_file($file_tmp,"img/".$file_name);
            }
            $data = array(
                'id' => $id,
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'img' => $file_name,
                'title_err' => '',
                'body_err' => ''
            );

            if(empty($data['title'])){
                $data['title_err'] = 'Please enter title';
            }
            if(empty($data['body'])){
                $data['body_err'] = 'Please enter body';
            }

            if($data['img'] == ''){
                $post = $this->postModel->getPostById($id);

                $data['img'] = $post->img;
            }

            if(empty($data['title_err']) && empty($data['body_err'])){
                $this->postModel->updatePost($data);
                    flash('post_message','Post Updated');
                    redirect('posts');
            }else{
                $this->view('posts/edit',$data);
            }

        }else{
            $post = $this->postModel->getPostById($id);


            //Check for owner
            if($post->user_id != $_SESSION['user_id']){
                redirect('posts');
            }

            $data = array(
            'id' => $id,
            'title' => $post->title,
            'body' => $post->body
            );

        $this->view('posts/edit',$data);
        }
    }

    public function show($id){

        $post = $this->postModel->getPostById($id);

        $user = $this->userModel->getUserById($post->user_id);

        $data = array(
            'post' => $post,
            'user' => $user
        );

        $this->view('posts/show',$data);
    }

    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $post = $this->postModel->getPostById($id);


            //Check for owner
            if($post->user_id != $_SESSION['user_id']){
                redirect('posts');
            }

            $this->postModel->deletePost($id);
                flash('post_message','Post Removed');
                redirect('posts');

        }else{
            redirect('posts');
        }
    }


}









