<?php

if((!isset($_POST['submit']) && !isset($_POST['searchType'])) || empty($_POST['searchType'])){
    header("Location: index.php");
    exit;
}

include_once __DIR__.'/../includes/header.php';   
    
include_once __DIR__.'/../model/search.class.php';
include_once __DIR__.'/alert.php';


$searchType = htmlentities($_POST['searchType']);

$searchText = htmlentities($_POST['search']);

if($searchType != 'post' && $searchType != 'enquiry'){

    $_SESSION["msg"] = "Search type not defined!!!";
    $_SESSION["class"] = "danger";

    header("Location: ../view/searchpage.php");
    exit;

}

$search = new Search();

?>

    <!-- Search Data Type (Post or Enquiry) -->
    <div class="mb-3">
        <form action="searchpage.php" method="POST" class="d-flex flex-wrap" id="searchTypeForm">
            <input type="hidden" name="search" value="<?= (isset($_POST['search']))? $_POST['search']: ''; ?>">
            <div class="form-check mr-3">
                <input class="form-check-input" type="radio" name="searchType" class="searchType" id="searchType1" value="post" onclick="this.form.submit()" <?= ($_POST['searchType'] == 'post')? 'checked': ''; ?>>
                <label class="form-check-label" for="searchType1">
                    Posts
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="searchType" class="searchType" id="searchType2" value="enquiry" onclick="this.form.submit()" <?= ($_POST['searchType'] == 'enquiry')? 'checked': ''; ?>>
                <label class="form-check-label" for="searchType2">
                    Enquiry
                </label>
            </div>
        </form>
    </div>

<?php
    

switch($searchType){

    //Search Posts
    case 'post': 
        $result = $search->SearchPost($searchText);
        
        if($result == ''){
            ?>
                    <!-- No Records Found -->
                    <div class="search-links-container w-100">
                        <div class="search-links-inner text-center py-3">
                            <h4>No record matches your Search!!!</h4>
                        </div>
                    </div>
            <?php
                }
                elseif($result == '0'){
            ?>
                    <div class="search-links-container">
                        <div class="search-links-inner text-center py-3">
                            <h4>SQL Error Occured!!!</h4>
                        </div>
                    </div>
            <?php
                }
                else{
                    
                    while($row = $result->fetch_assoc()){
                    
            ?>
                    <div class="search-links-container">
                        <div class="search-links-inner">
                            <!-- Post Title -->
                            <div class="search-links-title limit-1">
                                <a href="<?= ROOT_URL_ADMIN ?>view/postdetail.php?id=<?= $row['post_id']; ?>"><?= $row['post_title']; ?></a>
                            </div>
                            <!-- Post Publish Details -->
                            <div class='search-links-publish text-secondary limit-2'>
                                Published by 
                                <span class="text-dark underline"><?= $row['post_author']; ?></span> 
                                on 
                                <span class="text-dark underline"><?= date('d M,Y h:i:s a', strtotime($row['post_date'])); ?></span>
                                <?php
                                    if(strcmp($row['post_date'], $row['post_updated']) != 0){
                                ?>
                                Last Updated : <span class="text-dark underline"><?= date('d M,Y h:i:s a', strtotime($row['post_updated'])); ?></span>
                                <?php
                                    }
                                ?>
                            </div>
                            <!-- Post Contents -->
                            <div class="search-links-content limit-2">
                                <?= $row['post_content']; ?>
                            </div>
                        </div>
                    </div>
            <?php
                    }
                }
                break;
                
    
    //Search Enquiry
    case 'enquiry': 
        $result = $search->SearchEnquiry($searchText);
        
        if($result == ''){
            ?>
                    <!-- No Records Found -->
                    <div class="search-links-container w-100">
                        <div class="search-links-inner text-center py-3">
                            <h4>No record matches your Search!!!</h4>
                        </div>
                    </div>
            <?php
                }
                elseif($result == '0'){
            ?>
                    <div class="search-links-container">
                        <div class="search-links-inner text-center py-3">
                            <h4>SQL Error Occured!!!</h4>
                        </div>
                    </div>
            <?php
                }
                else{
                    
                    while($row = $result->fetch_assoc()){
                    
            ?>
                    <div class="search-links-container">
                        <div class="search-links-inner">
                            <!-- Title -->
                            <div class="search-links-title limit-1">
                                <a href="<?= ROOT_URL_ADMIN ?>view/enquiry.php#<?= $row['id'] ?>"><?= $row['subject']; ?></a>
                            </div>
                            <!-- Publish Details -->
                            <div class='search-links-publish text-secondary limit-2'>
                                Published by 
                                <span class="text-dark underline"><?= $row['name']; ?></span> 
                                on 
                                <span class="text-dark underline"><?= date('d M,Y h:i:s a', strtotime($row['date'])); ?></span>
                                <?php
                                    if(!empty($row['reply_date'])){
                                ?>
                                Replied On : <span class="text-dark underline"><?= date('d M,Y h:i:s a', strtotime($row['reply_date'])); ?></span>
                                <?php
                                    }
                                ?>
                            </div>
                            <!-- Post Contents -->
                            <div class="search-links-content limit-2">
                                <?= $row['enquiry']; ?>
                            </div>
                        </div>
                    </div>
            <?php
                    }
                }
                break;
            
    default:
    ?>
        <div class="search-links-container w-100">
            <div class="search-links-inner text-center py-3">
                <h4>No record matches your Search!!!</h4>
            </div>
        </div>

    <?php
}


?>
                    

<?php include_once __DIR__.'/../includes/footer.php';?>