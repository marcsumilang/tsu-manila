<?php echo $mainNavigation; 

?>
<div class='inner-container'>
    <div class='no-scroll-container v-middle text-center'>
        <div style='width:100%;'>
            <div class='featured-carousel carousel'>
                <img class='centered-absolute-y carousel-nav-button' style='left:0;' src='<?php echo BASE_URL;?>assets/carousel-left.png' v-on:click='changeCarouselSlide("stories",getCarouselCurrent("stories")-1)'/>
                <img class='centered-absolute-y carousel-nav-button' style='right:0;' src='<?php echo BASE_URL;?>assets/carousel-right.png' v-on:click='changeCarouselSlide("stories",getCarouselCurrent("stories")+1)'/>
                <div class='overflow v-middle' v-bind:style='carouselOffset("stories")'>
                    <div class='featured' v-for='(item, index) in carousel.stories.featured' v-bind:class='{active: isCurrentCarouselSlide("stories",index)}'>
                        <div class='image' v-bind:style='{"background-image": "url("+item.acf.thumbnail+")"}'></div>
                        <div class='copy-container'>
                            <div class='title' v-html='item.title.rendered'></div><br/><br/>
                            <div class='genre' >GENRE: {{listGenres(item.categoriesName)}}</div><br/><br/>
                            <div class='description' v-html='item.acf.short_description'></div><br/><br/>
                            <router-link :to="{path: '<?php echo BASE_URL;?>branded/' + item.slug}" class='button style2'> View Full Story</router-link>
                        </div>                    
                    </div>
                    
                </div>
            </div>
            <div class='see-all-container centered-absolute-x'>
                <router-link to='<?php echo BASE_URL;?>branded/category/all' class='button style1'> See All Stories</router-link>
            </div>
        </div>
        
    </div>
    <?php echo $bottomNavigation;?>
</div>