<?php
/**
 * Created by PhpStorm.
 * User: kalin
 * Date: 5/6/15
 * Time: 4:55 PM
 */

class AccountController extends BaseController{
    public $model;
    public function onInit(){
        $this->model = new AccountModel();
        $this->renderView('account');
    }

    public function logIn(){

        if(isset($_POST['UserName']) && isset($_POST['pass']))
        {
            $user=$_POST['UserName'];
            $pass=$_POST['pass'];
            $res=$this->model->logIn($user, $pass);
            if(count($res)>0){
                $this->addInfoMessage("Success");
                $_SESSION['username']=$res[0]['UserName'];
            }
            else{
                $this->addErrorMessage("Invalid Login." );
            }
            $this->redirectToUrl('/');
        }
    }

    public function logOut(){
        $this->isAuthorize();
        unset($_SESSION['username']);
        $this->addInfoMessage("Bay");
        $this->redirectToUrl('/');
    }
} 