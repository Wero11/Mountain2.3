<?php



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(array('namespace'=>'device','prefix' => '/api/v1/device/'), function()
{
	

	// User

	Route::post('{register}' , [ 'as' => 'register', 'uses' => 'ApiController@Register'] )->where('register', '(?i)register(?-i)');

	Route::post('{loginCheck}' , [ 'as' => 'loginCheck', 'uses' => 'ApiController@loginCheck'] )->where('loginCheck', '(?i)loginCheck(?-i)');

    Route::post('{adminLoginCheck}' , [ 'as' => 'adminLoginCheck', 'uses' => 'ApiController@adminLoginCheck'] )->where('adminLoginCheck', '(?i)adminLoginCheck(?-i)');
	
	Route::get('{getCountry}' , [ 'as' => 'getCountry', 'uses' => 'ApiController@getCountry'] )->where('getCountry', '(?i)getCountry(?-i)');

	Route::post('{getState}' , [ 'as' => 'getState', 'uses' => 'ApiController@getState'])->where('getState', '(?i)getState(?-i)');

	Route::get('{quickRegister}' , [ 'as' => 'quickRegister', 'uses' => 'ApiController@quickRegister'])->where('quickRegister', '(?i)quickRegister(?-i)');

	Route::post('{getFans}' , [ 'as' => 'getFans', 'uses' => 'ApiController@getFans'])->where('getFans', '(?i)getFans(?-i)');

	Route::post('{getIdols}' , [ 'as' => 'getIdols', 'uses' => 'ApiController@getIdols'])->where('getIdols', '(?i)getIdols(?-i)');

	Route::post('{getUserPeaks}' , [ 'as' => 'getUserPeaks', 'uses' => 'ApiController@getUserPeaks'])->where('getUserPeaks', '(?i)getUserPeaks(?-i)');
	
	Route::post('{getUserProfile}' , [ 'as' => 'getUserProfile', 'uses' => 'ApiController@getUserProfile'])->where('getUserProfile', '(?i)getUserProfile(?-i)');

	Route::post('{getUserFeeds}' , [ 'as' => 'getUserFeeds', 'uses' => 'ApiController@getUserFeeds'])->where('getUserFeeds', '(?i)getUserFeeds(?-i)');

	Route::post('{getProfessionalDetails}' , [ 'as' => 'getProfessionalDetails', 'uses' => 'ApiController@getProfessionalDetails'])->where('getProfessionalDetails', '(?i)getProfessionalDetails(?-i)');
 
 	Route::post('{updateProfile}' , [ 'as' => 'updateProfile', 'uses' => 'ApiController@updateProfile'])->where('updateProfile', '(?i)updateProfile(?-i)');

 	Route::post('{userAvailablityCheck}' , [ 'as' => 'userAvailablityCheck', 'uses' => 'ApiController@userAvailablityCheck'])->where('userAvailablityCheck', '(?i)userAvailablityCheck(?-i)');
 	
 	Route::post('{forgotPassword}' , [ 'as' => 'forgotPassword', 'uses' => 'ApiController@forgotPassword'])->where('forgotPassword', '(?i)forgotPassword(?-i)');

 	Route::post('{changePassword}' , [ 'as' => 'changePassword', 'uses' => 'ApiController@changePassword'])->where('changePassword', '(?i)changePassword(?-i)');

 	Route::post('{editUserProfile}' , [ 'as' => 'editUserProfile', 'uses' => 'ApiController@editUserProfile'])->where('editUserProfile', '(?i)editUserProfile(?-i)');
	
 	Route::post('{getSearchUserDetail}' , [ 'as' => 'getSearchUserDetail', 'uses' => 'ApiController@getSearchUserDetail'])->where('getSearchUserDetail', '(?i)getSearchUserDetail(?-i)');
 	
    Route::post('{saveSocial}' , [ 'as' => 'saveSocial', 'uses' => 'ApiController@saveSocial'])->where('saveSocial', '(?i)saveSocial(?-i)');

    Route::post('{findContacts}' , [ 'as' => 'findContacts', 'uses' => 'ApiController@findContacts'])->where('findContacts', '(?i)findContacts(?-i)');

    Route::post('{findSocialContacts}' , [ 'as' => 'findSocialContacts', 'uses' => 'ApiController@findSocialContacts'])->where('findSocialContacts', '(?i)findSocialContacts(?-i)');

    Route::post('{getSocial}' , [ 'as' => 'getSocial', 'uses' => 'ApiController@getSocial'])->where('getSocial', '(?i)getSocial(?-i)');

    Route::post('{unlinkSocial}' , [ 'as' => 'unlinkSocial', 'uses' => 'ApiController@unlinkSocial'])->where('unlinkSocial', '(?i)unlinkSocial(?-i)');



    // Activity List

    Route::post('{getFansActivityList}' , [ 'as' => 'getFansActivityList', 'uses' => 'ApiController@getFansActivityList'])->where('getFansActivityList', '(?i)getFansActivityList(?-i)');	

    Route::post('{getIdolsActivityList}' , [ 'as' => 'getIdolsActivityList', 'uses' => 'ApiController@getIdolsActivityList'])->where('getIdolsActivityList', '(?i)getIdolsActivityList(?-i)');	
	
	// Message
	
	Route::post('{getConversation}' , [ 'as' => 'getConversation', 'uses' => 'ApiController@getConversation'])->where('getConversation', '(?i)getConversation(?-i)');

	Route::post('{getMessageHistory}' , [ 'as' => 'getMessageHistory', 'uses' => 'ApiController@getMessageHistory'])->where('getMessageHistory', '(?i)getMessageHistory(?-i)');

	Route::post('{sendMessage}' , [ 'as' => 'sendMessage', 'uses' => 'ApiController@sendMessage'])->where('sendMessage', '(?i)sendMessage(?-i)');

	Route::post('{receiveMessage}' , [ 'as' => 'receiveMessage', 'uses' => 'ApiController@receiveMessage'])->where('receiveMessage', '(?i)receiveMessage(?-i)');

	Route::post('{setMessageMarked}' , [ 'as' => 'setMessageMarked', 'uses' => 'ApiController@setMessageMarked'])->where('setMessageMarked', '(?i)setMessageMarked(?-i)');

	Route::post('{deleteConversation}' , [ 'as' => 'deleteConversation', 'uses' => 'ApiController@deleteConversation'])->where('deleteConversation', '(?i)deleteConversation(?-i)');

	// Hash

	Route::get('{getHashTag}' , [ 'as' => 'getHashTag', 'uses' => 'ApiController@getHashTag'])->where('getHashTag', '(?i)getHashTag(?-i)');
 	
 	// Feed

 	Route::post('{getMountainList}', [ 'as' => 'getMountainList', 'uses' => 'ApiController@getMountainList'] )->where('getMountainList', '(?i)getMountainList(?-i)');

 	Route::post('{getMountainList1}', [ 'as' => 'getMountainList1', 'uses' => 'ApiController@getMountainList1'] )->where('getMountainList1', '(?i)getMountainList1(?-i)');

 	Route::get('{getUserCountryList}' , [ 'as' => 'getUserCountryList', 'uses' => 'ApiController@getUserCountryList'])->where('getUserCountryList', '(?i)getUserCountryList(?-i)');

	Route::post('{uploadVideo}', [ 'as' => 'uploadVideo', 'uses' => 'ApiController@uploadVideo'])->where('uploadVideo', '(?i)uploadVideo(?-i)');

 	Route::post('{updateVideo}' , [ 'as' => 'updateVideo', 'uses' => 'ApiController@updateVideo'])->where('updateVideo', '(?i)updateVideo(?-i)');

 	Route::post('{feedLike}' , [ 'as' => 'feedLike', 'uses' => 'ApiController@feedLike'])->where('feedLike', '(?i)feedLike(?-i)');

	Route::post('{feedView}' , [ 'as' => 'feedView', 'uses' => 'ApiController@feedView'])->where('feedView', '(?i)feedView(?-i)');

	Route::post('{feedAbuse}' , [ 'as' => 'feedAbuse', 'uses' => 'ApiController@feedAbuse'])->where('feedAbuse', '(?i)feedAbuse(?-i)');

	Route::post('{setIdol}' , [ 'as' => 'setIdol', 'uses' => 'ApiController@setIdol'])->where('setIdol', '(?i)setIdol(?-i)');

	Route::post('{deleteFeed}' , [ 'as' => 'deleteFeed', 'uses' => 'ApiController@deleteFeed'])->where('deleteFeed', '(?i)deleteFeed(?-i)');
	
	Route::post('{repostFeed}' , [ 'as' => 'repostFeed', 'uses' => 'ApiController@repostFeed'])->where('repostFeed', '(?i)repostFeed(?-i)');
	
	Route::post('{getIdolsMountainList}', [ 'as' => 'getIdolsMountainList', 'uses' => 'ApiController@getIdolsMountainList'] )->where('getIdolsMountainList', '(?i)getIdolsMountainList(?-i)');

	Route::post('{getFeed}', [ 'as' => 'getFeed', 'uses' => 'ApiController@getFeed'] )->where('getFeed', '(?i)getFeed(?-i)');
	
	// Search

	Route::post('{getSearchFeedTagDetail}', [ 'as' => 'getSearchFeedTagDetail', 'uses' => 'ApiController@getSearchFeedTagDetail'] )->where('getSearchFeedTagDetail', '(?i)getSearchFeedTagDetail(?-i)');
	
	Route::post('{getSearchTagDetail}', [ 'as' => 'getSearchTagDetail', 'uses' => 'ApiController@getSearchTagDetail'] )->where('getSearchTagDetail', '(?i)getSearchTagDetail(?-i)');

	Route::post('{getSearchTreandingTagDetail}', [ 'as' => 'getSearchTreandingTagDetail', 'uses' => 'ApiController@getSearchTreandingTagDetail'] )->where('getSearchTreandingTagDetail', '(?i)getSearchTreandingTagDetail(?-i)');
	
		
	//  Judge 

	Route::post('{getJudgeDetail}' , [ 'as' => 'getJudgeDetail', 'uses' => 'ApiController@getJudgeDetail'])->where('getJudgeDetail', '(?i)getJudgeDetail(?-i)');

	Route::post('{getMountainJudges}' , [ 'as' => 'getMountainJudges', 'uses' => 'ApiController@getMountainJudges'])->where('getMountainJudges', '(?i)getMountainJudges(?-i)');

	Route::post('{updateJudgeProfile}' , [ 'as' => 'updateJudgeProfile', 'uses' => 'ApiController@updateJudgeProfile'])->where('updateJudgeProfile', '(?i)updateJudgeProfile(?-i)');


	// Mountain
	
	Route::post('{getMountainListById}' , [ 'as' => 'getMountainListById', 'uses' => 'ApiController@getMountainListById'])->where('getMountainListById', '(?i)getMountainListById(?-i)');

	Route::post('{getAdvertising}' , [ 'as' => 'getAdvertising', 'uses' => 'ApiController@getAdvertising'])->where('getAdvertising', '(?i)getAdvertising(?-i)');
	
	Route::post('{getPeakWeek}' , [ 'as' => 'getPeakWeek', 'uses' => 'ApiController@getPeakWeek'])->where('getPeakWeek', '(?i)getPeakWeek(?-i)');

	Route::post('{getMountainInfo}' , [ 'as' => 'getMountainInfo', 'uses' => 'ApiController@getMountainInfo'])->where('getMountainInfo', '(?i)getMountainInfo(?-i)');
	
	Route::post('{getCount}' , [ 'as' => 'getCount', 'uses' => 'ApiController@getCount'])->where('getCount', '(?i)getCount(?-i)');
});	



