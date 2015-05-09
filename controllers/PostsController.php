<?php

class PostsController extends BaseController{

    private $model;
    public function onInit(){
        $this->model = new PostModel();
    }

    private function initPostData($idP, $commentPage=1){
        $id=$idP;
        $this->post = $this->model->getPost($id);

        $comments = $this->model->getPostComments($id,$commentPage);
        $this->comments =$comments["data"];
        $this->page=$commentPage;
        $this->allPages=$comments['pageCount'];
        $this->viewAction="view";

        $this->tags = $this->model->getPostTags($id);
        $this->allTags = $this->model->getAllTags();
    }
    public function index(){
        header("Location: /");
        die();
    }

    public function view($id, $commentPage=1){
        $this->initPostData($id, $commentPage);
        $to_increment=true;
        $visitsPost=array();
        if(isset($_SESSION['visitPosts'])){
            $visitsPost=$_SESSION['visitPosts'];
            $to_increment=!in_array($id,$visitsPost);
        }
        else
        {
            $_SESSION['visitPosts']=array();
        }
        if($to_increment){
            $this->model->incrementViews($id);
            array_push($visitsPost,$id);
            $_SESSION['visitPosts']=$visitsPost;
        }

    }

    public function add(){
        $this->isAuthorize();
        $this->postAction ='add';
        $this->post = array('id'=>0, 'Title'=>'', 'Text'=>'');
        if (isset($_POST['title'])&& isset($_POST['text'])){
            $newPost = array(
                'Title' => $_POST['title'],
                'Text' => $_POST['text'],
                'Visits' => 0,
                'Blogers_id' => 1
            );

            $res = $this->model->addPost($newPost);
            if($res>0){
                $this->addInfoMessage("The new Post Added successfully");
            } else {
                $this->addErrorMessage("Error add new post." );
            }
        }
    }

    public function editPost($id){
        $this->isAuthorize();
        $this->initPostData($id);
        $this->postAction ='postEdit';
        $this->renderView('add');
    }

    public function postEdit(){
        $this->isAuthorize();
        if (isset($_POST['title'])&& isset($_POST['text']) && isset($_POST['id'])){
            $newPost = array(
                'Title' => $_POST['title'],
                'Text' => $_POST['text'],
            );

            $res = $this->model->editPost($_POST['id'], $newPost);

            if($res>0){
                $this->addInfoMessage("post edited");
            } else {
                $this->addErrorMessage("Error edit post." );
            }
        }
        $this->redirectToUrl("/posts/view/" . $_POST['id']);
    }

    public function addComment($id){
        if (isset($_POST['name'])&& isset($_POST['comment'])&& isset($_POST['email'])){

            $newComment = array(
                'Username' => $_POST['name'],
                'Comment' => $_POST['comment'],
                'Email' => $_POST['email'],
                'Blogs_id' => $id
            );

            $res = $this->model->addPostComment($newComment);
            if($res){
                $this->addInfoMessage("comment added");
            } else {
                $this->addErrorMessage("Error add new comment." );
            }
            $this->redirectToUrl("/posts/view/" . $id);
        }
    }

    public function addTag($id){
        $this->isAuthorize();
        if (isset($id)&& isset($_POST['selectTag'])){
            $newPostTag=array('Blogs_id'=>$id, 'Tags_id'=>$_POST['selectTag']);

            $res = $this->model->addPostTag($newPostTag);
            if($res>0){
                $this->addInfoMessage("Tag added to post");
            } else {
                $this->addErrorMessage("Error add new Tag." );
            }
            $this->redirectToUrl("/posts/view/" . $id);

        }
    }

    public function createTag($id){
        $this->isAuthorize();
        if (isset($_POST['TagText'])){
            $newTag=array('TagText'=>$_POST['TagText']);

            $res = $this->model->createTag($newTag);
            if($res>0){
                $this->addInfoMessage("Tag Created");
            } else {
                $this->addErrorMessage("Error add new tag." );
            }
            $this->redirectToUrl("/posts/view/" . $id);
        }
    }

    public function delPostComment($postId, $commentId){
        $this->isAuthorize();
        $res = $this->model->delPostComment($postId, $commentId);
        if($res>0){
            $this->addInfoMessage("Comment Deleted");
        } else {
            $this->addErrorMessage("Error delete comment." );
        }
        $this->redirectToUrl("/posts/view/" . $postId);
    }

    public function delPost($postId){
        $this->isAuthorize();
        $this->model->delPost($postId);
        $this->redirectToUrl("/");
    }

    public function delTag($id){
        $this->isAuthorize();
        if($_POST['selectTag']){
            $this->model->delTag($_POST['selectTag']);
            $this->redirectToUrl("/posts/view/" . $id);
        }
    }

    public function delPostTag($tagId,$postId) {
        $this->isAuthorize();
        $this->model->delPostTag($postId, $tagId);
        $this->redirectToUrl("/posts/view/" . $postId);
    }
} 