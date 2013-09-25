<?php

/**
 * BBCMS - A PHP CMS for web newspapers
 *
 * @package  BBCMS
 * @version  1.0
 * @author   BinhBEER <binhbeer@taymay.vn>
 * @link     http://cms.binhbeer.com
 */

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Register all the admin routes.
|
*/

Route::group(array('prefix' => 'admin'), function()
{

	# News Management
	Route::group(array('prefix' => 'news'), function()
	{
		Route::get('/', array('as' => 'news', 'uses' => 'Controllers\Admin\NewsController@getIndex'));
		Route::get('search', array('as' => 'search/news', 'uses' => 'Controllers\Admin\NewsController@getSearch'));
		Route::get('create', array('as' => 'create/news', 'uses' => 'Controllers\Admin\NewsController@getCreate'));
		Route::get('postlist', array('as' => 'list/news', 'uses' => 'Controllers\Admin\NewsController@getPostList'));	
		Route::post('create', 'Controllers\Admin\NewsController@postCreate');
		Route::post('setcover', 'Controllers\Admin\NewsController@postSetCover');
		Route::post('setcategory', 'Controllers\Admin\NewsController@postSetCategory');
		Route::get('{NewsId}/edit', array('as' => 'update/news', 'uses' => 'Controllers\Admin\NewsController@getEdit'));
		Route::post('{NewsId}/edit', 'Controllers\Admin\NewsController@postEdit');
		Route::get('{NewsId}/delete', array('as' => 'delete/news', 'uses' => 'Controllers\Admin\NewsController@getDelete'));
		Route::get('{NewsId}/restore', array('as' => 'restore/news', 'uses' => 'Controllers\Admin\NewsController@getRestore'));
	});

	# Categories Management
	Route::group(array('prefix' => 'categories'), function()
	{
		Route::get('/', array('as' => 'categories', 'uses' => 'Controllers\Admin\CategoriesController@getIndex'));
		Route::get('create', array('as' => 'create/category', 'uses' => 'Controllers\Admin\CategoriesController@getCreate'));
		Route::post('create', 'Controllers\Admin\CategoriesController@postCreate');
		Route::get('{catId}/edit', array('as' => 'update/category', 'uses' => 'Controllers\Admin\CategoriesController@getEdit'));
		Route::post('{catId}/edit', 'Controllers\Admin\CategoriesController@postEdit');
		Route::get('{catId}/delete', array('as' => 'delete/category', 'uses' => 'Controllers\Admin\CategoriesController@getDelete'));
	});

	# Tags Management
	Route::group(array('prefix' => 'tags'), function()
	{
		Route::get('/', array('as' => 'tags', 'uses' => 'Controllers\Admin\TagsController@getIndex'));
		Route::get('/listpopup', array('as' => 'list/tag', 'uses' => 'Controllers\Admin\TagsController@getIndexPopup'));
		Route::post('addposts', 'Controllers\Admin\TagsController@postAddPost');
		Route::get('create', array('as' => 'create/tag', 'uses' => 'Controllers\Admin\TagsController@getCreate'));
		Route::post('ajaxcreate', 'Controllers\Admin\TagsController@postCreateTag');
		Route::get('ajaxlist', 'Controllers\Admin\TagsController@getAjaxList');
		Route::get('removepost', array('as' => 'removepost/tag', 'uses' => 'Controllers\Admin\TagsController@removePost'));
		Route::post('create', 'Controllers\Admin\TagsController@postCreate');
		Route::get('{tagId}/edit', array('as' => 'update/tag', 'uses' => 'Controllers\Admin\TagsController@getEdit'));
		Route::post('{tagId}/edit', 'Controllers\Admin\TagsController@postEdit');
		Route::get('{tagId}/delete', array('as' => 'delete/tag', 'uses' => 'Controllers\Admin\TagsController@getDelete'));
	});

	# Pages Management
	Route::group(array('prefix' => 'pages'), function()
	{
		Route::get('/', array('as' => 'pages', 'uses' => 'Controllers\Admin\PagesController@getIndex'));
		Route::get('create', array('as' => 'create/page', 'uses' => 'Controllers\Admin\PagesController@getCreate'));
		Route::post('create', 'Controllers\Admin\PagesController@postCreate');	
		Route::get('{pageId}/edit', array('as' => 'update/page', 'uses' => 'Controllers\Admin\PagesController@getEdit'));
		Route::post('{pageId}/edit', 'Controllers\Admin\PagesController@postEdit');
		Route::get('{pageId}/delete', array('as' => 'delete/page', 'uses' => 'Controllers\Admin\PagesController@getDelete'));
	});

	# Comments Management
	Route::group(array('prefix' => 'comments'), function()
	{
		Route::get('/', array('as' => 'comments', 'uses' => 'Controllers\Admin\CommentsController@getIndex'));
		Route::get('{cmtId}/edit', array('as' => 'update/comment', 'uses' => 'Controllers\Admin\CommentsController@getEdit'));
		Route::post('{cmtId}/edit', 'Controllers\Admin\CommentsController@postEdit');
		Route::get('{cmtId}/delete', array('as' => 'delete/comment', 'uses' => 'Controllers\Admin\CommentsController@getDelete'));
	});

	# Medias Management
	Route::group(array('prefix' => 'medias'), function()
	{
		Route::get('/', 'Controllers\Admin\MediasController@getIndex');
		Route::get('upload', array('as' => 'upload/media', 'uses' => 'Controllers\Admin\MediasController@getUpload'));
		Route::post('upload', 'Controllers\Admin\MediasController@postUpload');
		Route::get('my', 'Controllers\Admin\MediasController@getMy');
		Route::get('{mediaId}/delete', array('as' => 'delete/media', 'uses' => 'Controllers\Admin\MediasController@getDelete'));
	});

	# User Management
	Route::group(array('prefix' => 'users'), function()
	{
		Route::get('/', array('as' => 'users', 'uses' => 'Controllers\Admin\UsersController@getIndex'));
		Route::get('create', array('as' => 'create/user', 'uses' => 'Controllers\Admin\UsersController@getCreate'));
		Route::post('create', 'Controllers\Admin\UsersController@postCreate');
		Route::get('{userId}/edit', array('as' => 'update/user', 'uses' => 'Controllers\Admin\UsersController@getEdit'));
		Route::post('{userId}/edit', 'Controllers\Admin\UsersController@postEdit');
		Route::get('{userId}/delete', array('as' => 'delete/user', 'uses' => 'Controllers\Admin\UsersController@getDelete'));
		Route::get('{userId}/restore', array('as' => 'restore/user', 'uses' => 'Controllers\Admin\UsersController@getRestore'));
	});

	# Group Management
	Route::group(array('prefix' => 'groups'), function()
	{
		Route::get('/', array('as' => 'groups', 'uses' => 'Controllers\Admin\GroupsController@getIndex'));
		Route::get('create', array('as' => 'create/group', 'uses' => 'Controllers\Admin\GroupsController@getCreate'));
		Route::post('create', 'Controllers\Admin\GroupsController@postCreate');
		Route::get('{groupId}/edit', array('as' => 'update/group', 'uses' => 'Controllers\Admin\GroupsController@getEdit'));
		Route::post('{groupId}/edit', 'Controllers\Admin\GroupsController@postEdit');
		Route::get('{groupId}/delete', array('as' => 'delete/group', 'uses' => 'Controllers\Admin\GroupsController@getDelete'));
		Route::get('{groupId}/restore', array('as' => 'restore/group', 'uses' => 'Controllers\Admin\GroupsController@getRestore'));
	});

	# Dashboard
	Route::get('/', array('as' => 'admin', 'uses' => 'Controllers\Admin\DashboardController@getIndex'));

});

