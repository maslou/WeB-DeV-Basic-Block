<?php
class AuthorModel extends BaseModel{


    public function getAuthor() {
        $res= $this->findAll($this->dbTableUsers,'id', 0);
        $res=$res['data'];
        return $res[0];
    }

    public function editAuthor($id, $authorData){
        return $this->updateTable($this->dbTableUsers, $id, $authorData);
    }
}