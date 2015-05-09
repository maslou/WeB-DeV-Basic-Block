<?php
abstract class BaseModel {
    protected static $db;
    protected $dbTableUsers = 'blogers';
    protected  $dbTablePosts = 'blogs';
    protected  $dbTableComments ='blogcomments';
    protected  $dbTablePostTags ='tags_has_blogs';
    protected  $dbTableTags ='tags';
    public function __construct() {

        if (self::$db == null) {

            self::$db = new mysqli(
                DB_HOST, DB_USER, DB_PASS, DB_NAME);
            self::$db->set_charset("utf8");

            if (self::$db->connect_errno) {
                die('Cannot connect to database');
            }
        }
    }

    protected function findAll($table, $order="id", $limit=PAGE_SIZE, $where="", $page=1){
        $offset=$limit * ($page -1);
        $query="SELECT SQL_CALC_FOUND_ROWS t.* FROM $table t ";

        if($where!=""){
            $query.= "WHERE {$where} ";
        }
        $query .= "ORDER BY t.{$order} ";
        if($limit!=0){
            $query .=" Limit $offset, $limit";
        }
        else{

            $limit=1;
        }

        $statement = self::$db->query($query);
        $results['data'] = $this->process_results( $statement );
        $countRes=self::$db->query("SELECT FOUND_ROWS()");
        $pageCount = $this->process_results($countRes);
        $pageCount=$pageCount[0];
        $pageCount=$pageCount['FOUND_ROWS()'];
        $allPage=ceil(intval($pageCount) / $limit);

        if($allPage<1){
            $allPage=1;
        }
        $results["pageCount"]=$allPage;
        return $results;
    }

    protected function insertToTable($table, $data){
        $keys = array_keys($data );
        $values = array();

        foreach($data as $key => $value ) {
            $values[] = "'" . $value  . "'";
        }

        $keys = implode( $keys, ',' );
        $values = implode( $values, ',' );

        $query = "insert into {$table}($keys) values($values)";
        self::$db->query( $query );

        return self::$db->affected_rows;
    }

    protected function process_results( $result_set ) {
        $results = array();
        if( ! empty( $result_set ) && $result_set->num_rows > 0) {
            while($row = $result_set->fetch_assoc()) {
                $results[] = $row;
            }
        }
        return $results;
    }

    protected function deleteFromTable($table, $where){
        $statement = self::$db->query(
            "DELETE FROM $table WHERE $where");

        return self::$db->affected_rows;
    }

    protected function updateTable($table, $id, $data){
        $query = "UPDATE " . $table . " SET ";

        foreach( $data as $key => $value ) {
            if( $key === 'id' ) continue;
            $query .= "$key = '" . $value  . "',";
        }
        $query = rtrim( $query, "," );
        $query .= " WHERE id = " . $id;

        self::$db->query( $query );

        return self::$db->affected_rows;
    }
}
