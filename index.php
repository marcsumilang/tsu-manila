<?php
    // error_reporting(E_ALL ^ E_WARNING); 

    if (session_status() == PHP_SESSION_NONE) {
        session_start();        
    }

    //GET THE BASE PATH OF THE DIRECTORY WHERE THE INDEX.PHP IS LOCATED
    
    function getBasePath(){
		return implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
    }

    define('SERVER_NAME', 'http://'.$_SERVER['SERVER_NAME'].getBasePath()); //FULL PATH
    define('BASE_URL', getBasePath()); 

    include('templates/navigation.php');
    include('misc.php');

    //get stories(branded) category ID and assign to a variable
    $getCategory = json_decode(file_get_contents(SERVER_NAME.'cms/wp-json/wp/v2/categories?slug=story&per_page=100'));
    $STORY_CATEGORY_ID = $getCategory[0]->id;

    //get original(branded) category ID and assign to a variable
    $getCategory = json_decode(file_get_contents(SERVER_NAME.'cms/wp-json/wp/v2/categories?slug=original&per_page=100'));
    $ORIGINAL_CATEGORY_ID = $getCategory[0]->id;

    //Get all stories subcategories
    $categories_json = file_get_contents(SERVER_NAME.'cms/wp-json/wp/v2/categories?parent='.$STORY_CATEGORY_ID.'&per_page=100');
    $categories_list = json_decode($categories_json);

    //Get all originals subcategories
    $originals_categories_json = file_get_contents(SERVER_NAME.'cms/wp-json/wp/v2/categories?parent='.$ORIGINAL_CATEGORY_ID.'&per_page=100');
    $originals_categories_list = json_decode($originals_categories_json);

    $categories_info = array();
    $category_name = array();

    //Get all stories objects
    $stories_json = file_get_contents(SERVER_NAME.'cms/wp-json/wp/v2/posts?filter[category_name]=story&filter[orderby]=meta_value_num&filter[meta_key]=feature_priority&order=desc&per_page=100');
    $stories_list = json_decode($stories_json);
    //Get all originals objects
    $originals_json = file_get_contents(SERVER_NAME.'cms/wp-json/wp/v2/posts?filter[category_name]=original&filter[orderby]=meta_value_num&filter[meta_key]=feature_priority&order=desc&per_page=100');
    $originals_list = json_decode($originals_json);

    //initialize arrays for organizing stories/originals by categories
    $stories = array();
    $stories['all'] = array();
    $stories['featured'] = array();
    $stories['featured-originals'] = array();

    $originals = array();
    $originals['all'] = array();
    $originals['featured'] = array();

    $stories_json = file_get_contents(SERVER_NAME.'cms/wp-json/wp/v2/posts?filter[category_name]=story&filter[orderby]=date&order=desc&per_page=100');
    $stories['all'] = json_decode($stories_json);

    $originals_json = file_get_contents(SERVER_NAME.'cms/wp-json/wp/v2/posts?filter[category_name]=original&filter[orderby]=date&order=desc&per_page=100');
    $originals['all'] = json_decode($originals_json);

    // printToConsole(($stories_json));
    // printToConsole($stories['all']);
    
    //organize the category infos into an associative array
    for($i=0 ; $i < count($categories_list); $i++){
        $categories_info[$categories_list[$i]->slug] = $categories_list[$i];
        $category_name[$categories_list[$i]->id] = $categories_list[$i]->slug;
        $stories[$categories_list[$i]->slug] = array();
    }
    //do the same for the originals categories
    for($i=0 ; $i < count($originals_categories_list); $i++){
        $categories_info[$originals_categories_list[$i]->slug] = $originals_categories_list[$i];
        $category_name[$originals_categories_list[$i]->id] = $originals_categories_list[$i]->slug;
        $originals[$originals_categories_list[$i]->slug] = array();
    }
    // echo json_encode($originals);

    //organize the stories by genre
    for($i=0 ; $i < count($stories_list); $i++){
        $story_categories = $stories_list[$i]->categories;
        //remove story category id
        if (($key = array_search($STORY_CATEGORY_ID, $story_categories)) !== false) {
            array_splice($story_categories, $key, 1);
        }

        for($j=0; $j<count($story_categories);$j++){
            if(array_key_exists($story_categories[$j], $category_name)){                
                array_push($stories[$category_name[$story_categories[$j]]], $stories_list[$i]);
            }
        }
        if($stories_list[$i]->acf->featured_story === true || $stories_list[$i]->acf->featured_story === 'true' ){
            array_push($stories['featured'], $stories_list[$i]);
        }       
    }
    // echo json_encode($originals_list);
    //organize the originals by genre
    for($i=0 ; $i < count($originals_list); $i++){
        $story_categories = $originals_list[$i]->categories;
        //remove original category id
        if (($key = array_search($ORIGINAL_CATEGORY_ID, $story_categories)) !== false) {
            array_splice($story_categories, $key, 1);
        }
        // echo json_encode($story_categories);
        for($j=0; $j<count($story_categories);$j++){
            if(array_key_exists($story_categories[$j], $category_name)){
                array_push($originals[$category_name[$story_categories[$j]]], $originals_list[$i]);
            }
        }
        if($originals_list[$i]->acf->featured_story === true || $originals_list[$i]->acf->featured_story === 'true' ){
            array_push($originals['featured'], $originals_list[$i]);
        }       
    }

    //assign type for every story
    for($i=0 ; $i < count($stories['all']); $i++){
        $stories['all'][$i]->story_type = 'branded';
    }

    // printToConsole($originals);
    for($i=0 ; $i < count($originals['all']); $i++){
        $originals['all'][$i]->story_type = 'original';
    }

    $makers_json = file_get_contents(SERVER_NAME.'cms/wp-json/wp/v2/pages?slug=makers');
    $makers_page = json_decode($makers_json);
    if(count($makers_page) > 0){
        $makers_page = $makers_page[0];
    }
    

    $makers_json = file_get_contents(SERVER_NAME.'cms/wp-json/wp/v2/posts?filter[category_name]=maker&filter[orderby]=meta_value_num&filter[meta_key]=priority&order=desc&per_page=100');
    $makers = json_decode($makers_json);

    $members_json = file_get_contents(SERVER_NAME.'cms/wp-json/wp/v2/posts?filter[category_name]=team-member&filter[orderby]=meta_value_num&filter[meta_key]=priority&order=desc&per_page=100');
    $members = json_decode($members_json);

