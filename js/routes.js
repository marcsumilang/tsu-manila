// const PageNotFound = { template: "<div class='full-container v-middle' style='text-align:center;'><div class='title'>PAGE NOT FOUND</div></div>" };

const routes = [
    {
        path: basePath
    }, 
    {
        path: basePath+'about'
    }, 
    {
        path: basePath+'branded'
    },         
    {
        path: basePath+'branded/category/:category',
        component: CategoriesPage
    },
    {
        path: basePath+'branded/:story',
        component: StoryPage
    },
    {
        path: basePath+'original'
    },
    {
        path: basePath+'original/category/:category',
        component: OriginalsPage
    },
    {
        path: basePath+'original/:story',
        component: StoryPage
    },
    {
        path: basePath+'services'
    }, 
    {
        path: basePath+'contact-us', component: ContactUs
    }, 
    {
        path: basePath+'404', component: PageNotFound
    }, 
    {
        path: '*', redirect: basePath+'404'
    }
]; 