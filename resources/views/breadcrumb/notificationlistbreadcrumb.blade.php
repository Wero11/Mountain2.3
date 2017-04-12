
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      
      <ul class="nav navbar-nav navbar-left">
        <li>
          <h1 class="breadcrumb-div-left">NOTIFICATIONS / ALERTS</h1>
        </li>

      </ul>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li>
          <div class="input-group add-on" style="height:25px">
            <input type="text" class="k-textbox form-control" style="height: 25px;" placeholder="Search"  id="searchuserkeyword" />
              <div class="input-group-btn">
                <button class="btn btn-default" id="btnSearch" v-on="click:getNotificationList()" type="submit" style="height: 25px;padding: 2px 12px!important">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </div>
        </li>
      
     
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>