?>

<html>
    <head>
        <title>This Side Up</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width,height=device-height, initial-scale=1"/>
        <meta name="googlebot" content="NOODP">
        <link rel='icon' href='<?php echo BASE_URL;?>assets/favicon.ico?v2' type='image/x-icon'/ >
        <link rel='stylesheet' type='text/css' href='<?php echo BASE_URL;?>css/reset.css' />
        <link rel='stylesheet' type='text/css' href='<?php echo BASE_URL;?>css/generic.css' />
        <link rel='stylesheet' type='text/css' href='<?php echo BASE_URL;?>css/vue2-scrollbar.css' />
        <link rel='stylesheet' type='text/css' href='<?php echo BASE_URL;?>fonts/fonts.css' />
        <link rel='stylesheet' type='text/css' href='<?php echo BASE_URL;?>css/style.css' />
        <link rel='stylesheet' type='text/css' href='<?php echo BASE_URL;?>css/mobile.css' />
        <script src="https://player.vimeo.com/api/player.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1/dist/vue-resource.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.15.2/axios.js"></script>
        <script src="https://unpkg.com/vue-router@3.1.3/dist/vue-router.js"></script>
        <script src="https://kit.fontawesome.com/22878b2a9d.js" crossorigin="anonymous"></script>
        
        
        <script src="<?php echo BASE_URL;?>js/vue2-scrollbar.js"></script>
        <script>
            const basePath = '<?php echo BASE_URL;?>';
            const serverName = '<?php echo SERVER_NAME;?>';
            const storyCategoryID = '<?php echo $STORY_CATEGORY_ID;?>';
            const originalCategoryID = '<?php echo $ORIGINAL_CATEGORY_ID;?>';

            const categoriesList = <?php echo json_encode($categories_list);?>;
            const originalsCategoriesList = <?php echo json_encode($originals_categories_list);?>;
            const categoriesInfo = <?php echo json_encode($categories_info);?>;
            const categoriesName = <?php echo json_encode($category_name);?>;
            var stories = <?php echo json_encode($stories);?>;
            var originals = <?php echo json_encode($originals);?>;
            var masterList = stories['all'].concat(originals['all']);
           
        </script>
    </head>
    <body>
        <?php
            include('templates/page-not-found.php');
            include('templates/page-full-story.php');
            include('templates/page-contact-us.php');
            include('templates/page-categories.php');
            include('templates/page-originals-categories.php');
        ?>
        <div id='main-viewport'>
            <div id='menu'>              
                <!-- <?php echo $mainNavigation; ?> -->
            </div>
            <?php include('templates/socmed.php'); ?>
            <div id='main-container' class='panels-container' v-on:scroll='checkIfPageBottom' >
                <div id='home' v-bind:class='pageTransition("<?php echo BASE_URL;?>")' v-bind:style='changeOffset("<?php echo BASE_URL;?>")' class='full-panel'>
                    <?php
                        include('templates/page-home.php');
                    ?>
                </div>
                <div id='about' v-bind:class='pageTransition("<?php echo BASE_URL;?>about")' v-bind:style='changeOffset("<?php echo BASE_URL;?>about")' class='full-panel absolute no-mobile-route-nav'>
                    <?php
                        include('templates/page-about-us.php');
                    ?>
                </div>
                <div id='stories' v-bind:class='pageTransition("<?php echo BASE_URL;?>branded")' v-bind:style='changeOffset("<?php echo BASE_URL;?>branded")' class='full-panel absolute no-mobile-route-nav'>
                    <?php
                        include('templates/page-stories.php');
                    ?>
                </div>
                <div id='originals' v-bind:class='pageTransition("<?php echo BASE_URL;?>original")' v-bind:style='changeOffset("<?php echo BASE_URL;?>original")' class='full-panel absolute no-mobile-route-nav'>
                    <?php
                        include('templates/page-originals.php');
                    ?>
                </div>
                <div id='makers' v-bind:class='pageTransition("<?php echo BASE_URL;?>services")' v-bind:style='changeOffset("<?php echo BASE_URL;?>services")' class='full-panel absolute no-mobile-route-nav'>
                    <?php
                        include('templates/page-services.php');
                    ?>
                </div>
                <div class="clearfix"></div>
            </div>           
            <div id='floating-container' class='full-panel no-mobile-route-nav' v-bind:class='pageTransition("<?php echo BASE_URL;?>default")'>
                <custom-scrollbar classes="my-scrollbar" ref="defaultPageScrollbar">
                    <div class='scroll-container scroll-me'>
                        <?php echo $mainNavigation; ?> 
                        <router-view v-bind:page-params='pageParams' v-bind:categories='categories'></router-view>
                    </div>
                </custom-scrollbar>                
            </div>            
        </div>
        <script>
            console.log('test')
            var demoPlayer, demoReel;
        </script>
        <script src='<?php echo BASE_URL;?>js/components.js'></script>
        <script src='<?php echo BASE_URL;?>js/routes.js'></script>
        <script src='<?php echo BASE_URL;?>js/main.js'></script>
    </body>
</html>