/*
|--------------------------------------------------------------------------
| Authentication and Authorization Routes
|--------------------------------------------------------------------------
|
|
|
*/

Route::group(array('prefix' => 'auth'), function()
{

	# Login
	Route::get('signin', array('as' => 'signin', 'uses' => 'AuthController@getSignin'));
	Route::post('signin', 'AuthController@postSignin');

	# Register
	Route::get('signup', array('as' => 'signup', 'uses' => 'AuthController@getSignup'));
	Route::post('signup', 'AuthController@postSignup');

	# Account Activation
	Route::get('activate/{activationCode}', array('as' => 'activate', 'uses' => 'AuthController@getActivate'));

	# Forgot Password
	Route::get('forgot-password', array('as' => 'forgot-password', 'uses' => 'AuthController@getForgotPassword'));
	Route::post('forgot-password', 'AuthController@postForgotPassword');

	# Forgot Password Confirmation
	Route::get('forgot-password/{passwordResetCode}', array('as' => 'forgot-password-confirm', 'uses' => 'AuthController@getForgotPasswordConfirm'));
	Route::post('forgot-password/{passwordResetCode}', 'AuthController@postForgotPasswordConfirm');

	# Logout
	Route::get('logout', array('as' => 'logout', 'uses' => 'AuthController@getLogout'));

});

/*
|--------------------------------------------------------------------------
| Account Routes
|--------------------------------------------------------------------------
|
|
|
*/

Route::group(array('prefix' => 'account'), function()
{

	# Account Dashboard
	Route::get('/', array('as' => 'account', 'uses' => 'Controllers\Account\DashboardController@getIndex'));

	# Profile
	Route::get('profile', array('as' => 'profile', 'uses' => 'Controllers\Account\ProfileController@getIndex'));
	Route::post('profile', 'Controllers\Account\ProfileController@postIndex');

	# Change Password
	Route::get('change-password', array('as' => 'change-password', 'uses' => 'Controllers\Account\ChangePasswordController@getIndex'));
	Route::post('change-password', 'Controllers\Account\ChangePasswordController@postIndex');

	# Change Email
	Route::get('change-email', array('as' => 'change-email', 'uses' => 'Controllers\Account\ChangeEmailController@getIndex'));
	Route::post('change-email', 'Controllers\Account\ChangeEmailController@postIndex');

});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Medias Routes
|--------------------------------------------------------------------------
|
|
|
*/
Route::get('medias/upload', 'MediasController@getUpload');
Route::post('medias/upload', 'MediasController@postUpload');
Route::get('medias/my', 'MediasController@getMy');
Route::get('medias/index', 'MediasController@getIndex');

Route::get('about-us', function()
{
	//
	return View::make('frontend/about-us');
});

Route::get('lien-he', array('as' => 'lien-he', 'uses' => 'ContactUsController@getIndex'));
Route::post('lien-he', 'ContactUsController@postIndex');

Route::get('page/{pageSlug}', array('as' => 'view-page', 'uses' => 'PagesController@getView'))
	->where(array( 'pageSlug' => '[A-Za-z0-9\-]+'));

Route::get('{catSlug}/{postSlug}', array('as' => 'view-post', 'uses' => 'NewsController@getView'))
	->where(array('catSlug' => '[A-Za-z0-9\-]+', 'postSlug' => '[A-Za-z0-9\-]+'));
Route::post('{catSlug}/{postSlug}', 'NewsController@postView');

Route::get('/', array('as' => 'home', 'uses' => 'HomeController@showWelcome'));
