<?php


class AccountModel extends BaseModel{

    public function logIn($username, $password){
        $res= $this->findAll($this->dbTableUsers,"id", 1,"t.username='{$username}' And t.password={$password}");
        return $res['data'];

    }
} 