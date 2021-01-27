<?php
session_start();

include_once __DIR__.'/../model/website_setting.class.php';
include_once __DIR__.'/../model/additionalcss.class.php';

//Update Website Theme
if(isset($_POST['activateTheme'])){
    $theme = $_POST['theme'];

    if(empty($theme)){
        $_SESSION['msg'] = "Theme Does Not Exists";
        $_SESSION['class'] = "danger";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    $websitetheme = new Website_setting();
    $result = $websitetheme->UpdateTheme($theme);
    
    if($result == 0){
        $_SESSION['msg'] = "SQL Error Occured!!!";
        $_SESSION['class'] = "danger";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
    else{
        $_SESSION['msg'] = "Website Theme Updated Successfully";
        $_SESSION['class'] = "success";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
}

//Update Website Theme Color
if(isset($_GET['themeColor'])){
    $themeColor = htmlentities($_GET['themeColor']);
    echo $themeColor;
    if(empty($themeColor)){
        $_SESSION['msg'] = "Theme Color Does Not Exists";
        $_SESSION['class'] = "danger";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    $websiteThemeColor = new Website_setting();    

    switch($themeColor){
        case 1: $result = $websiteThemeColor->UpdateThemeColor("dark", "#111"); break;
        case 2: $result = $websiteThemeColor->UpdateThemeColor("cyan", "#396c77"); break;
        case 3: $result = $websiteThemeColor->UpdateThemeColor("grey", "#777777"); break;
        case 4: $result = $websiteThemeColor->UpdateThemeColor("red", "#a73d3d"); break;
        case 5: $result = $websiteThemeColor->UpdateThemeColor("green", "#2f7950"); break;
        default: $result = $websiteThemeColor->UpdateThemeColor("dark", "#27292b");
    }
    
    if($result == 0){
        $_SESSION['msg'] = "SQL Error Occured!!!";
        $_SESSION['class'] = "danger";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
    else{
        $_SESSION['msg'] = "Website Theme Color Updated Successfully";
        $_SESSION['class'] = "success";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
}

//Delete Theme
if(isset($_POST['deleteTheme'])){
    $themeName = $_POST['theme'];
    $path = __DIR__."/../../public/view/$themeName";

    // delete all files and sub-folders from a folder
    function deleteAll($dir) {
        foreach(glob($dir . '/*') as $file) {
            if(is_dir($file))
                deleteAll($file);
            else
                unlink($file);
        }
        if(!rmdir($dir)){
            return 1;
        }
        else{
            return 0;
        }
    }

    $result = deleteAll($path);

    //Deleting Additional CSS attached with the theme
    $deleteAdditionalCSS = new additionalCSS();
    $result2 = $deleteAdditionalCSS->DeleteAdditionalCSS($themeName);

    if($result !== 0 && $result2 !== 0){
        $_SESSION['msg'] = "Error deleting the Theme";
        $_SESSION['class'] = "danger";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
    else{
        $_SESSION['msg'] = "Theme deleted";
        $_SESSION['class'] = "success";
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }

}


else{
    header("Location: ../view");
    exit;
}