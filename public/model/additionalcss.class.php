<?php 

require_once __DIR__.'/db.class.php';

class additionalCSS extends Db {

    //-----------------Select Section-----------------//
    
    public function GetAdditionalCSS($theme){
        $sql = "SELECT * FROM additional_css WHERE theme='$theme';";
        
        if($result = $this->conn->query($sql)){
            if($result->num_rows < 1){
                return '';
            }
            else{
                return $result;
            }
        }
        else{
            return '0';
        }
    }

}