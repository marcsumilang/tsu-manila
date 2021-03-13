<script type="text/x-template" id="story-page" >
    <div id='story-content' class='full-container'>
        <div class='video-container' v-if='storyInfo != undefined'>
            <!-- <video ref='storyVideo' v-on:click='pauseVideo()'>
                <source :src="storyInfo.acf.video" type="video/mp4">
            </video> -->
            <iframe :src="storyInfo.acf.vimeo" ref='storyVideo' frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
            <!-- <div class='play-button-overlay' v-bind:class='{hidden: videoPlaying}' v-on:click='playVideo()'>
                <img class='centered-absolute' src='<?php echo BASE_URL;?>assets/play.png' />
            </div> -->
        </div>
        <div class='copy-container'>
            <!-- <div class='title' v-html="storyInfo.type"></div><br/><br/> -->
            <div class='title' v-html="storyInfo.title.rendered"></div><br/><br/>
            <div class='genre'>GENRE: <span v-for="(item, index) in storyInfo.categoriesName"><span v-if='index > 0'>,&nbsp;</span><router-link :to="{path: '<?php echo BASE_URL;?>'+storyInfo.story_type+'/category/' + item.slug}" class='category-link'>{{item.name}}</router-link></span></div><br/><br/>
            <div class='description' v-html="storyInfo.acf.full_description"></div>
            <div class='credits' v-html="storyInfo.acf.credits">
            </div>
        </div>

        <?php echo $bottomNavigation;?>
    </div>
</script>
