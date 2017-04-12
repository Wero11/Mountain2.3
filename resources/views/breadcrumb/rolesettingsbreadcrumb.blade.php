<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      
      <ul class="nav navbar-nav navbar-left">
        <li>
          <h1 class="breadcrumb-div-left">Role Settings</h1>
        </li>

      </ul>
     
    </div>
   <button class="breadcrumb_btn_role_active" id="btn-create-role" v-show="!rolesettings.role_id" onclick="onShowCreateRolePopup()">Create Role</button> &nbsp;&nbsp;
    <button type="button" class="btn_save_role" id="creat_user" v-show="rolesettings.role_id" v-on="click:saveRoleSettings(rolesettings)">SAVE</button>
    &nbsp;&nbsp;
    <button type="button" class="btn_save_role" id="delete_user" v-show="rolesettings.role_id" onclick="showDeleteRolePopup('DELETE ROLE','show','deleterolemodal','',@{{rolesettings.role_id}});">DELETE</button>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>
