<?php
    include_once __DIR__.'/../../../../config/config.php';
    include_once __DIR__.'/../../../model/users.class.php';
    include_once __DIR__.'/../../../model/website_setting.class.php';
    include_once __DIR__.'/../../../model/additionalcss.class.php';


    $navdata = new Users();
    $result = $navdata->ReadSingleUser('u_id', 1);
    if($result != '' && $result != '0'){
        $row = $result->fetch_assoc();
    }
   

    $theme = new Website_setting();
    $result2 = $theme->GetWebsiteSetting();
    $row2 = $result2->fetch_assoc(); 

    $additionalCSS = new additionalCSS();
    $result3 = $additionalCSS->GetAdditionalCSS($row2['theme']);

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $row['u_name']; ?></title>
    <link rel="icon" href="../../../uploads/app/logo.png" type="image/gif" sizes="16x16">

    <!-- Dependencies Section Starts -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="../../../admin/includes/bootstrap/css/bootstrap.min.css">
    <script src="../../../admin/includes/js/jquery.min.js"></script>
    <script src="../../../admin/includes/bootstrap/js/bootstrap.min.js"></script>
    <!-- Dependencies Section Ends -->

    <!-- Custom CSS Starts -->
    <link rel="stylesheet" href="includes/css/layout.css">
    <link rel="stylesheet" href="includes/css/common.css">
    <link rel="stylesheet" href="includes/css/alert.css">
    <link rel="stylesheet" href="includes/css/post.css">
    <link rel="stylesheet" href="includes/css/navigation.css">
    <link rel="stylesheet" href="includes/css/searchpage.css">
    <link rel="stylesheet" href="includes/css/pages.css">
    <link rel="stylesheet" href="includes/css/about.css">
    <link rel="stylesheet" href="includes/css/gallery.css">
    <link rel="stylesheet" href="includes/css/contact.css">
    <link rel="stylesheet" href="includes/css/index.css">
    <link rel="stylesheet" href="includes/css/theme.php">
    <!-- Custom CSS Ends -->

    <!-- Custom JS Starts -->
    <script src="includes/js/script.js"></script>
    <!-- Custom JS Ends -->

    <!-- Additional CSS Section Starts -->
    <style>
        <?php 
            if($result3 !== '' && $result3 !== '0'){
                $row3 = $result3->fetch_assoc();

                $find = array("<pre>", "</pre>");
                echo str_replace($find, '', $row3['additional_css']);
            }
        ?>
    </style>
    <!-- Additional CSS Section Ends -->

</head>
<body>

<div class="content" id="content">
    <div class="content-inner">

    <?php include_once __DIR__.'/navbar.php'; ?>
