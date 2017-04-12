 <div id="products" class="row list-group portfolio-item" style="margin-top: 10px;">
   
    	<div class="useritem col-xs-4 grid-group-item" v-repeat = "list: userlist" style="padding-right: 5px!important;">
    	<ul  class="thumbnail" onclick="selectuser(this);" id="@{{list.user_id}}">
	    	<li class="clearfix" >
	    	
		    	<div class="row" style="background-color: #F2F2F2!important;margin-left: 0px;margin-right: 0px;">
		    		<div class="judgetickmark" style="display:none;">
						&#10004;
					</div>
			    	<div class="imgrow col-xs-4" style="padding-left: 0px;">
					     
							
							 <a href="void:(0)"  id="@{{list.user_id}}"  >
					   		  	 <img class="group list-group-image img-responsive" v-if="list.ProfileImage" src="<?php echo asset('/public/upload/thumbnail');?>/@{{list.ProfileImage}}">										
								 <img class="group list-group-image img-responsive" v-if="!list.ProfileImage" src="<?php echo asset('/public/upload/noimage.jpg');?>">										
						      
							   </a>
					   		 <div  class='row' style="margin:0px">  
						   		 <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
						           <img class="" v-if="list.gender=='M'" src="<?php echo asset('/public/images/male (1).png');?>">										
									<img class="" v-if="list.gender=='F'" src="<?php echo asset('/public/images/female.png');?>">										
						        </div>
						        
					        	<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2  grid-group-item_rank" >
						             <div id="userdvFlag" style="background-image:url(public/images/flags.png);background-repeat:no-repeat;float:left;height:16px;width:16px;margin-top:6px" class="@{{formVariables.country_code}}"></div>
				            
						        </div>	
					    		</div>  
				        		
				        </div>
				       
				    <div class="contentrow col-xs-8">
					    <h4 class="group inner list-group-item-heading list-group-item-text parent">
			               @{{ list.first_name }} @{{ list.family_name }} 
			            </h4>
	
			            <a  class="group inner list-group-item-text" href="#">#@{{ list.tags}}</a>
			            
			            <p class="group inner list-group-item-text">
			            	PROFILE : @{{ list.description}}
			            </p>
			            <p class="group inner list-group-item-text">
			            	Role : @{{ list.name}}
			            </p>
				       
			        </div>
			       </div>
		        </li>	         
	    	</ul>	
    	</div>  
 	</div>
	 
	
