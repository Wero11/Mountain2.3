var listingVue = new Vue({

    el: '#mountain',

    data: {
        formVariables: {
            country_id: '',
            mountain_id: '',
            peak_id: '',
            judge_id: '',
            startData: '0',
            endData: '10',
            duration: '',
            mountain_name: '',
            url: '',
            country_code: 'au',
            time_zones: '',
            notificationid: '0',
        },
        pagination: {
            page: 1,
            previous: false,
            next: false          
        },
        countrylist: [],
        mountainlist: [],
        mainMountain: [],
        commercialMountain: [],
        peaklist: [],
        feedlist: [],
        judgelist: [],
        mountainjudgelist: [],
        zonelist: [],
  professionlist: [],
        userlist: [],
 historylist:[],
        rolesettings: {
            'role_id': 0,
            'MUTN': 1,
            'ADV_MUTN': 1,
            'ADV_MUTN_LIST': "0",
            'FAM_MUNT': 1,
            'FAM_MUTN_LIST': "0",
            'CRE_MUTN': 1,
            'EDT_MUTN': 1,
            'SER_MUTN': 1,
            'PUS_NOFY': 1,
            'ASN_JUG': 1,
            'ALL_MUTN':1,
            'JUG': 0,
            'CRE_JUG': 0,
            'EDT_JUG': 0,
            'DEL_JUG': 0,
            'HIDE_JUG': 0,
            'SER_JUG': 0,
            'ASN_MUTN': 0,
            'USR': 0,
            'CRE_USR': 0,
            'BLK_USR': 0,
            'SER_USR': 0,
            'NOFY': 0,
            'VIEW_NOFY': 0,
            'DEL_FEED': 0,
            'BLK_NOTIFY_USR': 0,
            'DEL_NOFY': 0,
            'SER_NOFY': 0,
        }


    },
    ready: function () {
        this.getCountry();

        var value = window.location.href.substring(window.location.href.lastIndexOf('/') + 1);
        this.formVariables.$set('url', value);

    },
    methods: {
        getCountry: function () {
            this.$http.get(baseurl + '/api/v1/device/getCountry', function (response) {
                this.$set('countrylist', response.result);
                if (this.formVariables.url == 'managemountain' || this.formVariables.url == 'managemountain#') {
                    this.getMountain(this.formVariables.country_id, 'load');
                    jQuery("#countryHeader").show();
                    jQuery("#country_header_row").removeAttr("style");
                    
                }
                if (this.formVariables.url == 'managejudge' || this.formVariables.url == 'managejudge#') {
                    this.getJudges(this.formVariables.country_id, 'load');
                    jQuery("#countryHeader").show();
                    jQuery("#country_header_row").removeAttr("style");
jQuery('#country_id').append(new Option('ALL', 0));
this.getProfessionDetail();

                }
                this.getNotificationList();
                if (this.formVariables.url == 'rolesettings'){
                    this.getRoleListing();
                }
                if (this.formVariables.url == 'manageuser' || this.formVariables.url == 'manageuser#')
                    this.getUserList(this.formVariables.country_id);
                this.formVariables.$set('country_code', jQuery('#hidn_country_code').val());
this.getProfessionDetail();
            });
        },
        paginate: function(direction) {
            if (direction === 'previous') {
                --this.pagination.page;
            }
            else if (direction === 'next') {
                ++this.pagination.page;
            }
            if (this.formVariables.url == 'managemountain' || this.formVariables.url == 'managemountain#') {
            	this.getAdminCurrentMountain(this.formVariables.country_id,this.pagination.page);
            }
            if (this.formVariables.url == 'managejudge' || this.formVariables.url == 'managejudge#') {
            	
            	this.getJudges(this.formVariables.country_id, 'load');
            	
            }
            if (this.formVariables.url == 'manageuser' || this.formVariables.url == 'manageuser#'){
            	
            	this.getUserList(this.formVariables.country_id,this.pagination.page);
            }
            
           
        },
        getMountain: function (country_id,flag) {
//alert(localStorage.getItem("country")+'=='+localStorage.getItem("selectedindex"));
           if(flag!='load'){
                	localStorage.setItem("selectedindex", jQuery('#country_id option:selected').val());
                	localStorage.setItem("flag", jQuery('#country_id option:selected').attr("code"));
                }
                
               // alert(jQuery('#hidn_country_id').val());
                if (localStorage.getItem("country") != null && localStorage.getItem("country") != 'undefined')
                {
               	 		if(localStorage.getItem("selectedindex") != localStorage.getItem("country") && localStorage.getItem("selectedindex") != null)
               	 		{
               	 				this.formVariables.$set('country_id', localStorage.getItem("selectedindex"));
               	 		}
               	 		else{
               	 			this.formVariables.$set('country_id', localStorage.getItem("country"));
               	 			
               	 		}
                }
                else{

                	if(localStorage.getItem("selectedindex")==null)
                	{
                		this.formVariables.$set('country_id', jQuery('#hidn_country_id').val());
    	       	 	    localStorage.setItem("country", jQuery('#hidn_country_id').val());
    	       	 	    localStorage.setItem("flag",jQuery('#hidn_country_code').val());
                	}
                	else{
                		this.formVariables.$set('country_id', localStorage.getItem("selectedindex"));
	       	 	    	localStorage.setItem("country", localStorage.getItem("selectedindex"));
                	}
                }
               
                
            var option = localStorage.getItem("flag");
            var role_id_user = jQuery("#hdn_role_id").val();
            var postData = { country_id: this.formVariables.country_id, role_id: role_id_user };
            this.$http.post(baseurl + '/api/v1/site/getMountain', postData, function (response) {
console.log(response.result);
               this.$set('mountainlist', response.result); 
            }).success(function (response) {
console.log(response.result);
                if(response.result.fame.length >0 || response.result.advertise.length>0){

                        if(response.result.fame.length>0){
            		    this.formVariables.$set('mountain_id', response.result.fame[0].id);
this.formVariables.$set('mountain_name', response.result.fame[0].name);
}
                        else{
                               if(response.result.advertise.length>0){
                                      this.formVariables.$set('mountain_id', response.result.advertise[0].id);
this.formVariables.$set('mountain_name', response.result.advertise[0].name); 
}
                        }
            		this.getMountainPeak(this.formVariables.mountain_id);
            		this.getAssignedJudgeList();

            	}
            	 else {
                     this.formVariables.$set('mountain_name', '');
this.formVariables.$set('mountain_id', '');
this.formVariables.$set('peak_id', '');
                  
                    this.formVariables.$set('duration', '');
this.$set('peaklist', '');
this.$set('feedlist', '');
                     jQuery(".norecord").remove();
                     jQuery("#mountain_list")
                 .append('<div style="text-align:center" class="norecord"><h3>No Records Found</h3></div>');
                     jQuery('#show_more').hide();
jQuery("#recentjudge").html('');
jQuery('#assign_lbl').hide();
                 }

               
                
            });
this.$set('historylist', '');
jQuery('.mountain_child_list').removeClass('mount_invisible');
jQuery('.history_list').addClass('mount_invisible');
this.getTimeZoneByCountry();
 jQuery("#dvFlag").attr('class', option);
 getIcons('default');
        },
 getAdminCurrentMountain: function (country_id,page) {

           
             var role_id_user = jQuery("#hdn_role_id").val();
             if(page == undefined){
          	   var spage=1; 
             }
             else
          	{
          	   var spage=page;
          	 }
             var postData = { country_id: this.formVariables.country_id, role_id: role_id_user, start: spage,
                     end: '', };
             this.$http.post(baseurl + '/api/v1/site/getAdminCurrentMountain', postData, function (response) {
             }).success(function (response) {
            	 jQuery(".norecord").remove();
            	 
             	this.$set('historylist', response.result);
            	 jQuery('.history_list').removeClass('mount_invisible');
             	jQuery('.mountain_child_list').addClass('mount_invisible');
               	   jQuery("#recentjudge").html('');
                   jQuery('#assign_lbl').hide();
             	if(response.result){
                  	//alert(response.result.length);
                  	 onShowAssignedJudges();
                  	  if(response.result.length<10){
                  		 this.pagination.next=false;  
                  		
                  	  }
                       else{
                     	  this.pagination.next=true;
                       }
                  	 jQuery('#show_more').hide();
                 
             	}
             	 else {
                      jQuery(".norecord").remove();
                      jQuery("#mountain_list")
                  .append('<div style="text-align:center" class="norecord"><h3>No Records Found</h3></div>');
                      jQuery('#show_more').hide();
this.pagination.next=false;
                  }
                
                
             });
             getIcons('history');
         },
        getMountainPeak: function (mountain_id) {
        	this.pagination.page=1;
            this.formVariables.$set('mountain_id', mountain_id);
            var postData = { mountain_id: this.formVariables.mountain_id };
            this.$http.post(baseurl + '/api/v1/site/getMountainPeak', postData, function (response) {
                this.$set('peaklist', response.result);
            }).success(function (response) {
                if (response.result) {
                   
                    this.formVariables.$set('peak_id', response.result[0].id);
                    peakid = response.result[0].id;
                   
                    var colCount = response.result.length;

                    this.getMountainListById(this.formVariables.peak_id,response.result[0].is_finished,response.result[0].Duration);
                   
                }
                else {
                    jQuery(".norecord").remove();
                    jQuery("#mountain_list")
                .append('<div style="text-align:center" class="norecord"><h3>No Records Found</h3></div>');
                    jQuery('#show_more').hide();
                }
                this.formVariables.$set('mountain_name', jQuery('#mountain_id option:selected').text());
            });
        },
        getMountainListById: function (peak_id,is_start,duration) {
            var searchtag = '';
            if (jQuery('#feedSearchString').val() == undefined) {
                searchtag = '';
            } else {
                searchtag = jQuery('#feedSearchString').val();
            }
            this.formVariables.$set('peak_id', peak_id);
            peakid = peak_id;
            jQuery(".norecord").remove();
            if(is_start==1){
                this.formVariables.$set('duration', 'Completed');
jQuery('#bar_load').css('width','100%');
}
              else if(is_start==2){
              	this.formVariables.$set('duration','Yet to start');
jQuery('#bar_load').css('width','0%');
}
              else{
              	this.formVariables.$set('duration',duration+' left');
jQuery('#bar_load').css('width','40%');
}
            var postData = {
                mountain_id: this.formVariables.mountain_id,
                country_id: this.formVariables.country_id,
                peak_id: this.formVariables.peak_id,
                start: this.formVariables.startData,
                end: this.formVariables.endData,
                search_tag: searchtag,
            };
            if (show_flag == true) {
                jQuery("#products").html('');
                pageNumber = 2;
            }
  jQuery('.nav li').removeClass('active');
            jQuery('.nav #'+peak_id).addClass('active');
            jQuery("html, body").animate({ scrollTop: 0 });
            this.$http.post(baseurl + '/api/v1/device/getMountainListById', postData, function (response) {
jQuery('.history_list').addClass('mount_invisible');
            	jQuery('.mountain_child_list').removeClass('mount_invisible');
                this.$set('feedlist', response.result);
//alert(response.result.length);
                if (response.result) {
                    if (show_flag == true)
                        jQuery("#mountainTemplate").tmpl(response.result).appendTo("#products");
                   if(response.result.length>=10){
                    	jQuery('#show_more').show();
                    	//jQuery("#show_more img ").attr("src","public/images/morefeeds.png").css({"cursor":"pointer"});
                    }
else
{
jQuery('#show_more').hide();
}

                }
                else {
                    jQuery(".norecord").remove();
                    jQuery("#mountain_list")
                       .append('<div style="text-align:center" class="norecord"><h3>No Records Found</h3></div>');
                    jQuery('#show_more').hide();

                }
            }).success(function (response) {

                this.getAssignedJudgeList();
            });
            getIcons('default');

        },
        getAssignedJudgeList: function (mount_id) {
//alert(this.formVariables.mountain_id);
            var postData = {
                mountain_id: this.formVariables.mountain_id ,
            };
            this.$http.post(baseurl + '/api/v1/site/getMountainJudges', postData, function (response) {
                this.$set('assignedjudgelist', response.result);
               
jQuery("#recentjudge").html('');
jQuery('#assign_lbl').hide();
              if(response.result){
                 if(response.result.length>0){
//alert(response.result.length);
jQuery('#assign_lbl').show();
                     onShowAssignedJudges(response.result);}
                 else{
//alert('else');
jQuery('#assign_lbl').hide();
                     onShowAssignedJudges('');}
}
              else{
 //alert(response.result);

                  jQuery('.flexiselInner').remove();}
            });
        },

        getJudges: function (country_id,flag) {

//alert(jshow_flag);
           if(flag!='load'){
        		if(jQuery('#country_id option:selected').val()==0)
   	   		{
   	   		
   	   		}
   	   		else
   	   		{
   	   		
   	   			localStorage.setItem("selectedindex", jQuery('#country_id option:selected').val());
   	   			localStorage.setItem("flag", jQuery('#country_id option:selected').attr("code"));
   	   		}
        	}
        	
            if (localStorage.getItem("country") != null && localStorage.getItem("country") != 'undefined')
            {
           	 		if(localStorage.getItem("selectedindex") != localStorage.getItem("country"))
           	 		{
           	 			if(localStorage.getItem("selectedindex")==null ){
           	 				this.formVariables.$set('country_id', jQuery('#hidn_country_id').val());
           	 			}
           	 			else{
           	 				this.formVariables.$set('country_id', localStorage.getItem("selectedindex"));
           	 			}
           	 		}
           	 		else{
           	 			this.formVariables.$set('country_id', localStorage.getItem("country"));
           	 		}
            }
            else{
            		this.formVariables.$set('country_id', localStorage.getItem("selectedindex"));
            		localStorage.setItem("country", localStorage.getItem("selectedindex"));
            }
           
            var option = localStorage.getItem("flag");
            this.formVariables.$set('country_code', option);
            jQuery(".norecord").remove();
            if(flag == 'change' || flag == undefined){
            	this.pagination.page=1 
              }
               if(jQuery('#country_id option:selected').val()==0)
            	{
            	 this.formVariables.$set('country_id', '');
                     var option = 'xx';
                     jQuery("#dvFlag").attr('class', option);
 jQuery("#dvFlag").hide();
            	}
                else
                {
                   var option = localStorage.getItem("flag");
                    jQuery("#dvFlag").attr('class', option);
jQuery("#dvFlag").show();
               }
            var postData = {
                country_id: this.formVariables.country_id,
                mountain_id: jQuery('#mountain_id option:selected').val(),
                search: jQuery('#search_judge').val(),
                type: jQuery('#judge_type option:selected').val(),
                start: this.pagination.page,
                end: '',
            };

            this.$http.post(baseurl + '/api/v1/site/getJudgeList', postData, function (response) {
                this.$set('judgelist', response.result);
            }).success(function (response) {
                this.getMoutainList(this.formVariables.country_id);
                
                //jQuery("#judgedvFlag").attr('class',option);

                if (response.result) {
                   jQuery(".norecord").remove();
		   	if(response.result.length<10){
                 		 this.pagination.next=false;  
                 		
                 	  }
                      else{
                    	  this.pagination.next=true;
                      }
                }
                else {
                    jQuery(".norecord").remove();
                    jQuery("#mountain_list")
                       .append('<div style="text-align:center" class="norecord"><h3>No Records Found</h3></div>');
this.pagination.next=false;
                   

                }
            });

        },
        getMoutainList: function (country_id) {
            this.formVariables.$set('country_id', country_id);
            var mount_role_id = jQuery("#hdn_mount_role").val();
            var postData = {
                country_id: this.formVariables.country_id,
                mountain_id: jQuery('#mountain_id option:selected').val(),
                mount_role_id: mount_role_id,
            };
            this.$http.post(baseurl + '/api/v1/site/getMountains', postData, function (response) {
                this.$set('mainMountain', response.result.main);
                this.$set('commercialMountain', response.result.commercial);
            });
        },
        getMountainJudges: function () {
            var mountain_id = jQuery('#mountain_id option:selected').val();
            this.formVariables.$set('mountain_id', mountain_id);
            var postData = {
                mountain_id: this.formVariables.mountain_id
            };

            this.$http.post(baseurl + '/api/v1/device/getMountainJudges', postData, function (response) {
                this.$set('mountainjudgelist', response.result);
            });
        },
        saveJudge: function (country_id) {
            this.formVariables.$set('country_id', country_id);
            if (jQuery("#add_judge").valid()) {
                var postData = {
                    first_name: jQuery("#first_name").val(),
                    family_name: jQuery("#family_name").val(),
                    user_name: jQuery("#user_name").val(),
                    password: jQuery("#password").val(),
                    profession: jQuery('#profession option:selected').val(),
                    country: jQuery('#country_id option:selected').val(),
                    ProfileImage: jQuery("#judgeprofileImage").val(),
                    website: jQuery("#website").val(),
                    email: jQuery("#email").val(),
                    tags: jQuery("#tags").val(),
                    description: jQuery("#description").val(),
                    user_type: 'judge',
                    judge_type: jQuery('#mountain_judge_type option:selected').val(),
                };
                this.$http.post(baseurl + '/api/v1/device/register', postData, function (response) {
                    this.$set('judgelist', response.result);
                    if (response.code == 8)
                        jQuery("#judge_error").html(response.message);
                    else
                        jQuery('#judgemodal').modal('hide');
                    this.getJudges(this.formVariables.country_id);
                });

            }
        },
        updateJudge: function (country_id) {
            this.formVariables.$set('country_id', country_id);
            if (jQuery("#add_judge").valid()) {
                var postData = {
                    first_name: jQuery("#first_name").val(),
                    family_name: jQuery("#family_name").val(),
                    id: jQuery("#judge_id").val(),
                    profession: jQuery('#profession option:selected').val(),
                    country: jQuery('#country_id option:selected').val(),
                    ProfileImage: jQuery("#judgeprofileImage").val(),
                    website: jQuery("#website").val(),
                    email: jQuery("#email").val(),
                    tags: jQuery("#tags").val(),
                    description: jQuery("#description").val(),
                    judge_type: jQuery('#mountain_judge_type option:selected').val(),
                };

                this.$http.post(baseurl + '/api/v1/device/updateJudgeProfile', postData, function (response) {
                    this.$set('judgelist', response.result);
                    jQuery('#judgemodal').modal('hide');
                    this.getJudges(this.formVariables.country_id);
                });

            }
        },
        unhideJudge: function (judge_id) {
        	
            unhide_judge_id = jQuery("#unhide_judge_id").val();
            var postData = { judge_id: unhide_judge_id };
            this.$http.post(baseurl + '/api/v1/site/unhideJudge', postData, function (response) {
                this.$set('judgelist', response.result);
                jQuery('#unhidejudgemodal').modal('hide');
                this.getJudges(this.formVariables.country_id);
                selectedJudgeArr.length = 0;

            });
        },
        assignMountain: function () {
        	
            var postData = { judge_id: selectedJudgeArr, mountain_id: jQuery('#mountain_id').val() };
            this.$http.post(baseurl + '/api/v1/site/assignJudgeToMountain', postData, function (response) {
                jQuery('#assignmountainmodal').modal('hide');
this.getJudges(this.formVariables.country_id);
                clearMountain();
                clearSelectJudge();
            });
        },
        deleteJudge: function (country_id) {
        	
            this.formVariables.$set('country_id', country_id);
            var postData = { judge_id: selectedJudgeArr };
            this.$http.post(baseurl + '/api/v1/site/deleteJudge', postData, function (response) {
                jQuery('#deletejudgemodal').modal('hide');
                clearSelectJudge();
                this.getJudges(this.formVariables.country_id);
                this.getUserList(this.formVariables.country_id);
 jQuery('h4.popup-title').text('DELETE USER(S)');
                jQuery('#popup-content').text('User Deleted Successfully.');
                jQuery('#notifycommonalertmodal').modal('show');

            });
        },
        hideJudge: function (country_id) {
        	
            this.formVariables.$set('country_id', country_id);
            var postData = { judge_id: selectedJudgeArr };
            this.$http.post(baseurl + '/api/v1/site/hideJudge', postData, function (response) {
                jQuery('#hidejudgemodal').modal('hide');
                clearSelectJudge();
                this.getJudges(this.formVariables.country_id);
            });
        },
        deleteAssignedJudge: function (id) {
            //alert('kk');
        	
        	confirmBox('Delete', "Are you sure want to delete?", 'Cancel', 'Delete');
            confirmModal.modal('show');
            confirmModal.find('#okButton').on('click', function (event) {
                var mountain_id = jQuery('#mountain_id option:selected').val();
                var postData = { mountain_id: mountain_id, judge_id: id };
                this.$http.post(baseurl + '/api/v1/site/deleteMountainJudge', postData, function (response) {
                    confirmModal.modal('hide');
                    getAssignedJudgeList();

                });
            });
        },
        pushNotification: function () {
            //alert(jQuery('#push_description').val());
            //alert(selectedFeedArr.toString());
            if (jQuery("#push_notification").valid()) {
                var postData = { feed_id: selectedFeedArr, push_description: jQuery('#push_description').val() };
                //jQuery('#pushpopupmodal').modal('hide');
                this.$http.post(baseurl + '/api/v1/site/pushNotificationforMountain', postData, function (response) {
                    jQuery('#pushpopupmodal').modal('hide');

                });
            } else {
                return false;
            }
        },
        getTimeZoneByCountry: function () {
            var postData = { country_id: this.formVariables.country_id };
            this.$http.post(baseurl + '/api/v1/site/getTimeZoneBycountry', postData, function (response) {
                this.$set('zonelist', response.result);
            });
        },
         getNotificationList: function () {
            var notify_filter = jQuery("#notify_filter").val();
            var search_userkeyword = jQuery("#searchuserkeyword").val();
            //alert(search_userkeyword);
           // alert(notify_filter);
            if ((search_userkeyword == undefined || search_userkeyword == '') && (notify_filter == "" || notify_filter == undefined)) {
                var postData = { searchuserkeyword: '',notify_filter: '' };
            } else if (search_userkeyword != "" && notify_filter != "") {
                var postData = { searchuserkeyword: search_userkeyword, notify_filter: notify_filter };
            } else if ((search_userkeyword == undefined || search_userkeyword == '') && notify_filter != "") {
                var postData = { searchuserkeyword: '', notify_filter: notify_filter };
            }else if (search_userkeyword != "" && notify_filter == "") {
                var postData = { searchuserkeyword: search_userkeyword, notify_filter: '' };
            }
            this.$http.post(baseurl + '/api/v1/site/getNotificationList', postData, function (response) {
                this.$set('notificationlist', response.result);
if(response.result.length>0)
var length = response.result.length;
else
var length = 0;

                jQuery("#notification_menu").append("<span class='menunotificationcount'>" + length + "</span>");
                //jQuery("#notification_menu").append("<span class='menunotificationcount'>" + (response.result).length + "</span>");
            });
        },
        UserDetailPopupforBlock: function (userid) {
            var postData = { user_id: userid };
            this.$http.post(baseurl + '/api/v1/device/getUserProfile', postData, function (response) {
                this.$set('userdetails', response.result);
                this.UserMountainListforBlock(userid)
            });


        },
        UserMountainListforBlock: function (userid) {
            var postData = { user_id: userid, start: 0, end: 100 };
            this.$http.post(baseurl + '/api/v1/site/getUserFeedsWithAbused', postData, function (response) {
                this.$set('userfeedlist', response.result);
            });
            jQuery('h4.modal-title').text('USER DETAILS');
            jQuery('#userdetailblockmodal').modal('show');
        },
        blockUser: function () {

            if (jQuery("#frmblcokuser").valid()) {
                var notify_filter = jQuery("#notify_filter").val();
                var search_userkeyword = jQuery("#searchuserkeyword").val();
                if ((search_userkeyword == undefined || search_userkeyword == '') && (notify_filter == "" || notify_filter == undefined)) {
                    var searchuserkeyword = search_userkeyword;
                    var notify_filter = notify_filter;
                } else if (search_userkeyword != "" && notify_filter != "") {
                    var searchuserkeyword = search_userkeyword;
                    var notify_filter = notify_filter;
                } else if ((search_userkeyword == undefined || search_userkeyword == '') && notify_filter != "") {
                    var searchuserkeyword = '';
                    var notify_filter = notify_filter;
                } else if (search_userkeyword != "" && notify_filter == "") {
                    var searchuserkeyword = search_userkeyword;
                    var notify_filter = '';
                }

                var postData = {
                    blocktypes: jQuery("input[name='blocktypes']:checked").val(),
                    daterange: jQuery("#daterange").val(),
                    description: jQuery("#description").val(),
                    adminnote: jQuery("#adminnote").val(),
                    user_id: jQuery("#user_id").val(),
                    notificid: jQuery("#notific_id").val(),
                    searchuserkeyword: searchuserkeyword,
                    notify_filter: notify_filter,
                };
                this.$http.post(baseurl + '/api/v1/site/blockUser', postData, function (response) {
                    this.$set('notificationlist', response);
                     jQuery('#blcokusermodal').modal('hide');
                    jQuery('h4.popup-title').text('BLOCK USER');
                    jQuery('#popup-content').text('User Blocked Successfully.');
                    jQuery('#notifycommonalertmodal').modal('show');
                });

            } else {
                return false;
            }

        },
         unblocknotifyuser: function () {
            user_id = jQuery("#unblockuserid").val();
            var notify_filter = jQuery("#notify_filter").val();
            var search_userkeyword = jQuery("#searchuserkeyword").val();
            if ((search_userkeyword == undefined || search_userkeyword == '') && (notify_filter == "" || notify_filter == undefined)) {
                var searchuserkeyword = search_userkeyword;
                var notify_filter = notify_filter;
            } else if (search_userkeyword != "" && notify_filter != "") {
                var searchuserkeyword = search_userkeyword;
                var notify_filter = notify_filter;
            } else if ((search_userkeyword == undefined || search_userkeyword == '') && notify_filter != "") {
                var searchuserkeyword = '';
                var notify_filter = notify_filter;
            } else if (search_userkeyword != "" && notify_filter == "") {
                var searchuserkeyword = search_userkeyword;
                var notify_filter = '';
            }
            var postData = { userid: user_id, searchuserkeyword: search_userkeyword, notify_filter: notify_filter, };
            this.$http.post(baseurl + '/api/v1/site/unblocknotifyuser', postData, function (response) {
                this.$set('notificationlist', response.result);
                jQuery('#userunblocknotificationmodal').modal('hide');
                jQuery('h4.popup-title').text('UNBLOCK USER');
                jQuery('#popup-content').text('User Activated Successfully.');
                jQuery('#notifycommonalertmodal').modal('show');
            });
        },
        blockUserFeed: function () {

            delete_feedid = jQuery("#deletefeedid").val();
            var postData = { feed_id: delete_feedid };
            this.$http.post(baseurl + '/api/v1/site/makefeedinactive', postData, function (response) {
                this.$set('userfeedlist', response.result);
                jQuery('#deletenotificationmodal').modal('hide');
                jQuery('h4.popup-title').text('DELETE FEED');
                jQuery('#popup-content').text('Feed Deleted Successfully.');
                jQuery('#notifycommonalertmodal').modal('show');
                 if (this.formVariables.url == 'managemountain' || this.formVariables.url == 'managemountain#') {
                   this.getMountain(this.formVariables.country_id);
                  }
            });

        },
        deleteNotification: function () {
            note_id = jQuery("#notificationid").val();
            var notify_filter = jQuery("#notify_filter").val();
            var search_userkeyword = jQuery("#searchuserkeyword").val();
            if ((search_userkeyword == undefined || search_userkeyword == '') && (notify_filter == "" || notify_filter == undefined)) {
                var searchuserkeyword = search_userkeyword;
                var notify_filter = notify_filter;
            } else if (search_userkeyword != "" && notify_filter != "") {
                var searchuserkeyword = search_userkeyword;
                var notify_filter = notify_filter;
            } else if ((search_userkeyword == undefined || search_userkeyword == '') && notify_filter != "") {
                var searchuserkeyword = '';
                var notify_filter = notify_filter;
            } else if (search_userkeyword != "" && notify_filter == "") {
                var searchuserkeyword = search_userkeyword;
                var notify_filter = '';
            }
            var postData = { noteid: note_id, searchuserkeyword: search_userkeyword, notify_filter: notify_filter, };
            this.$http.post(baseurl + '/api/v1/site/deleteNotification', postData, function (response) {
                this.$set('notificationlist', response.result);
                jQuery('#deletefeedmodal').modal('hide');
                jQuery('h4.popup-title').text('DELETE NOTIFICATION');
                jQuery('#popup-content').text('Notification Deleted Successfully.');
                jQuery('#notifycommonalertmodal').modal('show');
                jQuery("#notification_menu").append("<span class='menunotificationcount'>" + (response.result).length + "</span>");
            });
        },
       createrole: function () {

            if (jQuery("#add_role").valid()) {
                var postData = {
                    rolename: jQuery("#rolename").val(),
                    description: jQuery("#description").val(),

                };
                this.$http.post(baseurl + '/api/v1/site/createrole', postData, function (response) {
                    if (response.code==12) {
                        jQuery('#roleduplicate').show();
                        jQuery('#rolename').val('');
                        jQuery('#description').val('');
                    }else{
                        this.$set('rolelisting', response);
                        jQuery('#rolemodal').modal('hide');
                        jQuery('h4.role-settings-title').text('Create Role');
                        jQuery('#saverolesettingsmodal').modal('show');
                    }
                });

            } else {
                return false;
            }

        },
        cancelrole: function () {
            jQuery('#btn-create-role').removeClass("breadcrumb_btn_role");
        },

        getRoleListing: function () {
            this.$http.post(baseurl + '/api/v1/site/getRoleList', function (response) {
                this.$set('rolelisting', response.result);
                 this.formVariables.$set('country_id', localStorage.getItem("selectedindex"));
                jQuery("#dvFlag").attr('class', localStorage.getItem("flag"));
            });
        },


        getRoleSettings: function (roleid) {
            this.getRoleDetails(roleid);
           
        },
        enablesectionforrolesettings: function (role_id, activeflag) {
            if (role_id && activeflag == 1) {
                return true;
            } else {
                return false;
            }
        },
        setmngmountaintoggle: function () {
            if (this.rolesettings.ADV_MUTN == 0 && this.rolesettings.FAM_MUNT == 0 && this.rolesettings.CRE_MUTN == 0 && 
             this.rolesettings.EDT_MUTN == 0 && this.rolesettings.SER_MUTN == 0 && this.rolesettings.PUS_NOFY == 0 && this.rolesettings.ASN_JUG == 0 && this.rolesettings.ALL_MUTN == 0) {
                this.$set('rolesettings.MUTN', 0);
            } 
        },
        disableadvmountain: function (val, element) {
            
            if (val == 1) {
                this.$set('rolesettings.ADV_MUTN_LIST', '0');
                jQuery('#advmountaincontainer').show();
            }
            if (val == 0) {
                this.$set(element, 0);
                this.setmngmountaintoggle();
                this.$set('rolesettings.ADV_MUTN_LIST', "");
                jQuery('#advmountaincontainer').hide();
            }
           
        },
        disablefamemountain: function (val, element) {
            if (val == 1) {
                this.$set('rolesettings.FAM_MUTN_LIST', '0');
                jQuery('#famemountaincontainer').show();
            }
            if (val == 0) {
                this.$set(element, 0);
               this.setmngmountaintoggle();
                this.$set('rolesettings.FAM_MUTN_LIST', "");
                jQuery('#famemountaincontainer').hide();
            }
        },
        mountainnoradiocheck: function (element) {
            this.$set(element, 0);
            this.setmngmountaintoggle();
        },
        judgenoradiocheck: function (element) {
            this.$set(element, 0);
            if (this.rolesettings.CRE_JUG == 0 && this.rolesettings.EDT_JUG == 0 && this.rolesettings.DEL_JUG == 0 && this.rolesettings.HIDE_JUG == 0 && this.rolesettings.SER_JUG == 0 && this.rolesettings.ASN_MUTN == 0) {
                this.$set('rolesettings.JUG', 0);
            }
        },
        usernoradiocheck: function (element) {
            this.$set(element, 0);
            if (this.rolesettings.CRE_USR == 0 && this.rolesettings.BLK_USR == 0 && this.rolesettings.SER_USR == 0) {
                this.$set('rolesettings.USR', 0);
            }
        },
        notifynoradiocheck: function (element) {
            this.$set(element, 0);
            if (this.rolesettings.VIEW_NOFY == 0 && this.rolesettings.DEL_FEED == 0 && this.rolesettings.BLK_NOTIFY_USR == 0 && this.rolesettings.DEL_NOFY == 0 && this.rolesettings.SER_NOFY == 0) {
                this.$set('rolesettings.NOFY', 0);
            }
        },
        allowdenycheck: function (section, value) {
            if (section == 'mountain') {
                if (value == 0) {
                    this.$set('rolesettings.ADV_MUTN_LIST', {});
                    this.$set('rolesettings.FAM_MUTN_LIST', {});
                    this.$set('rolesettings.MUTN', 0);
                }
                if (value == 1) {
                    this.$set('rolesettings.ADV_MUTN_LIST', '0');
                    this.$set('rolesettings.FAM_MUTN_LIST', '0');
                    this.$set('rolesettings.MUTN', 1);
                }
               
                this.$set('rolesettings.ADV_MUTN', value);
                this.$set('rolesettings.FAM_MUNT', value);
                this.$set('rolesettings.CRE_MUTN', value);
                this.$set('rolesettings.EDT_MUTN', value);
                this.$set('rolesettings.SER_MUTN', value);
                this.$set('rolesettings.PUS_NOFY', value);
                this.$set('rolesettings.ASN_JUG', value);
                this.$set('rolesettings.ALL_MUTN', value);
            }
            if (section == 'judge') {
                if (value == 0) {
                    this.$set('rolesettings.JUG', 0);
                }
                if (value == 1) {
                    this.$set('rolesettings.JUG', 1);
                }
                this.$set('rolesettings.CRE_JUG', value);
                this.$set('rolesettings.EDT_JUG', value);
                this.$set('rolesettings.DEL_JUG', value);
                this.$set('rolesettings.HIDE_JUG', value);
                this.$set('rolesettings.SER_JUG', value);
                this.$set('rolesettings.ASN_MUTN', value);
            }
            if (section == 'user') {
                if (value == 0) {
                    this.$set('rolesettings.USR', 0);
                }
                if (value == 1) {
                    this.$set('rolesettings.USR', 1);
                }
                this.$set('rolesettings.CRE_USR', value);
                this.$set('rolesettings.BLK_USR', value);
                this.$set('rolesettings.SER_USR', value);
            }
            if (section == 'notify') {
                if (value == 0) {
                    this.$set('rolesettings.NOFY', 0);
                }
                if (value == 1) {
                    this.$set('rolesettings.NOFY', 1);
                }
                this.$set('rolesettings.VIEW_NOFY', value);
                this.$set('rolesettings.DEL_FEED', value);
                this.$set('rolesettings.BLK_NOTIFY_USR', value);
                this.$set('rolesettings.DEL_NOFY', value);
                this.$set('rolesettings.SER_NOFY', value);
            }
        },
        getRoleDetails: function (roleid) {
            var postData = { role_id: roleid };

            this.$http.post(baseurl + '/api/v1/site/getRoleDetails', postData, function (response) {
                this.$set('roledetails', response);
                this.getAdvMountainListing(roleid);
            });
        },
         getAdvMountainListing: function (roleid) {
            var postData = { country_id: this.formVariables.country_id };

            this.$http.post(baseurl + '/api/v1/site/getAdvMountainList', postData, function (response) {
                this.$set('advmountainlist', response.result);
                this.getFameMountainListing(roleid);
            });
        },
         getFameMountainListing: function (roleid) {
            var postData = { country_id: this.formVariables.country_id };

            this.$http.post(baseurl + '/api/v1/site/getFameMountainList', postData, function (response) {
                this.$set('famemountainlist', response.result);
                var postData = { role_id: roleid };
                this.$http.post(baseurl + '/api/v1/site/getRoleSettings', postData, function (response) {
                    ////if new settings for the particular role
                    if (response.result == false) {
                        objRolesettings = {
                            'role_id': roleid,
                            'MUTN': 1,
                            'ADV_MUTN': 1,
                            'ADV_MUTN_LIST': "0",
                            'FAM_MUNT': 1,
                            'FAM_MUTN_LIST': "0",
                            'CRE_MUTN': 1,
                            'EDT_MUTN': 1,
                            'SER_MUTN': 1,
                            'PUS_NOFY': 1,
                            'ASN_JUG': 1,
                            'ALL_MUTN':1,
                            'JUG': 0,
                            'CRE_JUG': 0,
                            'EDT_JUG': 0,
                            'DEL_JUG': 0,
                            'HIDE_JUG': 0,
                            'SER_JUG': 0,
                            'ASN_MUTN': 0,
                            'USR': 0,
                            'CRE_USR': 0,
                            'BLK_USR': 0,
                            'SER_USR': 0,
                            'NOFY': 0,
                            'VIEW_NOFY': 0,
                            'DEL_FEED': 0,
                            'BLK_NOTIFY_USR': 0,
                            'DEL_NOFY': 0,
                            'SER_NOFY': 0,
                        };
                        this.$set('rolesettings', objRolesettings);
                        //alert('if');
                    } else { ////if existing settings for the particular role
                        //alert('else');
                        //alert(response.result.ADV_MUTN_LIST);
                        this.$set('rolesettings', response.result);

                    }

                });
            });
        },
    
        saveRoleSettings: function (objrolesettings) {
            if (document.getElementById("hmountainallow").value != "") {
                objrolesettings.MUTN = document.getElementById("hmountainallow").value;
            }
            if (document.getElementById("hjudgeallow").value != "") {
                objrolesettings.JUG = document.getElementById("hjudgeallow").value;
            }
            if (document.getElementById("huserallow").value != "") {
                objrolesettings.USR = document.getElementById("huserallow").value;
            }
            if (document.getElementById("hnotifyallow").value != "") {
                objrolesettings.NOFY = document.getElementById("hnotifyallow").value;
            }
            //alert(JSON.stringify(objrolesettings));
            // var postData = objrolesettings;
            var postData = { objrolesettings: objrolesettings, role_description: document.getElementById("roledescription").value };
            this.$http.post(baseurl + '/api/v1/site/saveRoleSettings', postData, function (response) {
                //this.$set('rolesettings', response.result);
                jQuery('h4.role-settings-title').text('Role Settings');
                jQuery('#saverolesettingsmodal').modal('show');
                //window.location.reload();
            });

        },
       deleteRole: function () {
            var roleid=jQuery('#roleid').val();
            var postData = { role_id: roleid };
            this.$http.post(baseurl + '/api/v1/site/deleterole', postData, function (response) {
               
                if (response.message == 'exist') {
                    jQuery('#rolealertmodal').modal('show');
                }
                if (response.message == 'done') {
                    jQuery('h4.popup-title').text('Delete Role');
                    jQuery('#popup-content').text('Role Deleted Successfully.');
                    jQuery('#commonalertmodal').modal('show');
                }
                //this.$set('rolesettings', response.result);
                //jQuery('h4.role-settings-title').text('Role Settings');
                //jQuery('#saverolesettingsmodal').modal('show');
                //window.location.reload();
            });
        },
        reloadwindow: function () {
            window.location.reload();
        },
        saveUser: function () {
            if (jQuery("#add_user").valid()) {
                var gender_val = jQuery('input[type=radio][name=gender]:checked').attr('id');
                var gender;
                if (gender_val == 'gender_female') {
                    gender = 'F';
                }
                else {
                    gender = 'M';
                }
                var postData = {
                    first_name: jQuery("#user_first_name").val(),
                    family_name: jQuery("#user_last_name").val(),
                    user_name: jQuery("#user_name").val(),
                    password: jQuery("#password").val(),
                    profession: jQuery('#user_profession option:selected').val(),
                    country: jQuery('#user_country_id option:selected').val(),
                    ProfileImage: jQuery("#userprofileImage").val(),
                    tags: jQuery("#user_tags").val(),
                    description: jQuery("#user_description").val(),
                    user_type: 'user',
                    gender: gender,
                    email: jQuery("#user_email").val(),
                    role_id: jQuery('#user_role_type option:selected').val(),
                };
                this.$http.post(baseurl + '/api/v1/device/register', postData, function (response) {
                    this.$set('userlist', response.result);
                    if (response.code == 8)
                        jQuery("#user_error").html(response.message);
                    else
                        jQuery('#usermodal').modal('hide');
                    this.getUserList(this.formVariables.country_id);
                    getIcons('default');
                });

            }
        },
        updateUser: function () {
            if (jQuery("#add_user").valid()) {
                var gender_val = jQuery('input[type=radio][name=gender]:checked').attr('id');
                var gender;
                if (gender_val == 'gender_female') {
                    gender = 'F';
                }
                else {
                    gender = 'M';
                }
                var postData = {
                    first_name: jQuery("#user_first_name").val(),
                    family_name: jQuery("#user_last_name").val(),
                    id: jQuery("#user_id").val(),
                    user_name: jQuery("#user_name").val(),
                    password: jQuery("#password").val(),
                    profession: jQuery('#user_profession option:selected').val(),
                    country: jQuery('#user_country_id option:selected').val(),
                    ProfileImage: jQuery("#userprofileImage").val(),
                    tags: jQuery("#user_tags").val(),
                     email: jQuery("#user_email").val(),
                    description: jQuery("#user_description").val(),email: jQuery("#user_email").val(),
                    gender: gender,
                    role_id: jQuery('#user_role_type option:selected').val(),

                };

                this.$http.post(baseurl + '/api/v1/device/updateJudgeProfile', postData, function (response) {
                    this.$set('userlist', response.result);
                    jQuery('#usermodal').modal('hide');
                    this.getUserList(this.formVariables.country_id);
                });

            }
        },
        getUserList: function (country_id,page) {
            //var option = jQuery('#country_id option:selected').attr("code");
            //this.formVariables.$set('country_id', country_id);
            //this.formVariables.$set('country_code', option);
            jQuery(".norecord").remove();
           if(page == undefined){
        	   var spage=1; 
           }
           else
        	{
        	   var spage=page;
        	 }
           var searchuser = '';
           if (jQuery('#search_user').val() == undefined) {
               searchuser = '';
           } else {
               searchuser = jQuery('#search_user').val();
           }
            var postData = {
                country_id: '',//this.formVariables.country_id,
                search_user: searchuser,
                start: spage,
                end: '',
              
            };

            this.$http.post(baseurl + '/api/v1/site/getUserList', postData, function (response) {
                this.$set('userlist', response.result);
            }).success(function (response) {
 this.formVariables.$set('country_id', localStorage.getItem("selectedindex"));
jQuery("#dvFlag").attr('class', localStorage.getItem("flag"));
                //jQuery("#userdvFlag").attr('class', 'us');
                //jQuery("#judgedvFlag").attr('class',option);
			
               // console.log(response.result);
//alert(response.result.length);
               if(response.result.length<9 || response.result.length==undefined)
            	   this.pagination.next=false;
               else
            	   this.pagination.next=true;
                if (!response.result) {
                    jQuery(".norecord").remove();
                    jQuery("#mountain_list")
                   .append('<div style="text-align:center" class="norecord"><h3>No Records Found</h3></div>');
this.pagination.next=false;
                }
            });

        },
saveMountain: function (country_id) {
            this.formVariables.$set('country_id', country_id);
            if (jQuery("#add_mountain").valid()) {
            
            	var image = jQuery("#mountainprofileImage").val();
          		 var country_id=jQuery('#country_id option:selected').val();
          		var is_edit = is_editable;
          		 var str = jQuery("#start_date").val();
          		 str = str.split(' ');
          		 var endstr = jQuery("#end_date").val();
          		endstr = endstr.split(' ');
          		if(flag=='edit')
         		 {
         			 var id=jQuery('#mountain_id option:selected').val();
         			
         		 }
         		 else{
         			 var id=0;
         		 }

          		var sDate = str[0].split('-');
          	  var eDate =  endstr[0].split('-');
          	
	          	if( ( sDate[2] == eDate[2] && sDate[1] ==  eDate[1] && sDate[0] == eDate[0]))
	      	    {
                                 if(is_editable==0){
                                   jQuery('#user_error').html('')
	                           var postData = {
	                		name		: jQuery("#name").val(),
	                		hash_tag	: jQuery("#hash_tag").val(),
	                		url			: jQuery("#url").val(),
	                		description	: jQuery("#description").val(),
	                		start_date	: jQuery('#start_date').val(),
	                		end_date	: jQuery('#end_date').val(),
	                		image_path	: image,
	                		no_of_peaks	: jQuery("#no_of_peaks").val(),
	                		peak_duration: jQuery("#mount_peak_duration").val(),
	                		zone_id		: jQuery('#zone_id option:selected').val(),
	                		window_description: jQuery("#window_description").val(),
	                		country_id	: country_id,
	                		id			: id,
	                		is_edit		:is_edit,
	                           };
	                           this.$http.post(baseurl + '/api/v1/site/saveMountain', postData, function (response) {
	                	
	                	     jQuery('#mountainmodal').modal('hide');
	                                this.getMountain(this.formVariables.country_id);
this.getAdminCurrentMountain(this.formVariables.country_id);
	                               });
                                 }
                                 else{
	          		     jQuery('#user_error').html('Please ensure that the End Date is greater than  to the Start Date.')
                                }
	      	    }	
                else{
             	   jQuery('#user_error').html('')
	                var postData = {
	                		name		: jQuery("#name").val(),
	                		hash_tag	: jQuery("#hash_tag").val(),
	                		url			: jQuery("#url").val(),
	                		description	: jQuery("#description").val(),
	                		start_date	: jQuery('#start_date').val(),
	                		end_date	: jQuery('#end_date').val(),
	                		image_path	: image,
	                		no_of_peaks	: jQuery("#no_of_peaks").val(),
	                		peak_duration: jQuery("#mount_peak_duration").val(),
	                		zone_id		: jQuery('#zone_id option:selected').val(),
	                		window_description: jQuery("#window_description").val(),
	                		country_id	: country_id,
	                		id			: id,
	                		is_edit		:is_edit,
	                };
	                this.$http.post(baseurl + '/api/v1/site/saveMountain', postData, function (response) {
	                	
	                	jQuery('#mountainmodal').modal('hide');
	                    this.getMountain(this.formVariables.country_id);
                           this.getAdminCurrentMountain(this.formVariables.country_id);
                             getIcons('default');

	                });
                }
            }
        },
getProfessionDetail: function () {
            
            this.$http.get(baseurl + '/api/v1/site/getProfession', function (response) {
                this.$set('professionlist', response.result);
//console.log(response.result);
            });
        },
 saveProfession: function (tag) {
			if(tag!='save')
			{
				jQuery('#add_prof').show();
				jQuery('#select_prof').hide();
				
			}
			else
			{
				if(jQuery("#prof_name").val()!=''){
					jQuery('#prof_error').html('');
					jQuery('#add_prof').hide();
					jQuery('#select_prof').show();
					 var postData = {
			         		user_profession: jQuery("#prof_name").val(),
			            
			         };
			         this.$http.post(baseurl + '/api/v1/site/saveProfession', postData, function (response) {
			            jQuery("#prof_name").val('');
			             this.getProfessionDetail();
			         });
				}
				else
				{
					jQuery('#prof_error').html('Profession is required');
				}
					
			}
         
               

        },
 changePassword: function (id) {
			//alert(id);
        	if (jQuery("#change_password_form").valid()) {
				
				 var postData = {
						 user_id :id,
		         		password: jQuery("#confirmpassword").val(),
		            
		         };
		         this.$http.post(baseurl + '/api/v1/site/changePassword', postData, function (response) {
		        	 jQuery('#changepasswordmodel').modal('hide');
		        	 jQuery('h4.popup-title').text('CHNAGE PASSWORD');
		                jQuery('#popup-content').text('Password Changed Successfully.');
		                jQuery('#notifycommonalertmodal').modal('show');
		           
		         });
			}
			
        },
       deleteMountain: function () {

            mountain_id = jQuery("#deletemountid").val();
                     jQuery(".modalloader").show();
            var postData = { mountain_id: mountain_id };
            this.$http.post(baseurl + '/api/v1/site/deleteMountainDetails', postData, function (response) {
                jQuery('#deletemountainmodal').modal('hide');
                jQuery(".modalloader").hide();
                jQuery('h4.popup-title').text('DELETE MOUNTAIN');
                jQuery('#popup-content').text('Mountain Deleted Successfully.');
                jQuery('#notifycommonalertmodal').modal('show');
                 if (this.formVariables.url == 'managemountain' || this.formVariables.url == 'managemountain#') {
                   this.getMountain(this.formVariables.country_id);
                  }
            });

        },


    }
});
/*Vue.component('modal', {
	  template: '#judgeTemplate',
	  props: {
		    model: Array,
		  },
	})
*/