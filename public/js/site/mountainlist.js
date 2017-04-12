
var listingVue = new Vue({

    el: '#mountain_list',
    
    data:{
            mountainlist:[],
    },         
    
    ready: function() {

        this.getMountainList();
    },
   
    methods: {
      
         getMountainList: function()
            {
                var postparemeters = {type:'global',country_id:'99','start':0,'end':9};
                this.$http.post(baseurl+'/api/v1/device/getMountainList',postparemeters,function(response)
                {
                    this.$set('mountainlist',response.result.feeds);
                });
            },
    }
});

 jQuery('#listview').click(function(event) {
        event.preventDefault();
        jQuery(this).addClass("active");
        jQuery("#gridview").removeClass("active");

        jQuery("#gridview").children("img").attr("src","public/images/title_n.png");
         jQuery("#listview").children("img").attr("src","public/images/list_a.png");
        jQuery('#products .item').addClass('list-group-item');
        jQuery('#products .item').removeClass('grid-group-item');
        jQuery('#products .item').removeClass('grid-group-item');
        jQuery('li div.content_wrap').removeClass('grid_video_wrapper');
        jQuery('li div.content_wrap').addClass('list_video_wrapper');
        jQuery('li div.video_overlay').removeClass('grid_description');
        jQuery('li div.video_overlay').addClass('list_description');
       
       
});
 jQuery('#gridview').click(function(event) {
        event.preventDefault();
        jQuery('#products .item').removeClass('list-group-item');
        jQuery('#products .item').addClass('grid-group-item');
        jQuery(this).addClass("active");
        jQuery("#listview").removeClass("active");
        jQuery("#listview").children("img").attr("src","public/images/list_n.png");
        jQuery("#gridview").children("img").attr("src","public/images/title_a.png");
        jQuery('li div.video_overlay').addClass('grid_description');
        jQuery('li div.video_overlay').removeClass('list_description');
                
         jQuery('li div.content_wrap').addClass('grid_video_wrapper');
         jQuery('li div.content_wrap').removeClass('list_video_wrapper');
});


