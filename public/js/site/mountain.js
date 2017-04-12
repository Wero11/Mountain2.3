var is_editable = 0;
var selectedFeedArr = new Array();
function onShowCreatePopup()
{
	clear_form();	
	jQuery('h4.modal-title').text('Create Mountain');
	jQuery('#mountainmodal').modal('show');
	flag='add';
	getIcons('create');
}
jQuery("#mountain_profile_image").click(function() {
    jQuery("#fileToUpload").click();
});
function getPushPopup()
{
	
if(selectedFeedArr.length>0)
  {
   jQuery('#push_description').val('');
 jQuery("label.error").remove();
    jQuery(".error").removeClass("error");
	jQuery('h4.modal-title').text('Push Notification');
	jQuery('#pushpopupmodal').modal('show');
	flag='add';
	getIcons('push');
  }
else
{
confirmBox('Alert',"Please select atleast one feed",'','');
 confirmModal.modal('show');
confirmModal.find('#okButton').hide();
confirmModal.find('#cancelButton').hide();
confirmModal.find('#confirm_close_btn').on('click',function(event)
		{
        	//alert('hi');
	getIcons('default');
		});
}
}
function onShowAddProfession(tag)
{
	if(tag!='save')
	{
		jQuery('#add_prof').show();
		jQuery('#select_prof').hide();
		
	}
	else
	{
		jQuery('#add_prof').hide();
		jQuery('#select_prof').show();
	}

}
function mountainvalidation(){
jQuery("#add_mountain").validate({
    rules: {
    	name 		: {required: true},
    	hash_tag 	: {required: true},
    	url       	: {required: true},
    	description : {required: true},
    	start_date  : {required: true},
    	//end_date  	: {required: true},
    	no_of_peaks  : {required: true},
    	peak_duration : {required: true},
    	zone_id       : {required: true},
    	window_description       : {required: true},
    	
    },
    messages: {
    	name 			: "Mountain name is required",
    	hash_tag 		: "Hash tag is required",
    	url       		: "URL is required",
    	description  	: "Description is required",
    	start_date  	: {required:"Start date is required"},
    	//end_date    	: {required:"End date is required"},
    	no_of_peaks  	: {required:'Number of peaks is required'},
    	peak_duration	: {required: "Peaks duration is required"},
    	zone_id       : {required: "Base timezone is required"},
    	window_description       : {required: "Upload window description is required"},
    },
    tooltip_options: {
    	'_all_': { placement:'right',html:true}
    },  
});

}
function pushNotificationvalidation(){
	jQuery("#push_notification").validate({
	    rules: {
	    	push_description 		: {required: true},
	    	
	    },
	    messages: {
	    	push_description 			: "Description is required",
	    },
	    tooltip_options: {
	    	'_all_': { placement:'right',html:true}
	    },  
	});

	}

function clear_form()
{
	jQuery('#name').val('');
    jQuery('#description').val('');
    jQuery('#start_date').val('');
    jQuery('#end_date').val('');
    jQuery("#hash_tag").val('');
    jQuery("#url").val('');
    jQuery("#no_of_peaks").val('');
    jQuery("#mount_peak_duration").val('');
    jQuery('#zone_id').val('');
    jQuery('#window_description').val('');
    jQuery('h4.modal-title').text('Create Mountain');
    jQuery("#file_error").html('');
    jQuery('#user_error').html('');
    jQuery("label.error").remove();
    jQuery(".error").removeClass("error");
    jQuery("#mountain_profile_image").attr('src',baseurl+"/public/images/img-placeholder.jpg");
    jQuery('#add_mountain').find("input,textarea").val('').end()
      .find("label.error").remove();
    jQuery("#no_of_peaks").prop('disabled', false);
	jQuery("#start_date").prop('disabled', false);
	jQuery("#mount_peak_duration").prop('disabled', false);
    flag='add';
}

function mountainimageselected(obj)
{
	 var file = obj[0]; 
	  file_size = obj[0].size;
	  image_select_flag=0;
	  if(file_size>1048576) 
	  {
	   jQuery("#file_error").html("File size is greater than 1MB"); 
	      
	  }
	  else
	  {
		  var ext = obj[0].type;
		  ext = ext.split('/');
		  if(jQuery.inArray(ext[1], ['jpg','jpeg','png']) == -1) {
			  jQuery("#file_error").html("Invalid file type"); 
		  }
		  else
		  {
			  
			   var reader = new FileReader();
			   reader.onload = function (e)
			   {   
				   var image = new Image();
			       
	                //Set the Base64 string return from FileReader as source.
	                image.src = e.target.result;
	                       
	                //Validate the File Height and Width.
	                image.onload = function () {
	                    var height = this.height;
	                    var width = this.width;
	                   // alert(height+''+width);
	                    if (height == 320 && width == 480) {
	                    	jQuery("#mountain_profile_image").attr('src', reader.result);
	     			       jQuery("#mountainprofileImage").val(reader.result);        
	     			       jQuery("#file_error").html("");
	                    }
	                    else
	                    {
	                    	jQuery("#file_error").html("Please upload 480x320 size image"); 
	                    }
	                 }
			   }
		  }
	  }
	  reader.readAsDataURL(file);

}

