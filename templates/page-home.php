<?php echo $mainNavigation; 
$home_json = file_get_contents(SERVER_NAME.'cms/wp-json/wp/v2/pages?slug=home');
$home_info = json_decode($home_json);
$home_info = $home_info[0];

?>
<div class='full-container'>
    <img id='logo' class='centered-absolute' src='<?php echo $home_info->acf->image; ?>' alt='wee'/>
    
    <div id='slogan' class='centered-absolute v-middle fjalla'><div><?php echo $home_info->content->rendered; ?></div></div>
    <?php echo $homeBottomNavigation;?>
</div>