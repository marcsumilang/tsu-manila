var store = {currentTitle: ''};

function generateGenericData(x, genre){
    var pageData = {
        slug: genre.toLowerCase()+x,
        thumb_src:'/TSU/assets/thumbs/'+((x % 8) + 1)+'.png',
        title: genre + ' ' + x,
        video_src: '/TSU/assets/movie'+(x % 2)+'.mp4',
        description: 'Lorem '+ x +'ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a pede.',
        genre: genre.toLowerCase()
    };
    return pageData;
}

var family = [];
var romance = [];
var fantasy = [];
var thriller = [];
var memoir = [];
var originals = [];
var masterList = {};
var genre = '';

for(var i=0; i<7; i++){
    genre = 'Family';
    masterList[genre.toLowerCase()+i] = generateGenericData(i, genre);
    family[i] = masterList[genre.toLowerCase()+i];
}
for(i=0; i<11; i++){
    genre = 'Romance';
    masterList[genre.toLowerCase()+i] = generateGenericData(i, genre);
    romance[i] = generateGenericData(i, genre);
}
for(i=0; i<4; i++){
    genre = 'Fantasy';
    masterList[genre.toLowerCase()+i] = generateGenericData(i, genre);
    fantasy[i] = generateGenericData(i, genre);
}
for(i=0; i<16; i++){
    genre = 'Thriller';
    masterList[genre.toLowerCase()+i] = generateGenericData(i, genre);
    thriller[i] = generateGenericData(i, genre);
}
for(i=0; i<5; i++){
    genre = 'Memoir';
    masterList[genre.toLowerCase()+i] = generateGenericData(i, genre);
   memoir[i] = generateGenericData(i, genre);
} 
for(i=0; i<29; i++){
    genre = 'Originals';
    masterList[genre.toLowerCase()+i] = generateGenericData(i, genre);
    originals[i] = generateGenericData(i, genre);
} 

// const stories = family.concat(romance).concat(fantasy).concat(thriller).concat(memoir).concat(originals);

const storiesTemp = {all: stories, family:family, romance:romance, fantasy:fantasy, thriller:thriller, memoir:memoir, originals:originals};