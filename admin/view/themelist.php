<?php

include_once __DIR__.'/../includes/header.php';

include_once __DIR__.'/alert.php';

?>

<div class="theme-block-container">
    <div class="theme-block-inner">

        <?php
            //Getting All directories (theme folders) inside the public->view folder
            foreach(glob('../../public/view/*', GLOB_ONLYDIR) as $dir){
                $dirname = basename($dir);

                if(file_exists("../../public/view/$dirname/index.php")){

                    //Getting Preview Images of Themes
                    $dir_name = "../../public/view/$dirname/preview/";
                    $images = glob($dir_name."*.png");
                    $images += glob($dir_name."*.jpg");
                    $images += glob($dir_name."*.jpeg");
                    
                    $itemCount = 1;
        ?>

                    <div class="theme-block-item">
                        <div class="theme-block-item-top">
                            <!-- Carousel -->
                            <div id="carouselThemeItem<?= $dirname; ?>" class="carousel slide h-100" data-ride="carousel">
                                <div class="carousel-inner h-100">

                                    <?php 
                                            
                                        if(empty($images)){
                                            echo "<div class='h-100 d-flex justify-content-center align-items-center'>No image available</div>";
                                        }
                                        else{
                                         
                                            foreach($images as $image) {

                                                if($itemCount == 1){
                                    ?>
                                                    <div class="carousel-item h-100 active">
                                                        <img class="d-block w-100 h-100" src="<?= $image; ?>" alt="Theme Preview">
                                                    </div>
                                    <?php
                                                }
                                                else{
                                    ?>
                                                    <div class="carousel-item h-100">
                                                        <img class="d-block w-100 h-100" src="<?= $image; ?>" alt="Theme Preview">
                                                    </div>
                                    <?php

                                                }

                                                $itemCount++;
                                            }   
                                        }
                                    ?>
                                </div>
                                <a class="carousel-control-prev" href="#carouselThemeItem<?= $dirname; ?>" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselThemeItem<?= $dirname; ?>" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>

                        <div class="theme-block-item-center">
                            <span class="text-capitalize limit-1">
                                <!-- Theme Name -->
                                <?= $dirname; ?>
                            </span>
                        </div>

                        <form action="../controller/website_setting.inc.php" method="POST">
                            <div class="theme-block-item-bottom">
                                <!-- Buttons -->
                                    <input type="hidden" name="theme" value="<?= $dirname; ?>">
                                    <button type="submit" class="bg-primary" name="activateTheme">Activate</button>
                                    <button type="submit" class="bg-danger" name="deleteTheme">Delete</button>
                            </div>
                        </form>
                    </div>

        <?php     
                }
            }
        ?>

    </div>
</div>

<?php include __DIR__.'/../includes/footer.php'; ?>