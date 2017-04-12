<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>	
     	 <ul class="nav navbar-nav navbar-left">
	       <li> <h1 class="breadcrumb-div-left">@{{formVariables.mountain_name}}</h1></li>
	      	<li id="progress_bar" style="margin: 5px;font-size: 10px;"> 
	      	<span id="peak_duration" >@{{formVariables.duration.d}} Days @{{formVariables.duration.h}} Hours left </span>
		      	<div class="progress">		      	
				  <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"
				  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
				  </div>
				</div>
			</li>
	        <li>
            <ul class="pagination breadcrumb-div-left" v-repeat="peak:peaklist | orderBy 'peak_index'" >
              <li id="peak_id" style="cursor:pointer" 
                  v-model="formVariables.peak_id"  
                  class="active_@{{peak.is_finished}}_color"
                  v-on="click: getMountainListById(peak.id);" >@{{peak.peak_index}}			      
              </li>
           </ul>
	       </li>     
	    </ul> 	    
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	     <ul class="nav navbar-nav navbar-right">
	       <li> <button class="breadcrumb-btn_mountain" >Create Mountain</button></li>
	      	<li> 
	      		 <select 
	                class="breadcrumb_mountain_property" 
	                id="mountain_id" 
	                v-model="formVariables.mountain_id" 
	                v-on="change: getMountainPeak(formVariables.mountain_id);">
	                <option 
	                  v-repeat="mountain: mountainlist" 
	                  v-attr="selected: mountain.is_main == 1"  
	                  value="@{{mountain.id}}">@{{mountain.name}}
	                </option>                                
	            </select>
			</li>
	        <li> 
	        	<a href="#" id="gridview" class="switcher breadcrumb-div-a"> 
	        		<img src="{{ asset('public/images/title_a.png')}} " />
	        	</a>
	        </li>
	        <li>
	        	<a href="#" id="listview" class="switcher active breadcrumb-div-a">
	        		<img src="{{ asset('public/images/list_n.png')}} "  />
				</a>
			</li>
			<li>
	        	<a href="#" class="breadcrumb-div-a"> 
	        		<img src="{{ asset('public/images/search_n.png')}} " />
	        	</a>
	        </li>
	        
	        <li>
	        	<a href="#" class="breadcrumb-div-a">  
	        		<img src="{{ asset('public/images/assignjudge_n.png')}} " style="max-width: 30px!important;"/>
			    </a>
			</li>
			<li style="margin-right: -3px;">
	        	<a href="#" class="breadcrumb-div-a" > 
	        		<img src="{{ asset('public/images/setting_n.png')}} " style="max-width: 30px!important;"/>
	        	</a>
	        </li>
	    </ul> 
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
