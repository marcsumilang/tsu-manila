const DISPLAY_LENGTH = 12;
const MOBILE_DISPLAY_LENGTH = 3;

Array.prototype.remove = function() {
    var what, a = arguments, L = a.length, ax;
    while (L && this.length) {
        what = a[--L];
        while ((ax = this.indexOf(what)) !== -1) {
            this.splice(ax, 1);
        }
    }
    return this;
};


function getStoryFromSlug(slug){
    for(var i=0; i<masterList.length; i++){
        if(masterList[i].slug == slug){
            return masterList[i];
        }            
    }
    return false;
}

function getStoryCategories(categories){
    categories = categories.remove(storyCategoryID);
    categories = categories.remove(originalCategoryID);
    var values = [];
    var categorySlug = '';
    for(var i=0; i< categories.length; i++){
        if(categoriesName.hasOwnProperty(categories[i])){
            categorySlug = categoriesName[categories[i]];
            values.push({slug: categorySlug, name: categoriesInfo[categorySlug].name});
        }
    }
    return values;
}

function getStoriesListGenres(slug){

    if(stories.hasOwnProperty(slug)){
        //var sublist = stories[slug];
        for(var i=0; i<stories[slug].length; i++){
            stories[slug][i].categoriesName = getStoryCategories(stories[slug][i].categories);
        }
    }
    else{
        return false;
    }
}
function getOriginalsListGenres(slug){
 
    if(originals.hasOwnProperty(slug)){
        //var sublist = stooriginalsies[slug];
        for(var i=0; i<originals[slug].length; i++){
            originals[slug][i].categoriesName = getStoryCategories(originals[slug][i].categories);
        }
    }
    else{
        return false;
    }
}

for(var genre in stories){
    if(Array.isArray(stories[genre])){
        getStoriesListGenres(genre);
    }
}

for(var genre in originals){
    if(Array.isArray(originals[genre])){
        getOriginalsListGenres(genre);
    }
}

const PageNotFound = Vue.component('page-not-found', {
    template: '#page-not-found',
	data() {
		return {}
	},
	methods: {
        
	}
});

const ContactUs = Vue.component('contact-us', {
    template: '#contact-us',
	data() {
		return { checked: false, title: 'Check me', formData:{about:{value: '', dirty:false}, name: {value: '', dirty:false}, email: {value: '', dirty:false}, subject:{value: '', dirty:false}, body:{value: '', dirty:false}} }
	},
	methods: {
        // check() { this.checked = !this.checked; }
        scrollToTop: function(){
            this.$parent.scrollToY(0);
        },
        checkIfValid: function(input){
            // console.log(input)
            if(input.value.length>1 || input.dirty == false){
                return true;
            }
            return false;
        },
        checkForm:function(){
            var isFormValid = true;
            for (var prop in this.formData) {
                if (Object.prototype.hasOwnProperty.call(this.formData, prop)) {
                    // console.log(this.formData[prop])
                    this.formData[prop].dirty = true;

                    if(!this.checkIfValid(this.formData[prop])){
                        isFormValid = false;
                    }
                    if(prop == 'email'){
                        if(!this.isEmail(this.formData[prop])){
                            isFormValid = false;
                        }
                    }
                }
            }

            if(isFormValid){
                this.$refs.contactUsForm.submit();
            }
        },
        valueChanged:function(inputID){
            this.formData[inputID].dirty = true;
        },
        isEmail:function(email){
            if(!email.dirty)
                return true;
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email.value).toLowerCase());
        }
	}
});
const StoryPage = Vue.component('story-page', {
    template: '#story-page',
    props: ['pageParams'],
	data() {
		return { storyTitle: '', storySlug:'', storyInfo: {acf:{}}, videoPlaying : false, type: 'branded' }
    },
    mounted: function(){
   
    },
	methods: {
        scrollToTop: function(){
            this.$parent.scrollToY(0);
        },
        getStory: function(slug){
            var story = getStoryFromSlug(slug);
            if(story == false){
                // window.location.href = basePath+'404';
            }
            else{
                // console.log(story);
                return story;
            }
            // 
        },
        testFunction: function(){
            alert(this.storyTitle);
        },
        getStoryTitle: function(){
            // console.log('Title: '+storyTitles[this.pageParams.story])
            return storyTitles[this.pageParams.story];
        },
        playVideo: function(){
            this.$refs.storyVideo.play();
            console.log(this.$refs.storyVideo.hasAttribute("controls"))
            this.$refs.storyVideo.setAttribute("controls","controls")  
            this.videoPlaying = true;
        },
        pauseVideo: function(){
            this.$refs.storyVideo.pause();
            this.$refs.storyVideo.removeAttribute("controls")
            this.videoPlaying = false;
        },
        addComma: function(string, index){
            if(index > 0){
                return string+', ';
            }
            else
                return string;
        }
       
    },
    watch:{
        pageParams:{
            immediate: true,
            deep: true,
            handler(newValue, oldValue) {
                if(newValue != undefined){    
                    // console.log(newValue)                
                    this.storySlug = newValue.story;
                    this.storyInfo = this.getStory(this.storySlug);
                    // console.log(this.storyInfo);  
                    this.storyInfo.categoriesName = getStoryCategories(this.storyInfo.categories);
                }                
            }
        }
    }
});

