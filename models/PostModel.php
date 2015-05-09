<?php

class PostModel extends BaseModel{

    public function getPost($id) {
        $results =  $this->findAll($this->dbTablePosts,'id', 1, "id=$id");
        $results=$results['data'];
        return $results[0];
    }

    public function getPostComments($id, $page=1) {
        return $this->findAll($this->dbTableComments, 'id DESC', 5, "Blogs_id=$id", $page);

    }

    public function getAllTags(){
        $res= $this->findAll($this->dbTableTags,'TagText',0);
        return $res['data'];
    }

    public function getPostTags($id) {
        $query="select t.TagText, t.id FROM $this->dbTablePosts as b " .
            "join $this->dbTablePostTags as tb on b.id=tb.Blogs_id " .
            "join $this->dbTableTags t on tb.Tags_id= t.id Where b.id=$id";

        $statement = self::$db->query($query);

        $results = $this->process_results( $statement );
        return $results;
    }

    public function addPostTag($addTag){
        $res=$this->findAll($this->dbTablePostTags, 'id', 1,"t.Blogs_id={$addTag['Blogs_id']} and t.Tags_id={$addTag['Tags_id']}");
        $res=$res['data'];
        if(count($res)>0){
            return 0;
        }
        return $this->insertToTable($this->dbTablePostTags, $addTag);
    }

    public function addPostComment($newComment) {

        return $this->insertToTable($this->dbTableComments, $newComment);
    }

    public function createTag($newTag){

        return $this->insertToTable($this->dbTableTags, $newTag);
    }

    public function addPost($post) {

        return $this->insertToTable($this->dbTablePosts, $post);
    }

    public function editPost($id, $newPost){
        return $this->updateTable($this->dbTablePosts, $id, $newPost);
    }

    public function delPost($postId){
        $this->delAllPostComment($postId);
        $this->delPostTags($postId);
        return $this->deleteFromTable($this->dbTablePosts, "id = $postId");
    }

    public function delTag($id){
        $this->deleteFromTable($this->dbTablePostTags, "Tags_Id= $id");
        return $this->deleteFromTable($this->dbTableTags, "id = $id");
    }

    public function delPostComment($postId, $commentId){
        return $this->deleteFromTable($this->dbTableComments, "id = $commentId AND Blogs_id= $postId");
    }

    public function delAllPostComment($postId){
        return $this->deleteFromTable($this->dbTableComments, "Blogs_id = $postId");
    }

    public function delPostTags($postId){
        return $this->deleteFromTable($this->dbTablePostTags, "Blogs_id = $postId");
    }

    public function delPostTag($postId, $tagId){
        return $this->deleteFromTable($this->dbTablePostTags, "Blogs_id = $postId and Tags_Id= $tagId");
    }

    public function incrementViews($id) {
        $statement = self::$db->query(
            "UPDATE  $this->dbTablePosts SET Visits = Visits+1 WHERE id=$id");
    }
} 