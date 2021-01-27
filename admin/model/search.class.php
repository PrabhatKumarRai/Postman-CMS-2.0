<?php 

require_once __DIR__.'/db.class.php';


class Search extends Db {


    //Search Post Method Section
    public function SearchPost($search){
        $sql = "SELECT * FROM posts WHERE post_date LIKE '%$search%' OR post_author LIKE '%$search%' OR post_title LIKE '%$search%'  OR post_content LIKE '%$search%' ORDER BY post_id DESC;";
        if($result = $this->conn->query($sql)){
            if($result->num_rows < 1){
                return '';        //No Records Found
            }
            else{
                return $result;       //Success
            }
        }
        else{
            return '0';       //SQL ERROR
        }
    }


    //Search Enquiry Method Section
    public function SearchEnquiry($search){
        $sql = "SELECT * FROM enquiry WHERE date LIKE '%$search%' OR enquiry LIKE '%$search%' OR reply LIKE '%$search%' OR name LIKE '%$search%' OR email LIKE '%$search%' OR subject LIKE '%$search%' OR reply_date LIKE '%$search%' ORDER BY id DESC;";
        if($result = $this->conn->query($sql)){
            if($result->num_rows < 1){
                return '';        //No Records Found
            }
            else{
                return $result;       //Success
            }
        }
        else{
            return '0';       //SQL ERROR
        }
    }


}