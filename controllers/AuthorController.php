<?php
/**
 * Created by PhpStorm.
 * User: kalin
 * Date: 5/1/15
 * Time: 11:56 AM
 */

class AuthorController extends BaseController{

    public $model;
    public $author;
    public $idAuthor;
    public function onInit(){
        $this->model = new AuthorModel();
        $this->author=$this->model->getAuthor();

        $this->idAuthor=$this->author['id'];
    }

    public function edit(){
        $this->isAuthorize();
        if( isset($_POST['firstName'])&&
            isset($_POST['lastName'])&&
            isset($_POST['authorInfo'])&&
            isset($_POST['email'])){

            $this->author = array(
                'FirstName' =>$_POST['firstName'],
                'LastName' =>$_POST['lastName'],
                'Info' =>$_POST['authorInfo'],
                'Email' =>$_POST['email'],
            );

            $res = $this->model->editAuthor($this->idAuthor ,$this->author);
            if(count($res)>0){
                $this->addInfoMessage("Edit success.");
            } else {
                $this->addErrorMessage("Error Edit author." );
            }

        }
    }
} 