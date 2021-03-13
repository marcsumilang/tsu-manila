<?php
    function printToConsole($x){
        echo "<script>console.log(";
        echo json_encode($x);
        echo ");</script>";

    }

    //assign the wp slug name of the pages for the menu. 
    define('TOP_MENU_SLUG', 'about'); 
    define('LEFT_MENU_SLUG', 'branded'); 
    define('RIGHT_MENU_SLUG', 'original'); 
    define('BOTTOM_MENU_SLUG', 'services'); 

?>