<?php
/**
 * Created by PhpStorm.
 * User: kalin
 * Date: 5/2/15
 * Time: 12:17 PM
 */

class HomeModel extends BaseModel{


    public function getAll($page=1) {
        return $this->findAll($this->dbTablePosts, 'id', PAGE_SIZE,"", $page);
    }

    public function getPopPost($page=1){
        return $this->findAll($this->dbTablePosts,'Visits DESC', PAGE_SIZE,"", $page);
    }
    public function getNew($page) {
        return $this->findAll($this->dbTablePosts,'date DESC', PAGE_SIZE,"", $page);
    }

    public function getAllTags(){
        return $this->findAll($this->dbTableTags,'TagText',0);
    }

    public function getPostByTagName($name, $page=1) {
        $named=urldecode ($name);
        $limit = PAGE_SIZE;
        $offset=$limit * ($page -1);
        $query="select SQL_CALC_FOUND_ROWS b.* FROM $this->dbTablePosts as b " .
            "join $this->dbTablePostTags as tb on b.id=tb.Blogs_id " .
            "join $this->dbTableTags t on tb.Tags_id= t.id Where t.TagText='$named'".
            "  Limit $offset, $limit";
        $statement = self::$db->query($query);

        $results['data'] = $this->process_results( $statement );
        $countRes=self::$db->query("SELECT FOUND_ROWS()");
        $pageCount = $this->process_results($countRes);
        $pageCount=$pageCount[0];
        $pageCount=$pageCount['FOUND_ROWS()'];
        $allPage=round(intval($pageCount) / $limit);
        if((intval($pageCount) % $limit)>0){
            $allPage+=1;
        }
        if($allPage<1){
            $allPage=1;
        }
        $results["pageCount"]=$allPage;
        return $results;
    }

    public function getPopTags(){
        $query="select DISTINCT(t.TagText) FROM $this->dbTablePosts as b " .
            "join $this->dbTablePostTags as tb on b.id=tb.Blogs_id " .
            "join $this->dbTableTags t on tb.Tags_id= t.id ORDER BY b.Visits DESC Limit 10";
        $statement = self::$db->query($query);

        $results = $this->process_results( $statement );
        return $results;
    }


} 