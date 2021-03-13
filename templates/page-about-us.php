
<custom-scrollbar classes="my-scrollbar" ref="aboutScrollbar">
    <div class='scroll-container scroll-me'>
        <?php echo $mainNavigation; 
            $about_us_json = file_get_contents(SERVER_NAME.'cms/wp-json/wp/v2/pages?slug=about-us');
            $about_us_page = json_decode($about_us_json);
            $about_us_page = $about_us_page[0];
        ?> 
        <div class='inner-container'>
            <div class='banner' style='background-image:url(<?php echo $about_us_page->acf->image;?>)'>
                <div class='copy-container v-middle' v-on:click='viewDemoReel()'>
                    <!-- <div >&#f04b;</div> -->
                    <i class="fas fa-play mini basic_transition_500ms"></i>
                    <i class="fas fa-play big centered-absolute basic_transition_500ms"></i>
                    <div class='copy-block basic_transition_500ms'>
                        <h3 style='text-transform:uppercase;'><?php echo $about_us_page->title->rendered;?></h3>
                        <br/>
                        <div class='title'><?php echo $about_us_page->acf->header;?></div>
                        <div class='copy'><?php echo $about_us_page->content->rendered;?></div>
                    </div>                                
                </div>
                <iframe id='demo-reel' class='basic_transition_500ms'  v-bind:class='{active: demoReelActive}' src="<?php echo $about_us_page->acf->demo_reel.'?api=1'; ?>" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
               
            </div>                                    
            <h2 class='title-header'>OUR TEAM</h2>                                
            <div class='team-container'>
                <?php 
                    for($i=0; $i<count($members); $i++){
                        echo "<div class='team-member'>
                            <div class='image-container' style='background-image:url(".$members[$i]->acf->image.");'></div>
                            <div class='description'>
                                <div class='name'>".$members[$i]->acf->name."</div>
                                <div class='position'>".$members[$i]->acf->position."</div><br/>";
                        if(isset($members[$i]->acf->quirky_description)){
                            echo"<div class='quirk'>".$members[$i]->acf->quirky_description."</div>";
                        }    
                        
                        echo "
                            </div>
                        </div>";
                    }
                ?>          
                
            </div>
            <?php echo $bottomNavigation;?>
            
        </div>
    </div>
    
</custom-scrollbar>