function editMountain()
{
	
	jQuery("#edit_img").attr("src","public/images/setting_a.png");
	var id=jQuery('#mountain_id option:selected').val();
	clear_form();
	 var data = jQuery.postValues('/api/v1/site/getMountainDetailById',{id:id}); 
	 if(data){
			
 	 	   	jQuery('#name').val(data.name);
	        jQuery('#description').val(data.description);
	         jQuery('#start_date').val(data.utc_start_date);
	        jQuery('#end_date').val(data.utc_end_date);
		    jQuery('#url').val(data.url);
		    jQuery("#hash_tag").val(data.hash_tag);
		    jQuery("#no_of_peaks").val(data.no_of_peaks);
		    jQuery("#mount_peak_duration").val(data.peak_duration);
               var myText = data.zone_id;
               
		    jQuery('#zone_id').val(myText).attr("selected", "selected");
		    jQuery('#window_description').val(data.window_description);
		     jQuery('#zone_id').val(myText);
		    jQuery('h4.modal-title').text('Edit Mountain');
		   
		    if( data.image_path==null ||  data.image_path=='')
		    {
		    	jQuery('#mountain_profile_image').attr('src',baseurl+'/public/images/img-placeholder.jpg'); 
		    	
		    }
        		
         else
         {
         	jQuery('#mountain_profile_image').attr('src',baseurl+'/public/upload/'+data.image_path);
		    	jQuery('#mountain_profile_image').error(function(){
         		//jQuery(this).attr('src',  baseurl+'/images/brok_img_128.png');
             });
		  		
         }
         if(data['is_edit']==1)
         {
         	
         	jQuery("#no_of_peaks").prop('disabled', false);
         	jQuery("#start_date").prop('disabled', false);
         	jQuery("#mount_peak_duration").prop('disabled', false);
         	is_editable=1;
         }
         else
         {
         	jQuery("#no_of_peaks").prop('disabled', true);
         	jQuery("#start_date").prop('disabled', true);
         	jQuery("#mount_peak_duration").prop('disabled', true);
         	is_editable=0;
         }
		    jQuery('#mountainmodal').modal('show');
		    flag='edit'; 
	 }
    
}
function assignJudgesToMountain()
{
	
	 var judgeid = [];
     jQuery.each(jQuery("#judge_id option:selected"), function(){            
     	judgeid.push(jQuery(this).val());
     	judgeid.join(", ");
     });
     var id=jQuery('#mountain_id option:selected').val();
     if(judgeid.length>0){
	     jQuery.ajax({
	         type: 'POST',
	         url: 'api/v1/site/assignJudgeToMountain',
	         data:{mountain_id:id,judge_id:judgeid},
	         dataType:'json',
	         success:function(data)
	         { 
	        	 jQuery('#judge_error').html('');
	        	 jQuery('h4.modal-title').text('ASSIGN JUDGE[s]');
	        	 jQuery('#assignjudgemodal').modal('hide');
	        	 flag='add';
	        	 getIcons('default');
	        	 jQuery('#a_temp_judge.recentlist').remove();
	        	 getJudges();
 getIcons('default');
	         }
	     });
	}
	else
	{
		jQuery('#judge_error').html('Please select atleast one judge');
	}
}

