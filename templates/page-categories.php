<?php
// FOR DEBUGGING
// echo printToConsole($stories);
// echo printToConsole($stories_list);
// echo printToConsole($categories_list);
// echo printToConsole($story_categories);
// echo printToConsole($category_name);
?>

<script type="text/x-template" id="categories-page" story-page-title='test!' >
    <div id='categories-content' class='inner-container'>
        <div class='drop-down-select fjalla hide-on-desktop v-middle' v-on:click='showGenreMenu = !showGenreMenu'>
            <img src='<?php echo BASE_URL;?>assets/mobile-arrowhead.png' class='arrowhead' v-bind:class='{active: showGenreMenu}'/>
            <div class='label active'>{{currentMobileCategory.name}}</div>
            <div class='menu' v-bind:class='{active: showGenreMenu}'>
                <router-link v-for='item in mobileCategoriesNav' :to='{path: "../category/" + item.slug}' class='item v-middle'><div class='label'>{{item.name}}</div></router-link>
            </div>
        </div>
        
        <router-link to='<?php echo BASE_URL;?>contact-us' class='create-your-story fjalla v-middle hide-on-desktop'>
            <div class='label'>Create your story.</div>

            <div class='contact-us-label v-middle'>
                <div class='sourcesans'>Contact Us</div>
                <img src='<?php echo BASE_URL;?>assets/carousel-right.png' />        
            </div>
        </router-link>
        <div class='categories-nav hide-on-768'>
            <router-link to='all' v-bind:class='{active: isRouteParamActive("all")}' class='category-nav'>ALL STORIES</router-link>
            <?php
                
                for($i=0; $i<count($categories_list); $i++){
                    //show category only if there are tagged videos
                    //echo count($stories[$categories_list[$i]->slug]);
                    if(count($stories[$categories_list[$i]->slug]) > 0){
                        echo "<router-link to='".$categories_list[$i]->slug."' v-bind:class='{active: isRouteParamActive(\"".$categories_list[$i]->slug."\")}' class='category-nav tst2'>".$categories_list[$i]->name."</router-link>";    
                    }
                }
            ?>
            <!-- <router-link to='family' v-bind:class='{active: isRouteParamActive("family")}' class='category-nav'>FAMILY</router-link>-->
        </div>
        <div class='categories-thumbs desktop hide-on-480' v-bind:class='{list: viewType == "list"}'>
            <div class='view-selector'>
                <div class='icon grid' v-on:click='viewType = "grid"' v-bind:class='{active: viewType == "grid"}'>
                    <img class='main' src='<?php echo BASE_URL;?>assets/grid-icon.png'/>
                    <img class='view-active' src='<?php echo BASE_URL;?>assets/grid-icon-active.png'/>
                </div>
                <div class='icon list' v-on:click='viewType = "list"' v-bind:class='{active: viewType == "list"}'>
                    <img class='main' src='<?php echo BASE_URL;?>assets/list-icon.png'/>
                    <img class='view-active' src='<?php echo BASE_URL;?>assets/list-icon-active.png'/>
                </div>
            </div>
            <router-link :to="{path: '../' + item.slug}" class='story-thumb' v-for="item in getStoriesSubArray(currentPage)">
                <div class='image-thumb'>
                    <img src='<?php echo BASE_URL;?>assets/thumb-filler.png' class='filler'/>
                    <img :src='item.acf.thumbnail' class='zoom'/>
                </div>
                <div class='title-overlay v-middle'>
                    <!-- <img src='<?php echo BASE_URL;?>assets/thumb-filler.png' class='filler'/> -->
                    <p v-html='item.title.rendered'></p>
                </div>
            </router-link>
        </div>
        <div class='categories-thumbs hide-on-desktop'>
            <router-link :to="{path: '../' + item.slug}" class='story-thumb' v-for="item in getStoriesSubArrayMobile(mobileCurrentPage)">
                <div class=image-container><img src='<?php echo BASE_URL;?>assets/thumb-filler.png' class='filler'/><img :src='item.acf.thumbnail' class='zoom'/></div>
                <div class='copy'>
                    <div class='title fjalla' v-html='item.title.rendered'></div>
                    <div class='genre sourcesans' style='color:#959595;'>GENRE: <span style='color:#585858'>{{listGenres(item.categoriesName)}}</span></div>
                </div>
            </router-link>
        </div>
        <div class='load-more-container' v-if='showLoadMore'>
            <div class='load-more-button button style1 hide-on-desktop' v-on:click='loadMoreMobile(mobileCurrentPage+1)'>
                LOAD MORE
            </div>
        </div>
        
        <div class='categories-bottom-nav desktop'>
            <div class='back nav-button' v-on:click='changeCurrentPage(currentPage-1)'>
                <div class='arrow-container'>
                    <img class='back-arrow' src='<?php echo BASE_URL;?>assets/back-arrow.png'/>
                    <img class='back-arrow-red' src='<?php echo BASE_URL;?>assets/back-arrow-red.png'/>
                </div>
            </div>
            <div class='page-label'>
                <span id='current-category-page'>{{currentPage+1}}</span>/<span id='category-page-limit'>{{maxPage}}</span>
            </div>
            <div class='forward nav-button' v-on:click='changeCurrentPage(currentPage+1)' style='transform: rotateY(180deg); margin-right: 1%;'>
                <div class='arrow-container'>
                    <img class='back-arrow ' src='<?php echo BASE_URL;?>assets/back-arrow.png'/>
                    <img class='back-arrow-red' src='<?php echo BASE_URL;?>assets/back-arrow-red.png'/>
                </div>
            </div>
        </div>
        <?php echo $bottomNavigation;?>
    </div>
</script>
