<?php

    $mainNavigation = "
    <div class='nav-container' v-bind:class='{white: isStoryPage()}'>
        <div id='submenu' v-bind:class='{active: showSubMenu()}'>
            <router-link to='".BASE_URL."' id='menu-home' class='regular-home'><img id='menu-logo' class='hide-on-999px' src='".BASE_URL."assets/logo2.png'><img id='menu-logo-mobile' class='hide-on-desktop' src='".BASE_URL."assets/logo.png'></router-link>
            <router-link to='".BASE_URL."' id='menu-home' class='white-home'><img id='menu-logo' src='".BASE_URL."assets/logo5.png?2'></router-link>
            <div class='navigation v-middle'>
                <div class='back nav-button' v-on:click='goBack'><div class='arrow-container'><img class='back-arrow' src='".BASE_URL."assets/back-arrow.png'/><img class='back-arrow-red' src='".BASE_URL."assets/back-arrow-red.png'/> </div> <span class='hide-on-999px'>Back</span></div>
                <router-link to='".BASE_URL."' class='home nav-button'><span class='hide-on-999px'>Home</span><div class='hide-on-desktop show-1'><img class='mobile-home' src='".BASE_URL."assets/mobile-home.png'/></div></router-link >
            </div>
        </div>
        <router-link to='".BASE_URL."about' class='route vertical' id='menu-about'><div class='bar vertical'></div><br/><div class='route-name'>About Us</div></router-link>

        <router-link to='".BASE_URL."branded' class='route horizontal hide-on-768' id='menu-stories' exact><div class='bar horizontal'></div><div class='route-name'>Branded</div></router-link>
        <router-link to='".BASE_URL."branded/category/all' class='route horizontal hide-on-desktop' id='menu-stories' exact><div class='bar horizontal'></div><div class='route-name'>Branded</div></router-link>

        <router-link to='".BASE_URL."original' class='route horizontal hide-on-768' id='menu-originals'><div class='route-name'>Original</div><div class='bar horizontal'></div></router-link>
        <router-link to='".BASE_URL."original/category/all' class='route horizontal hide-on-desktop' id='menu-originals'><div class='route-name'>Original</div><div class='bar horizontal'></div></router-link>
        
        <router-link to='".BASE_URL."contact-us' class='route absolute' id='menu-contact-us' v-bind:class='{visible: getCurrentRouteName() == \"home\"}'><div class='route-name'>Contact Us</div></router-link>    
    </div>";
    
    $homeBottomNavigation = "<div class='bottom-nav'> <router-link to='".BASE_URL."services' class='route vertical' id='menu-makers'><div class='route-name'>Services</div><br/><div class='bar vertical'></div></router-link></div>";

    $bottomNavigation = "<div class='bottom-nav'> 
        <router-link to='".BASE_URL."services' class='route vertical' id='menu-makers'>
            <div class='route-name'>Services</div>
            <br/><div class='bar vertical'></div>
        </router-link>
        <div class='socmed hide-on-desktop'>
            <a href='https://www.facebook.com' class='icon'><img src='".BASE_URL."assets/fb.png'/></a>
            <a href='https://www.linkedin.com/' class='icon'><img src='".BASE_URL."assets/linkedin.png'/></a>
            <a href='https://www.instagram.com' class='icon'><img src='".BASE_URL."assets/ig.png'/></a>
        </div>
        <div to='".BASE_URL."contact-us' class='route mobile-route absolute' id='back-to-top' v-on:click='scrollToTop()'><div class='route-name'>Back to top</div></div>
        
        <router-link to='".BASE_URL."contact-us' class='route mobile-route absolute' id='menu-contact-us'><div class='route-name'>Contact Us</div></router-link>
        </div>";

    $bottomMobileNavigation = "<div class='bottom-nav'> <router-link to='".BASE_URL."makers' class='route vertical' id='menu-makers'><div class='route-name'>Makers</div><br/><div class='bar vertical'></div></router-link></div>";
?>