function onCheckSelect()
{
	jQuery('#judge_error').html('');
}
jQuery("#m_edit" ).click(function() {
	flag='edit';
	getIcons('edit')
    editMountain();
    //getIcons('edit');
});
function getIcons(title)
{
	//alert(title);
	 switch (title) {
	     case 'create':
	         jQuery("#m_edit").attr("src","public/images/setting_n.png");
	         jQuery("#m_push").attr("src","public/images/push_n.png");
	         jQuery("#m_judge").attr("src","public/images/assignjudge_n.png");
	         jQuery("#m_history").attr("src","public/images/histroy_n.png");
	         jQuery("#m_create").addClass("breadcrumb-btn_mountain");
	         jQuery("#m_create").removeClass("breadcrumb-btn_mountain_active");
	         break;
	     case 'edit':
	    	 jQuery("#m_edit").attr("src","public/images/setting_a.png");
	         jQuery("#m_push").attr("src","public/images/push_n.png");
	         jQuery("#m_history").attr("src","public/images/histroy_n.png");
	         jQuery("#m_judge").attr("src","public/images/assignjudge_n.png");
	         jQuery("#m_create").removeClass("breadcrumb-btn_mountain");
			 jQuery("#m_create").addClass("breadcrumb-btn_mountain_active");
	         break;
	     case 'push':
	    	 jQuery("#m_edit").attr("src","public/images/setting_n.png");
	         jQuery("#m_push").attr("src","public/images/push_a.png");
	         jQuery("#m_history").attr("src","public/images/histroy_n.png");
	         jQuery("#m_judge").attr("src","public/images/assignjudge_n.png");
	         jQuery("#m_create").removeClass("breadcrumb-btn_mountain");
			 jQuery("#m_create").addClass("breadcrumb-btn_mountain_active");
	         break;
	     case 'judge':
	    	 jQuery("#m_edit").attr("src","public/images/setting_n.png");
	         jQuery("#m_push").attr("src","public/images/push_n.png");
	         jQuery("#m_history").attr("src","public/images/histroy_n.png");
	         jQuery("#m_judge").attr("src","public/images/assignjudge_a.png");
	         jQuery("#m_create").removeClass("breadcrumb-btn_mountain");
			 jQuery("#m_create").addClass("breadcrumb-btn_mountain_active");
	         break;
	     case 'history':
	    	 jQuery("#m_edit").attr("src","public/images/setting_n.png");
	         jQuery("#m_push").attr("src","public/images/push_n.png");
	         jQuery("#m_judge").attr("src","public/images/assignjudge_n.png");
	         jQuery("#m_history").attr("src","public/images/histroy_a.png");
	         jQuery("#m_create").removeClass("breadcrumb-btn_mountain");
			 jQuery("#m_create").addClass("breadcrumb-btn_mountain_active");
	         break;
		case 'default':
			 jQuery("#m_edit").attr("src","public/images/setting_n.png");
		    jQuery("#m_push").attr("src","public/images/push_n.png");
		    jQuery("#m_judge").attr("src","public/images/assignjudge_n.png");
		    jQuery("#m_history").attr("src","public/images/histroy_n.png");
		    jQuery("#m_create").removeClass("breadcrumb-btn_mountain");
		    jQuery("#m_create").addClass("breadcrumb-btn_mountain_active");
		    clearSelectedFeed();
		    break;
	}
}
function getJudgesPopup()
{
	jQuery('h4.modal-title').text('ASSIGN JUDGE[s]');
	jQuery('#assignjudgemodal').modal('show');
	flag='add';
	//getIcons('judge');
	getJudges();

	 
	
}
function getJudges()
{
	var  mountain_id = jQuery('#mountain_id option:selected').val();
	 var country_id=jQuery('#country_id option:selected').val();
jQuery('#judge_error').html('');
	jQuery.ajax({
        type: 'POST',
        url: 'api/v1/site/getJudgeList',
        data:{mountain_id:mountain_id,country_id:country_id,start:'',end:'',type:''},
        dataType:'json',
        success:function(data)
        { 
        	jQuery('#judge_id option').remove();
            if (data.result == false) {
                jQuery("#no-judge").show();
jQuery("#assign_btn").hide();
            }
else
{
jQuery("#no-judge").hide();
jQuery("#assign_btn").show();

}
        	jQuery.each(data.result, function(key, value) {
                   if(value.is_hide == 0)
                    {
        		jQuery('#judge_id')
        	         .append(jQuery("<option></option>")
        	         .attr("value",value.judge_id)
        	         .attr("label","public/upload/"+value.ProfileImage)
        	         .text(value.first_name)); 
                    }
        	});
	       	
	       	jQuery.ajax({
	            type: 'POST',
	            url: 'api/v1/site/getMountainJudges',
	            data:{mountain_id:mountain_id},
	            dataType:'json',
	            success:function(data)
	            { 
	            	jQuery("#a_temp_judge").html('');
	            	jQuery('#judge_id').selectMultiple('destroy');
	            	if(data.result.length>0){
	            		jQuery("#clientTemplate").tmpl(data.result).appendTo("#a_temp_judge");
jQuery("#assign_judge_lbl").show();
jQuery("#assign_judge_container").show();
}
else
{
jQuery("#assign_judge_lbl").hide();
jQuery("#assign_judge_container").hide();
}
	            	onShowAssignedJudges(data.result);
	            	jQuery('#judge_id').selectMultiple({
	           		  selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='Search judges'>",
	           		  afterInit: function(ms){
	           			var that = this,
	           			jQueryselectableSearch = that.$selectableUl.prev(),
	           				selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable';

	           			that.qs1 = jQueryselectableSearch.quicksearch(selectableSearchString)
	           			.on('keydown', function(e){
 if (e.which === 13) {
	           			        return false;
	           			    }
	           			  if (e.which === 40){
	           				that.$selectableUl.focus();
	           				return false;
	           			  }
	           			});
	           		  },
	           		  afterSelect: function(){
	           			this.qs1.cache();
	           		  },
	           		  afterDeselect: function(){
	           			this.qs1.cache();
	           		  }
	            	});
	            	 var $aitem = jQuery('div.assigneditem'), //Cache your DOM selector
	            	    visible = 5, //Set the number of items that will be visible
	            	    index = 0, //Starting index
	            	    endIndex = ( $aitem.length / visible ) - 1; //End index

	            	    jQuery('div#assignedarrowR').click(function(){
	            	    	//alert('hi');
	            	    	if(index < endIndex ){
	            	    	  index++;
	            	    	  $aitem.animate({'left':'-=500px'});
	            	    	}
	            	    });

	            	    jQuery('div#assignedarrowL').click(function(){
	            	    	//alert('hi');
	            	    	if(index > 0){
	            	    	  index--;            
	            	    	  $aitem.animate({'left':'+=500px'});
	            	    	}
	            	    });
	            }
	       	});
        }
    });

}
jQuery( document ).ready(function() {
	mountainvalidation();
pushNotificationvalidation();
	
	jQuery("#mount_peak_duration,#no_of_peaks,#start_date").on("change", function(){
		var noofdays=(jQuery('#no_of_peaks').val() * jQuery('#mount_peak_duration').val());
if(noofdays==1 || noofdays==0)
      noofdays=noofdays;
else
  noofdays=noofdays;
        var str = jQuery("#start_date").val();
        str = str.split(' ');
var date = new Date(str[0]);
           days = parseInt(noofdays, 10);
      //alert(date.getTime());
        if(!isNaN(date.getTime())){
            date.setDate(date.getDate() + days);
            jQuery("#end_date").val(date.toInputFormat()+' '+str[1]);
        } else {
            //alert("Invalid Date");  
        }
        is_editable=1;
   });
	    
    Date.prototype.toInputFormat = function() {
       var yyyy = this.getFullYear().toString();
       var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
       var dd  = this.getDate().toString();
       return  yyyy + "-" +(mm[1]?mm:"0"+mm[0]) + "-" + (dd[1]?dd:"0"+dd[0])  ; // padding
    };
	    
    getIcons('default');  
     jQuery('#start_date').datetimepicker({
    	mask:'9999/19/39 29:59',
    		format:'Y-m-d H:i',
    		minDate:'-1970/01/02 29:59', // yesterday is minimum date
    		//maxDate:'+1970/01/02'
    });
   
 
     
});
jQuery("#mount_peak_duration,#no_of_peaks").keypress(function (e) {
    //if the letter is not digit then display error and don't type anything
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
       
              return false;
   }

  });
