const transitionTime = 700;
const delay = 10;
Vue.prototype.$http = axios

const flipRoutes = ['home', 'about', 'branded', 'original', 'services'];

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

function checkIfScrolledBottom(){
    console.log(window.innerHeight+', '+ window.scrollY+', '+document.body.offsetHeight);
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
        console.log("bottom!");
    }
}

const app = new Vue ({
    el: '#main-viewport',
    components: {
        customScrollbar: Vue2Scrollbar,
        // ContactUs: ContactUs
        // ContactUs: ContactUs
    },
    data: {
        currentRoute: window.location.pathname, //current page
        animatedRoutes: {},         // for current routes in animation
        animationDirection: 'up',   // direction of current transition animation
        prevFlipClass: true,        // ?deprecated, switched to inline styling
        hideInactive: false,        // hide inactive pages
        initial: true,              // initialization check, will become false once user loads another page
        inAnimation: false,         // check if there is an ongoing transition animation 
        pageBottom: false,
        flipRoutes: flipRoutes,
        carousel: {
            stories: {featured:stories['featured'], current:0, length:stories['featured'].length},
            originals: {featured:originals['featured'], current:0, length:originals['featured'].length}
        },
        originalsCarousel: {},
        storyPageTitle: '',
        pageParams: {},
        categories: [],
        demoReelActive: false
    },
    router: router,                 // plug vue-router
    mounted: function(){
        //PUT CODE HERE TO EXECUTE ON PAGE LOAD

        if(this.isInitial()){
            // initialize animation direction, this is to initialize home page position if a non-home page is loaded initially
            this.changeAnimationDirection(this.currentRoute); 
            // console.log('initialize')
            // console.log(this.currentRoute)
            // console.log('-------------')
        }
        this.showSubMenu();
        this.checkIfPageBottom();
        // this.storyPageTitle = this.getStoryTitle();
        // this.pageParams.storyTitle = this.getStoryTitle();
        this.pageParams = this.getRouteParam();
        this.getAllCategories();

        demoPlayer = document.querySelector('#demo-reel');
        demoReel = new Vimeo.Player(demoPlayer);

        demoReel.on('pause', this.hideDemoReel);

        demoReel.on('ended', this.hideDemoReel);

    },
    methods: {
        //STANDARD METHODS
        goBack: function(){
            window.history.back();
        },
        scrollToTop: function(){
            // console.log('weeee');
            // console.log(this.getCurrentRouteName());
            if(this.$refs.hasOwnProperty(this.getCurrentRouteName()+'Scrollbar')){
                this.$refs[this.getCurrentRouteName()+'Scrollbar'].scrollToY(0);
            }
            // else{
            //     this.$refs['defaultScrollbar'].scrollToY(0);
            // }
            
        },
        routeAnimation: function(route){
            // check the animation of a route (to or from)
            if(route in this.animatedRoutes){
                return this.animatedRoutes[route];
            }
            return false;    //return false if route is not being animated
        },
        isInitial: function(){
            return this.initial;    // check if in initial state
        },
        isCurrentRoute: function(route){
            return this.currentRoute == route;  //check if a route is the current one
        },
        isFlipRoute: function(route){
            var routeName = this.getRouteName(route);
            return this.flipRoutes.includes(routeName);
        },
        getRouteName: function(route){
            //parse the route path to get the name e.g. /TSU/about -> about
            var routeComponents = route.split('/');
            var name = routeComponents[routeComponents.length-1];
            // console.log(routeComponents);
            // console.log(routeComponents.length);
            if(routeComponents.length < 4){
                if(name == '')
                    return 'home';
                return routeComponents[routeComponents.length-1];
            }
            else{
                return 'other';
            }
        },
        getCurrentRouteName: function(){
            //parse the current route path's name
            var name = this.getRouteName(this.currentRoute);
            
            return name;
        },
        getAllCategories: function(){
            this.$http.get(serverName+'cms/wp-json/wp/v2/categories?parent=2').then(
                function(response) {
                    // console.log('categories');
                    this.categories = response.data;
                    //console.log(response.data);
                }
            );
        },
        changeAnimationDirection: function(route){
            // set the direction of transition animation by determining the destination page

            switch(this.getRouteName(route)){
                case 'about': this.animationDirection = 'down'; break;      // if about page -> flip down
                case 'branded': this.animationDirection = 'right'; break;   // if stories page -> flip right
                case 'original': this.animationDirection = 'left'; break;  // if originals page -> flip left
                case 'services': this.animationDirection = 'up';break;        // if services page -> flip up
                case 'home': {                                               
                    // if destination page is home then go opposite of last transition direction   
                    switch(this.animationDirection){
                        case 'down': this.animationDirection = 'up'; break;
                        case 'up': this.animationDirection = 'down'; break;
                        case 'left': this.animationDirection = 'right'; break;
                        case 'right': this.animationDirection = 'left'; break;
                    }
                }
            }
        },
        getAnimationDirection:function(){
            // get the current or last animation direction
            return this.animationDirection;
        },
        pageTransition: function(route){
            var routeStatus = this.routeAnimation(route);
            var classes = {};
            this.prevFlipClass = true;
            var routeName = this.getRouteName(route);
            // console.log('routeName? '+routeName);
            if(this.isFlipRoute(this.currentRoute)){            
                if(this.isInitial())
                    this.hideInactive = false;
                else
                    this.hideInactive = true;

                    // console.log(route)    
                    // console.log(routeStatus)    
                
                if(!this.initial){
                    if(routeStatus != false){
                        if(routeStatus ===  'to'){
                            if(this.inAnimation)
                                return {active: true, transition_enabled: true};
                            else
                            return {active: true, transition_enabled: false};
                        }
                        else if(routeStatus === 'from'){
                            if(this.inAnimation)
                                classes = {active: false, transition_enabled: this.inAnimation}
                            else
                                classes = {active: false, inactive: this.hideInactive, transition_enabled: false}
                            return classes;
                        }
                    }
                    else{
                        return {active: false, inactive: this.hideInactive, transition_enabled: false}
                    }
                    this.removeTransitionAfter();
                }
                else{
                    if(route != this.currentRoute){
                        return {inactive:true};
                    }
                    else{
                        return {active:true};
                    }
                }
            }
            else{
                if(routeName != 'default'){
                    return {fade_active:false, active:false, transition_enabled:false, no_transition:true}
                }
                else{
                    classes = {fade_active:true, fade_transition:true};
                    return classes;
                }
            }
        },
        removeTransitionAfter: function(){
            var self = this;
            setTimeout(function(){
                // console.log('animation finished')
                self.inAnimation = false;
                self.prevFlipClass = false;
                self.hideInactive = false;
                // console.log(this.prevFlipClass);
            }, (transitionTime+delay))
        },        
        changeOffset: function(route){
            
            var direction = this.getAnimationDirection();
            var routeName = this.getRouteName(route);
            var status = this.routeAnimation(route);
            
            if(routeName === 'home'){
                if(status != 'to'){
                    switch(direction){
                        case 'down': return {transform: 'translate3d(0,100%,0) rotate3d(1,0,0,-90deg)', transformOrigin:'top'}; 
                        case 'up': return {transform: 'translate3d(0,-100%,0) rotate3d(1,0,0,90deg)', transformOrigin:'bottom'};
                        case 'left': return {transform: 'translate3d(-100%,0,0) rotate3d(0,1,0,-90deg)', transformOrigin:'right'};
                        case 'right': return {transform: 'translate3d(100%,0,0) rotate3d(0,1,0,90deg)', transformOrigin:'left'};
                    }
                }
                else{
                    switch(direction){
                        case 'down': return {transformOrigin:'bottom'};
                        case 'up': return {transformOrigin:'top'};
                        case 'left': return {transformOrigin:'left'};
                        case 'right': return {transformOrigin:'right'};
                    }
                }
            }
            else{
                if(status === 'from' && this.inAnimation){
                    if(routeName == 'about' || routeName == 'services'){
                        if(direction == 'left'){
                            return {transform: 'translate3d(-100%,0,0) rotate3d(0,1,0,-90deg)', transformOrigin:'right'};
                        }
                        else if(direction == 'right'){
                            return {transform: 'translate3d(100%,0,0) rotate3d(0,1,0,90deg)', transformOrigin:'left'};
                        }
                    }
                    else if(routeName == 'branded' || routeName == 'original'){
                        if(direction == 'up'){
                            return {transform: 'translate3d(0,-100%,0) rotate3d(1,0,0,90deg)', transformOrigin:'bottom'};
                        }
                        else if(direction == 'down'){
                            return {transform: 'translate3d(0,100%,0) rotate3d(1,0,0,-90deg)', transformOrigin:'top'};
                        }
                    }
                }
                else{
                    return {};
                }
                // console.log('from '+routeName);
            } 
            
        },
        removeOffsetTransition: function(route){
            var self = this;
            setTimeout(function(){
                // console.log('removed '+route);
                self.changeOffset(route);
                self.pageTransition(route);
                // self.checkIfPageBottom();
            }, (transitionTime+delay+5))
        },
        showSubMenu: function(){
            // console.log('current route: '+this.getCurrentRouteName())
            if(this.getCurrentRouteName() != 'home'){
                return true;
            }
            else{
                return false;
            }
          
        },
        checkIfPageBottom: function(){
            if ((window.innerHeight + document.querySelector('#main-container').scrollTop) >= document.querySelector('#main-container').scrollHeight) {
                this.pageBottom = true;    
                console.log('bottom!');
            }
            else{
                this.pageBottom = false;         
                // console.log('not bottom!');
            }
        },
        isCurrentCarouselSlide: function(carouselName, slide){
            if(this.carousel.hasOwnProperty(carouselName)){
                // return slide == 0;
                return slide == this.carousel[carouselName].current;    
            }            
        },
        getCarouselCurrent: function(carouselName){
            if(this.carousel.hasOwnProperty(carouselName)){
                return this.carousel[carouselName].current;
            }
        },
        changeCarouselSlide: function(carouselName, slide){
            
            if(slide < 0){
                this.carousel[carouselName].current = this.carousel[carouselName].length - 1;
            }
            else if(slide >= this.carousel[carouselName].length){
                this.carousel[carouselName].current = 0;
            }
            else{
                this.carousel[carouselName].current = slide;
            }
        },
        carouselOffset: function(carouselName){
            
            if(this.carousel.hasOwnProperty(carouselName)){
                return {transform: 'translateX('+(-100*this.carousel[carouselName].current)+'%)'};
            }
            // return {transform: 'translateX('+(-100*0)+'%)'};
        },
        isStoryPage: function(){
            return this.$router.currentRoute.matched[0].path == basePath+'branded/:id'
        },
        getRouteParam: function(){
            // console.log(this.$router.currentRoute.params)
            return this.$router.currentRoute.params;
        },
        listGenres: function(storyCategories){
            // console.log(storyCategories)
            var string = '';
            for(var i=0; i<storyCategories.length; i++){
                if(i > 0){
                    string += ', ';
                }
                string += storyCategories[i].name; //.toLowerCase()
            }
            return string;
        },
        viewDemoReel: function(){
            //see component.js for the demoReel object
            this.demoReelActive = true;
            
            demoReel.play();
        },
        hideDemoReel: function(){
            this.demoReelActive = false;
        }
        
    },
    computed: {
        
    },
    watch:{
        $route (to, from){
            
            this.initial = false;
            this.currentRoute = window.location.pathname;
            this.inAnimation = true;
            this.animatedRoutes = {};
            this.animatedRoutes[to.path] = 'to';
            this.animatedRoutes[from.path] = 'from';
            this.removeTransitionAfter();
            this.removeOffsetTransition(from.path);
            this.changeAnimationDirection(to.path);
            this.pageParams = this.getRouteParam();
            // console.log('flip? '+ this.isFlipRoute(to.path));
            this.$refs['defaultPageScrollbar'].scrollToY(0);
           
            // console.log(to.path);
            // console.log('current: '+to.path);
        }
    }

});