<?php 

require_once __DIR__.'/db.class.php';

class additionalCSS extends Db {
       
    //-----------------Insert Section-----------------//

    public function SetAdditionalCSS($theme, $css){
        $sql = "INSERT INTO additional_css (theme, additional_css) VALUES (?, ?);";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ss', $theme, $css);

        if($stmt->execute()){
            return 1;
        }
        else{
            return '0';
        }
    }


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


    //-----------------Update Section-----------------//

    public function UpdateAdditionalCSS($theme, $css){
        $sql = "UPDATE additional_css SET additional_css=? WHERE theme=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ss', $css, $theme);

        if($stmt->execute()){
            return 1;
        }
        else{
            return 0;
        }
    }


    //-----------------Delete Section-----------------//

    public function DeleteAdditionalCSS($theme){
        $sql = "DELETE FROM additional_css WHERE theme=?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $theme);

        if($stmt->execute()){
            return 1;
        }
        else{
            return 0;
        }
    }

}