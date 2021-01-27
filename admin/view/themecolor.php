<?php

include_once __DIR__.'/../includes/header.php';

include_once __DIR__.'/alert.php';

?>

<div>
    <div class="themeColorContainer d-flex justify-content-start align-items-center flex-wrap">
        <a href="../controller/website_setting.inc.php?themeColor=1" class="admin-theme-1 btn btn-dark border-0 mb-3 mr-3">Dark</a>
        <a href="../controller/website_setting.inc.php?themeColor=2" class="admin-theme-2 btn btn-info border-0 mb-3 mr-3">Cyan</a>
        <a href="../controller/website_setting.inc.php?themeColor=3" class="admin-theme-3 btn btn-secondary border-0 mb-3 mr-3">Grey</a>
        <a href="../controller/website_setting.inc.php?themeColor=4" class="admin-theme-4 btn btn-danger border-0 mb-3 mr-3">Red</a>
        <a href="../controller/website_setting.inc.php?themeColor=5" class="admin-theme-5 btn btn-success border-0 mb-3 mr-3">Green</a>
    </div>
</div>

<?php include __DIR__.'/../includes/footer.php'; ?>