function selectmountain(obj) {
	
    if (jQuery(obj).hasClass("selected-border")) {
        jQuery(obj).removeClass("selected-border");
        jQuery(obj).find("div.mountaintickmark").css("display", "none");
        var aIndex = selectedFeedArr.indexOf(jQuery(obj).attr("id"));
        selectedFeedArr.splice(aIndex, 1);
    } else {
        jQuery(obj).addClass("selected-border");
        jQuery(obj).find("div.mountaintickmark").css("display", "block");
        selectedFeedArr.push(jQuery(obj).attr("id"));
    }
    if(selectedFeedArr.length>0)
    	 jQuery("#m_push").attr("src","public/images/push_a.png");
    else
    	jQuery("#m_push").attr("src","public/images/push_n.png");
}
function clearSelectedFeed(){
	jQuery('.mountain_list ul').removeClass("selected-border");
	jQuery('.mountain_list ul').find("div span span div.mountaintickmark").css("display", "none");
	selectedFeedArr.length = 0;
}

function deleteJudge(id)
{
 confirmBox('Delete Judge',"Are you sure want to delete judge?",'Cancel','Delete');
 confirmModal.modal('show');
 var mountain_id=jQuery('#mountain_id option:selected').val();
 confirmModal.find('#okButton').on('click',function(event)
 {
       jQuery.ajax({
             type: 'POST',
             url: 'api/v1/site/deleteMountainJudge',
             data:{mountain_id:mountain_id,judge_id:id} ,
             dataType:'json',
             success:function(data){  
                 confirmModal.modal('hide');
                 getJudges();
                 
             }                          
         }); 
  }); 
}


