<?php namespace Controllers\Admin;

/**
 * BBCMS - A PHP CMS for web newspapers
 *
 * @package  BBCMS
 * @version  1.0
 * @author   BinhBEER <binhbeer@taymay.vn>
 * @link     http://cms.binhbeer.com
 */

use AdminController;
use Input;
use Lang;
use Post;
use Media;
use Redirect;
use Sentry;
use Str;
use Validator;
use View;

class PagesController extends AdminController {

	/**
	 * Show a list of all the pages.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		// Grab all the pages
		$posts = Post::where('post_type', 'page')->orderBy('created_at', 'DESC')->paginate(30);

		// Show the page
		return View::make('backend/pages/index', compact('posts'));
	}

	/**
	 * Page create.
	 *
	 * @return View
	 */
	public function getCreate()
	{
		if ( !Sentry::getUser()->hasAnyAccess(['news','pages.create']) )
			return View::make('backend/notallow');

		// Show the page
		return View::make('backend/pages/create', compact('categories'));
	}

	/**
	 * Page create form processing.
	 *
	 * @return Redirect
	 */
	public function postCreate()
	{
		if ( !Sentry::getUser()->hasAnyAccess(['pages','pages.create']) )
			return View::make('backend/notallow');

		// Declare the rules for the form validation
		$rules = array(
			'title'   => 'required|min:3',
			'excerpt' => 'required|min:3',
			'content' => 'required|min:3',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		// Create a new page
		$post = new Post;

		// Update the page data
		$post->title            = e(Input::get('title'));
		$post->slug             = e(Str::slug(Input::get('title')));
		$post->excerpt          = Input::get('excerpt');
		$post->content          = Input::get('content');
		$post->media_id     	= e(Input::get('media_id'));
		$post->status          	= e(Input::get('status'));
		$post->post_type        = 'page';
		$post->user_id          = Sentry::getId();

		// Was the page created?
		if($post->save())
		{
			// Redirect to the new page
			return Redirect::to("admin/pages/$post->id/edit")->with('success', Lang::get('admin/pages/message.create.success'));
		}

		// Redirect to the page create
		return Redirect::to('admin/pages/create')->with('error', Lang::get('admin/pages/message.create.error'));
	}

	/**
	 * Page update.
	 *
	 * @param  int  $postId
	 * @return View
	 */
	public function getEdit($postId = null)
	{
		if ( !Sentry::getUser()->hasAnyAccess(['pages','pages.edit']) )
			return View::make('backend/notallow');

		// Check if the page exists
		if (is_null($post = Post::find($postId)))
		{
			// Redirect to the pages management
			return Redirect::to('admin/pages')->with('error', Lang::get('admin/pages/message.does_not_exist'));
		}

		$media = null;
		if($post->media_id) {
			$media = Media::find($post->media_id);
		}
		
		// Show the page
		return View::make('backend/pages/edit', compact('post', 'media'));
	}

	/**
	 * Page update form processing page.
	 *
	 * @param  int  $postId
	 * @return Redirect
	 */
	public function postEdit($postId = null)
	{
		if ( !Sentry::getUser()->hasAnyAccess(['pages','pages.edit']) )
			return View::make('backend/notallow');

		// Check if the page exists
		if (is_null($post = Post::find($postId)))
		{
			// Redirect to the pages management
			return Redirect::to('admin/pages')->with('error', Lang::get('admin/pages/message.does_not_exist'));
		}

		// Declare the rules for the form validation
		$rules = array(
			'title'   => 'required|min:3',
			'excerpt' => 'required|min:3',
			'content' => 'required|min:3',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		// Update the page data
		$post->title            = e(Input::get('title'));
		$post->slug             = e(Str::slug(Input::get('title')));
		$post->excerpt          = Input::get('excerpt');
		$post->content          = Input::get('content');
		$post->media_id     	= e(Input::get('media_id'));
		$post->status          	= e(Input::get('status'));
		$post->post_type        = 'page';

		// Was the page updated?
		if($post->save())
		{
			// Redirect to the new page
			return Redirect::to("admin/pages/$postId/edit")->with('success', Lang::get('admin/pages/message.update.success'));
		}

		// Redirect to the pages management
		return Redirect::to("admin/pages/$postId/edit")->with('error', Lang::get('admin/pages/message.update.error'));
	}

	/**
	 * Delete the given page.
	 *
	 * @param  int  $postId
	 * @return Redirect
	 */
	public function getDelete($postId)
	{
		if ( !Sentry::getUser()->hasAnyAccess(['pages','pages.delete']) )
			return View::make('backend/notallow');

		// Check if the page exists
		if (is_null($post = Post::find($postId)))
		{
			// Redirect to the pages management
			return Redirect::to('admin/pages')->with('error', Lang::get('admin/pages/message.not_found'));
		}

		// Delete the page
		$post->delete();

		// Redirect to the pages management
		return Redirect::to('admin/pages')->with('success', Lang::get('admin/pages/message.delete.success'));
	}
}