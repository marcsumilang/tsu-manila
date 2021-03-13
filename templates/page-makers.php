
<custom-scrollbar classes="my-scrollbar" ref="makersScrollbar">
    <div class='scroll-container scroll-me'>
        <?php echo $mainNavigation; 
            
        
        ?>
        <div class='inner-container'>
            <div class='banner' style='background-image:url(<?php echo $makers_page->acf->image;?>)'>
                <div class='copy-container v-middle'>
                    <div class='copy-block'>
                        <h3 style='text-transform:uppercase;'><?php echo $makers_page->title->rendered;?></h3>
                        <br/>
                        <div class='title'><?php echo $makers_page->acf->header;?></div>
                        <div class='copy'><?php echo $makers_page->content->rendered;?></div>
                    </div>                                
                </div>
            </div>       
            <br/><br/><br/>
            <h2>STORYTELLERS</h2>
            <br/><br/>
            <div class='makers-container'>
                <?php
                    for($i=0 ; $i<count($makers); $i++){
                       echo "<div class='maker image-".(($i%2 == 0)? 'left' : 'right')."'>";
                       if($i%2 == 0){
                            // echo"<img class='image' src='". $makers[$i]->acf->maker_image."'/>";
                       }
                       echo "<div class='image-container' style='background-image:url(". $makers[$i]->acf->maker_image.")'><img class='image filler' src='". $makers[$i]->acf->maker_image."'/></div>";
                       echo "<div class='copy-container'>
                           <div class='padded-container'>
                               <div class='position'>".$makers[$i]->acf->position."</div>
                               <div class='name'>".$makers[$i]->acf->name."</div>
                               <div class='description'>".$makers[$i]->content->rendered."</div>
                               <div class='socmed'>";

                            if(strlen($makers[$i]->acf->fb_url) > 0)
                                echo "<a href='".$makers[$i]->acf->fb_url."'><img src='".BASE_URL."assets/fb-2.png' class='icon'/></a>";
                            if(strlen($makers[$i]->acf->twitter_url) > 0)
                                echo "<a href='".$makers[$i]->acf->twitter_url."'><img src='".BASE_URL."assets/twitter-2.png' class='icon'/></a>";
                            if(strlen($makers[$i]->acf->ig_url) > 0)
                                echo "<a href='".$makers[$i]->acf->ig_url."'><img src='".BASE_URL."assets/ig-2.png' class='icon'/></a>";
                       echo "</div>
                           </div>
                       </div>";
                       if($i%2 == 1){
                            //echo"<img class='image' src='". $makers[$i]->acf->maker_image."'/>";
                        }
                       echo "</div>";
                    }
                ?>
                
            </div>
            <?php echo $bottomNavigation;?>
        </div>
    </div>
</custom-scrollbar>