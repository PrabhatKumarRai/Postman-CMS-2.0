<?php 

session_start();

include_once __DIR__.'/../model/additionalcss.class.php';


//Additional CSS
if(isset($_POST['submit'])){

    $theme = htmlentities($_POST['theme']);
    $css = "<pre>".htmlentities($_POST['additionalCSS'])."</pre>";       //Here <pre> tag is added to retain the text formatting of the additional css
    
    if(empty($theme)){

        $_SESSION["css"] = $css;
        $_SESSION["msg"] = "Empty Fields!!!";
        $_SESSION["class"] = "danger";

        header("Location: ".$_SERVER['HTTP_REFERER']);
        exit;

    }
    
    $additionalCSS = new additionalCSS();
    $result = $additionalCSS->GetAdditionalCSS($theme);
    
    //Insert
    if($result == ''){
        $result = $additionalCSS->SetAdditionalCSS($theme, $css);
        
        if($result !== 1){
            $_SESSION["css"] = $css;
            $_SESSION["msg"] = "SQL Error Occured!!!";
            $_SESSION["class"] = "danger";
    
            header("Location: ".$_SERVER['HTTP_REFERER']);
            exit;
        }

        $_SESSION["msg"] = "Saved Successfully!!!";
        $_SESSION["class"] = "success";

        header("Location: ".$_SERVER['HTTP_REFERER']);
        exit;
    }

    //Update
    elseif ($result !== '0'){
        $result = $additionalCSS->UpdateAdditionalCSS($theme, $css);
        
        if($result !== 1){
            $_SESSION["css"] = $css;
            $_SESSION["msg"] = "SQL Error Occured!!!";
            $_SESSION["class"] = "danger";
    
            header("Location: ".$_SERVER['HTTP_REFERER']);
            exit;
        }

        $_SESSION["msg"] = "Saved Successfully!!!";
        $_SESSION["class"] = "success";

        header("Location: ".$_SERVER['HTTP_REFERER']);
        exit;
    }
    

}


else{
    header("Location: ../view");
    exit;
}