const CategoriesPage = Vue.component('categories-page', {
    template: '#categories-page',
    props: ['pageParams','categories'],
	data() {
		return { checked: false, category: 'all', storiesList: [], displayLength: DISPLAY_LENGTH, currentPage: 0, maxPage: 1, categoriesList: [], stories: {all: [], featured:[], featured_originals:[] }, allStories: [], mobileCurrentPage:0, showLoadMore: true, showGenreMenu: false, mobileCategoriesNav: [], currentMobileCategory: {slug: 'all', name: 'All Stories'}, viewType: 'grid' }
    },
    created: function () {
        // console.log('created')
        // console.log(this.storiesList)
        
        // console.log('-------')
    },
    mounted: function () {
        this.category = this.pageParams.category;
        for(var i=0 ; i < categoriesList.length; i++){
            this.stories[categoriesList[i].slug] = [];
        }
        
        // console.log(this.showLoadMore);
       
    },
	methods: {
        scrollToTop: function(){
            this.$parent.scrollToY(0);
        },
		isRouteParamActive: function(param){
            // console.log(param)
            // console.log(this.pageParams.category)
            // console.log('-------------')
            return param == this.pageParams.category;
        },
        getStoriesSubArray: function(pageNum){
            // console.log(this.storiesList);
            if(this.storiesList != undefined){
                if(this.storiesList.length > 0){
                    return this.storiesList.slice(pageNum*DISPLAY_LENGTH, (pageNum+1)*DISPLAY_LENGTH);
                }
                
            }            
        },
        getStoriesSubArrayMobile: function(pageNum){
            // console.log(this.storiesList);
            var sublist = [];
            if(this.storiesList != undefined){
                if(this.storiesList.length > 0){
                    sublist = this.storiesList.slice(0, (pageNum+1)*MOBILE_DISPLAY_LENGTH);
                }
                if(sublist.length >= this.storiesList.length){
                    this.showLoadMore = false;
                }
                else{
                    this.showLoadMore = true;
                }
            } 
        
            return sublist;
                     
        },
        changeCurrentPage:function(num){
            if(num >= 0 && num < this.maxPage){
                this.currentPage = num;
            }
        },
        loadMoreMobile: function(num){
            if(num > 0){
                this.mobileCurrentPage = num;
                // console.log(this.mobileCurrentPage)
            }
            
            
        },
        getCategories: function(){
            this.$http.get(serverName+'cms/wp-json/wp/v2/categories?parent='+storyCategoryID).then(
                function(response) {
                    console.logresponse.data.message;
              }
            );
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
        getMobileCategoriesNav: function(){
            this.mobileCategoriesNav = [];
            if(this.pageParams.category != 'all'){
                this.mobileCategoriesNav.push({slug: 'all', name: 'All Stories'});
            }
            else{
                this.currentMobileCategory = {slug: 'all', name: 'All Stories'};
            }
            for(var i=0; i<categoriesList.length; i++){
                var categoryValue = {slug: categoriesList[i].slug, name: categoriesList[i].name};
                if(this.pageParams.category != categoriesList[i].slug){
                    this.mobileCategoriesNav.push(categoryValue);
                }
                else{
                    this.currentMobileCategory = categoryValue;
                }
            }
            // console.log(this.mobileCategoriesNav);
        }
    },
    watch:{
        pageParams:{
            immediate: true,
            deep: true,
            handler(newValue, oldValue) {
                if(newValue.category != undefined){
                    this.storiesList = stories[newValue.category];
                    this.currentPage = 0;
                    // console.log('total: '+this.storiesList.length)
                    this.getMobileCategoriesNav();
                    this.maxPage = Math.ceil(this.storiesList.length/DISPLAY_LENGTH);
                }
              
            }
        }
    }
});


const OriginalsPage = Vue.component('originals-page', {
    template: '#originals-categories-page',
    props: ['pageParams','categories'],
	data() {
		return { checked: false, category: 'all', storiesList: [], displayLength: DISPLAY_LENGTH, currentPage: 0, maxPage: 1, categoriesList: [], stories: {all: [], featured:[], featured_originals:[] }, allStories: [], mobileCurrentPage:0, showLoadMore: true, showGenreMenu: false, mobileCategoriesNav: [], currentMobileCategory: {slug: 'all', name: 'All Originals'}, viewType: 'grid'  }
    },
    created: function () {
        /* console.log('created')
        console.log(this.storiesList)
        
        console.log('-------') */
    },
    mounted: function () {
        this.category = this.pageParams.category;
        for(var i=0 ; i < originalsCategoriesList.length; i++){
            this.stories[originalsCategoriesList[i].slug] = [];
        }
        // console.log(this.showLoadMore);
       
    },
	methods: {
        scrollToTop: function(){
            this.$parent.scrollToY(0);
        },
		isRouteParamActive: function(param){
            // console.log(param)
            // console.log(this.pageParams.category)
            // console.log('-------------')
            return param == this.pageParams.category;
        },
        getStoriesSubArray: function(pageNum){
            // console.log(this.storiesList);
            if(this.storiesList != undefined){
                if(this.storiesList.length > 0){
                    return this.storiesList.slice(pageNum*DISPLAY_LENGTH, (pageNum+1)*DISPLAY_LENGTH);
                }
            }            
        },
        getStoriesSubArrayMobile: function(pageNum){
            // console.log(this.storiesList);
            var sublist = [];
            if(this.storiesList != undefined){
                if(this.storiesList.length > 0){
                    sublist = this.storiesList.slice(0, (pageNum+1)*MOBILE_DISPLAY_LENGTH);
                }
                if(sublist.length >= this.storiesList.length){
                    this.showLoadMore = false;
                }
                else{
                    this.showLoadMore = true;
                }
            } 
        
            return sublist;
                     
        },
        changeCurrentPage:function(num){
            if(num >= 0 && num < this.maxPage){
                this.currentPage = num;
            }
        },
        loadMoreMobile: function(num){
            if(num > 0){
                this.mobileCurrentPage = num;                
            }           
        },
        getCategories: function(){
            this.$http.get(serverName+'cms/wp-json/wp/v2/categories?parent='+originalCategoryID).then(
                function(response) {
                    //console.logresponse.data.message;
              }
            );
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
        getMobileCategoriesNav: function(){
            this.mobileCategoriesNav = [];
            if(this.pageParams.category != 'all'){
                this.mobileCategoriesNav.push({slug: 'all', name: 'All Originals'});
            }
            else{
                this.currentMobileCategory = {slug: 'all', name: 'All Originals'};
            }
            for(var i=0; i<originalsCategoriesList.length; i++){
                var categoryValue = {slug: originalsCategoriesList[i].slug, name: originalsCategoriesList[i].name};
                if(this.pageParams.category != originalsCategoriesList[i].slug){
                    this.mobileCategoriesNav.push(categoryValue);
                }
                else{
                    this.currentMobileCategory = categoryValue;
                }
            }
            // console.log(this.mobileCategoriesNav);
        }
    },
    watch:{
        pageParams:{
            immediate: true,
            deep: true,
            handler(newValue, oldValue) {
                if(newValue.category != undefined){
                    // this.storiesList = storiesTemp[newValue.category];
                    this.storiesList = originals[newValue.category];
                    this.currentPage = 0;
                    // this.maxPage = Math.ceil(this.storiesList.length/this.displayLength);
                    // console.log('total: '+this.storiesList.length)
                    this.getMobileCategoriesNav();
                    this.maxPage = Math.ceil(this.storiesList.length/DISPLAY_LENGTH);
                }
              
            }
        }
    }
});