Route::group(array('namespace'=>'site' ), function()
{
	Route::get('/managemountain', array('middleware' => 'userauth', 'as' => 'mountainList', 'uses' => 'MountainController@mountainList'));	
	
	
	// Judge 

	Route::get('/managejudge' , [ 'middleware' => 'userauth', 'as' => 'judgelist', 'uses' => 'JudgeController@judgelist']);

	// Notification

	Route::get('/notification', array( 'middleware' => 'userauth','as' => 'notificationlist', 'uses' => 'NotificationController@notificationlist'));

	//role settings
	
	Route::get('/rolesettings', array( 'middleware' => 'userauth','as' => 'rolesettings', 'uses' => 'RoleSettingController@rolesettings'));
	
	//users
	Route::get('/manageuser', array( 'middleware' => 'userauth','as' => 'userlist', 'uses' => 'UserController@userlist'));
	
	
	Route::get('/login', 'LoginController@index');	

	Route::get('/', 'LoginController@index');	
	
	Route::post('/adminlogin', 'LoginController@logincheck');
	
	Route::get('/logout','MountainController@logout');
	
	Route::post('/forgotpassword','PasswordController@forgotpassword');
	
	
});	


Route::group(array('namespace'=>'site','prefix' => '/api/v1/site/'), function()
{

	Route::post('{userEmailcheck}' , [ 'as' => 'userEmailcheck', 'uses' => 'SiteController@userEmailcheck'])->where('userEmailcheck', '(?i)userEmailcheck(?-i)');

        Route::post('{changePassword}' , [ 'as' => 'changePassword', 'uses' => 'SiteController@changePassword'])->where('changePassword', '(?i)changePassword(?-i)');

        Route::post('{deleteMountainDetails}' , [ 'as' => 'deleteMountainDetails', 'uses' => 'SiteController@deleteMountainDetails'])->where('deleteMountainDetails', '(?i)deleteMountainDetails(?-i)');

	
	
	// Mountain List API

	Route::post('{getMountain}' , [ 'as' => 'getMountain', 'uses' => 'SiteController@getMountain'])->where('getMountain', '(?i)getMountain(?-i)');

        Route::post('{getAdminCurrentMountain}' , [ 'as' => 'getAdminCurrentMountain', 'uses' => 'SiteController@getAdminCurrentMountain'])->where('getAdminCurrentMountain', '(?i)getAdminCurrentMountain(?-i)');


	Route::post('{getMountainPeak}' , [ 'as' => 'getMountainPeak', 'uses' => 'SiteController@getMountainPeak'])->where('getMountainPeak', '(?i)getMountainPeak(?-i)');

	Route::post('{saveMountain}' , [ 'as' => 'saveMountain', 'uses' => 'SiteController@saveMountain'])->where('saveMountain', '(?i)saveMountain(?-i)');
	
	Route::post('{getMountainDetailById}' , [ 'as' => 'getMountainDetailById', 'uses' => 'SiteController@getMountainDetailById'])->where('getMountainDetailById', '(?i)getMountainDetailById(?-i)');
	
	Route::post('{getMountains}' , [ 'as' => 'getMountains', 'uses' => 'SiteController@getMountains'])->where('getMountains', '(?i)getMountains(?-i)');
	
	Route::post('{editMountainDetailById}' , [ 'as' => 'editMountainDetailById', 'uses' => 'SiteController@editMountainDetailById'])->where('editMountainDetailById', '(?i)editMountainDetailById(?-i)');
	
	Route::post('{getTimeZoneBycountry}' , [ 'as' => 'getTimeZoneBycountry', 'uses' => 'SiteController@getTimeZoneBycountry'])->where('getTimeZoneBycountry', '(?i)getTimeZoneBycountry(?-i)');
	
	// Judge	

	Route::post('{getJudgeList}' , [ 'as' => 'getJudgeList', 'uses' => 'SiteController@getJudgeList'])->where('getJudgeList', '(?i)getJudgeList(?-i)');

	Route::post('{assignJudgeToMountain}' , [ 'as' => 'assignJudgeToMountain', 'uses' => 'SiteController@assignJudgeToMountain'])->where('assignJudgeToMountain', '(?i)assignJudgeToMountain(?-i)');

	Route::post('{deleteJudge}' , [ 'as' => 'deleteJudge', 'uses' => 'SiteController@deleteJudge'])->where('deleteJudge', '(?i)deleteJudge(?-i)');

	Route::post('{hideJudge}' , [ 'as' => 'hideJudge', 'uses' => 'SiteController@hideJudge'])->where('hideJudge', '(?i)hideJudge(?-i)');

	Route::post('{unhideJudge}' , [ 'as' => 'unhideJudge', 'uses' => 'SiteController@unhideJudge'])->where('unhideJudge', '(?i)unhideJudge(?-i)');

	Route::post('{deleteMountainJudge}' , [ 'as' => 'deleteMountainJudge', 'uses' => 'SiteController@deleteMountainJudge'])->where('deleteMountainJudge', '(?i)deleteMountainJudge(?-i)');	

	///Notification
	Route::post('{pushNotificationforMountain}' , [ 'as' => 'pushNotificationforMountain', 'uses' => 'SiteController@pushNotificationforMountain'])->where('pushNotificationforMountain', '(?i)pushNotificationforMountain(?-i)');

	Route::post('{getNotificationList}' , [ 'as' => 'getNotificationList', 'uses' => 'SiteController@getNotificationList'])->where('getNotificationList', '(?i)getNotificationList(?-i)');
	
	Route::post('{blockUser}' , [ 'as' => 'blockUser', 'uses' => 'SiteController@blockUser'])->where('blockUser', '(?i)blockUser(?-i)');

	Route::post('{unblocknotifyuser}' , [ 'as' => 'unblocknotifyuser', 'uses' => 'SiteController@unblocknotifyuser'])->where('unblocknotifyuser', '(?i)unblocknotifyuser(?-i)');
	
	Route::post('{makefeedinactive}' , [ 'as' => 'makefeedinactive', 'uses' => 'SiteController@makefeedinactive'])->where('makefeedinactive', '(?i)makefeedinactive(?-i)');
	
	Route::post('{deleteNotification}' , [ 'as' => 'deleteNotification', 'uses' => 'SiteController@deleteNotification'])->where('deleteNotification', '(?i)deleteNotification(?-i)');
	
	Route::post('{getUserFeedsWithAbused}' , [ 'as' => 'getUserFeedsWithAbused', 'uses' => 'SiteController@getUserFeedsWithAbused'])->where('getUserFeedsWithAbused', '(?i)getUserFeedsWithAbused(?-i)');
	
		///Role Settings
		Route::post('{createrole}' , [ 'as' => 'createrole', 'uses' => 'SiteController@createrole'])->where('createrole', '(?i)createrole(?-i)');
Route::post('{deleterole}' , [ 'as' => 'deleterole', 'uses' => 'SiteController@deleterole'])->where('deleterole', '(?i)deleterole(?-i)');
	Route::post('{getRoleList}' , [ 'as' => 'getRoleList', 'uses' => 'SiteController@getRoleList'])->where('getRoleList', '(?i)getRoleList(?-i)');
	Route::post('{getRoleDetails}' , [ 'as' => 'getRoleDetails', 'uses' => 'SiteController@getRoleDetails'])->where('getRoleDetails', '(?i)getRoleDetails(?-i)');
	Route::post('{getRoleSettings}' , [ 'as' => 'getRoleSettings', 'uses' => 'SiteController@getRoleSettings'])->where('getRoleSettings', '(?i)getRoleSettings(?-i)');
	Route::get('/rolesettings', array( 'middleware' => 'userauth','as' => 'rolesettings', 'uses' => 'RoleSettingController@rolesettings'));
	Route::post('{getAdvMountainList}' , [ 'as' => 'getAdvMountainList', 'uses' => 'SiteController@getAdvMountainList'])->where('getAdvMountainList', '(?i)getAdvMountainList(?-i)');
	Route::post('{getFameMountainList}' , [ 'as' => 'getFameMountainList', 'uses' => 'SiteController@getFameMountainList'])->where('getFameMountainList', '(?i)getFameMountainList(?-i)');
	Route::post('{saveRoleSettings}' , [ 'as' => 'saveRoleSettings', 'uses' => 'SiteController@saveRoleSettings'])->where('saveRoleSettings', '(?i)saveRoleSettings(?-i)');
	Route::post('{getMountainJudges}' , [ 'as' => 'getMountainJudges', 'uses' => 'SiteController@getMountainJudges'])->where('getMountainJudges', '(?i)getMountainJudges(?-i)');
	//user
	Route::post('{getUserList}' , [ 'as' => 'getUserList', 'uses' => 'SiteController@getUserList'])->where('getUserList', '(?i)getUserList(?-i)');
	
	// Profession

	Route::get('{getProfession}' , [ 'as' => 'getProfession', 'uses' => 'SiteController@getProfession'])->where('getProfession', '(?i)getProfession(?-i)');

	Route::post('{saveProfession}' , [ 'as' => 'saveProfession', 'uses' => 'SiteController@saveProfession'])->where('saveProfession', '(?i)saveProfession(?-i)');

	Route::post('{deleteProfession}' , [ 'as' => 'deleteProfession', 'uses' => 'SiteController@deleteProfession'])->where('deleteProfession', '(?i)deleteProfession(?-i)');
	

});	

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);