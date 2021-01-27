<?php

    include_once __DIR__.'/../includes/header.php';

    include_once __DIR__.'/alert.php';

    include_once __DIR__.'/../model/website_setting.class.php';

    include_once __DIR__.'/../model/additionalcss.class.php';

    $themeId = new Website_setting();
    $result = $themeId->GetWebsiteSetting();
    if($result !== '' && $result !== '0'){
        $row = $result->fetch_assoc();
    }

    $additionalCSS = new additionalCSS();
    $result2 = $additionalCSS->GetAdditionalCSS($row['theme']);
    
?>

<div>
    <form action="../controller/additionalcss.inc.php" method="POST">

        <input type="hidden" name="theme" value="<?= $row['theme']; ?>">

        <div class="form-group">
            <label for="additionalCSS">Additional CSS: </label>
            <textarea class="form-control" id="additionalCSS" rows="20" name="additionalCSS"><?php 
                
                $replace = array("<pre>", "</pre>");

                if(isset($_SESSION['css'])){
                    echo str_replace($replace, '', $_SESSION['css']);
                }
                else{
                    if($result2 !== '' && $result2 !== '0'){
                        $row2 = $result2->fetch_assoc();
                        echo str_replace($replace, '', $row2['additional_css']);
                    }
                    else{
                        echo '/*'." Write your additional CSS code below ".'*/';
                    }                    
                }

            ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary px-5 py-1" name="submit">Save</button>
        
    </form>
</div>

<?php include __DIR__.'/../includes/footer.php'; ?>