function onShowAssignedJudges(data)
{
	//alert('js'+data);
	jQuery("#recentjudge").html('');
	
	if(data)
	{
//alert('js'+data);
		jQuery("#judgeTemplate").tmpl(data).appendTo("#recentjudge");
		jQuery('#recentjudge').flexisel({
	        clone:false
	    });
		jQuery('.flexiselInner').remove();
	}
        else{
//alert('js1'+data);

jQuery('.flexiselInner').remove();
jQuery("#recentjudge").html('');
}
	
}
var pageNumber = 2; 
var peakid;
var show_flag=false;
function ShowPost() { 
	var mountain_id=jQuery('#mountain_id option:selected').val();
     var country_id= jQuery('#country_id option:selected').val();
     var peak_id = peakid;// jQuery("peak_id").attr('code');
    var  start =pageNumber;
    var end = '';
    var search_tag=jQuery("#feedSearchString").val();
    show_flag=true;
   var response = jQuery.postValues('/api/v1/device/getMountainListById',{mountain_id:mountain_id,country_id:country_id,peak_id:peak_id,start:start,end:end,search_tag:search_tag}); 
		if(!response){
			//jQuery("#show_more").text('No more Posts to show').css({"cursor":"pointer"});
jQuery("#show_more img ").attr("src","public/images/nomorefeeds.png").css({"cursor":"pointer"});
		}
		else
		{
			jQuery("#mountainTemplate").tmpl(response).appendTo("#products");
			onChangeList();
jQuery("#show_more img ").attr("src","public/images/morefeeds.png").css({"cursor":"pointer"});
	   		//jQuery("#show_more").text('Show More');
	   		
		}
		
}
function onChangeList()
{
	
	if(view_flag=='list')
	{
		 jQuery('#listview').addClass("active");
            jQuery("#gridview").removeClass("active");
            jQuery("#gridview").attr("src","public/images/title_n.png");
            jQuery("#listview").attr("src","public/images/list_a.png");
            jQuery('#products .item').addClass('list-group-item');
            jQuery('#products .item').removeClass('grid-group-item');
            jQuery('li div.content_wrap').removeClass('grid_video_wrapper');
            jQuery('li div.content_wrap').addClass('list_video_wrapper');
            jQuery('li div.video_overlay').removeClass('grid_description');
            jQuery('li div.video_overlay').addClass('list_description');
            
            jQuery('li div img.content_view ').addClass('list-group-item_view_icon');
            jQuery('li div img.content_view ').removeClass('grid-group-item_view_icon');
            jQuery('li div img.content_like ').addClass('list-group-item_img_icon');
            jQuery('li div img.content_like ').removeClass('grid-group-item_img_icon');
            jQuery('li div.content_rank ').addClass('list-group-item_rank');
            jQuery('li div.content_rank ').removeClass('grid-group-item_rank');
            jQuery("html, body").animate({ scrollTop: 2300 });
	}
	else
	{
		jQuery('#products .item').removeClass('list-group-item');
        jQuery('#products .item').addClass('grid-group-item');
        jQuery('#listview').addClass("active");
        jQuery("#listview").removeClass("active");
        jQuery("#listview").attr("src","public/images/list_n.png");
        jQuery("#gridview").attr("src","public/images/title_a.png");
        jQuery('li div.video_overlay').addClass('grid_description');
        jQuery('li div.video_overlay').removeClass('list_description');                    
        jQuery('li div.content_wrap').addClass('grid_video_wrapper');
        jQuery('li div.content_wrap').removeClass('list_video_wrapper');
        jQuery('li div img.content_view ').removeClass('list-group-item_view_icon');
        jQuery('li div img.content_view ').addClass('grid-group-item_view_icon');
        jQuery('li div img.content_like ').removeClass('list-group-item_img_icon');
        jQuery('li div img.content_like ').addClass('grid-group-item_img_icon');
        jQuery('li div.content_rank ').removeClass('list-group-item_rank');
        jQuery('li div.content_rank ').addClass('grid-group-item_rank');
        jQuery("html, body").animate({ scrollTop: 1000 });
	}

}

function showDeleteMountainPopup(title, flag, selector, clear_form, paramvalue) {
    if (clear_form)

        window[clear_form]();

    jQuery('h4.modal-title').text(title);

    jQuery('#deletemountid').val(paramvalue);
    
    jQuery('#' + selector).modal('show');



}
