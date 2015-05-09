<?php

class HomeController extends BaseController{

    public $model;
    public $blogs;
    public $allTags;
    public $popTag;
    public $viewAction='postPage';
    public $page= 1;
    public function onInit(){
        $this->model = new HomeModel();
        $blogs = $this->model->getAll();
        $this->blogs=$blogs['data'];
        $this->allPages=$blogs['pageCount'];

        $tags=$this->model->getAllTags();
        $this->allTags = $tags['data'];

        $this->popTag=$this->model->getPopTags();
        $this->viewAction="postPage";
        $this->page = 1;
    }


    public function postPage($page){
        $this->page = $page;
        $blogs = $this->model->getAll($page);
        $this->blogs=$blogs['data'];
        $this->allPages=$blogs['pageCount'];

        $this->viewAction='postPage';
        $this->renderView('index');

    }

    public function newPosts($page=1){
        $blogs = $this->model->getNew($page);
        $this->blogs=$blogs['data'];
        $this->allPages=$blogs['pageCount'];
        $this->page = $page;
        $this->viewAction='newPosts';
        $this->renderView('index');
    }

    public function popular($page=1){
        $blogs = $this->model->getPopPost($page);
        $this->blogs=$blogs['data'];
        $this->allPages=$blogs['pageCount'];
        $this->page = $page;
        $this->viewAction='popular';
        $this->renderView('index');
    }

    public function postByTags($tag_text, $page=1){
        $blogs = $this->model->getPostByTagName($tag_text, $page);
        $this->blogs=$blogs['data'];
        $this->allPages=$blogs['pageCount'];
        $this->page = $page;
        $this->viewAction='postByTags' . "/" . $tag_text;
        $this->renderView('index');
    }

    public function postByTagsName($page=1){
        if(isset($_POST['selectTag'])){
            $this->postByTags($_POST['selectTag'], $page);
        }
    }
} 