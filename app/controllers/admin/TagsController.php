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
use Tag;
use TagPost;
use Redirect;
use Sentry;
use Str;
use Validator;
use View;

class TagsController extends AdminController {	
	/**
	 * Show a list of all the tags.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		// Grab all the tags
		$tags = Tag::where('type', 'topic')->orderBy('created_at', 'DESC')->get();

		// Show the page
		return View::make('backend/tags/index', compact('tags'));
	}

	public function getIndexPopup()
	{
		$keyword = Input::get('keyword');
		$order = Input::get('order');
		$keyslug = Str::slug($keyword);
		// Grab all the tags
		$tags = Tag::where('slug', 'like', '%'.$keyslug.'%')->where('type', 'topic')->where('status', 'on')->orderBy('created_at', ($order ? $order : 'desc'))->paginate(10);

		// Show the page
		return View::make('backend/tags/indexpopup', compact('tags', 'keyword', 'order'));
	}

	/**
	 * News tag list.
	 *
	 * @return Redirect
	 */
	public function getAjaxList()
	{
		$keyword = Str::slug(Input::get('keyword'));
		// Grab all the tags
		$tags = Tag::select('name')->where('slug', 'like', '%'.$keyword.'%')->where('type', 'tag')->where('status', 'on')->orderBy('created_at', 'desc')->take(10)->get();

		return $tags->toJson();
	}
	/**
	 * Tags create.
	 *
	 * @return View
	 */
	public function getCreate()
	{
		if ( !Sentry::getUser()->hasAnyAccess(['news','news.createtag']) )
			return View::make('backend/notallow');

		// Show the page
		return View::make('backend/tags/create');
	}

	/**
	 * News tag create form processing.
	 *
	 * @return Redirect
	 */
	public function postCreateTag()
	{
		if ( !Sentry::getUser()->hasAnyAccess(['news','news.createtag']) )
			return View::make('backend/notallow');

		// Declare the rules for the form validation
		$rules = array(
			'name'   => 'required|min:3'
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return false;
		}
		$tagName = Input::get('name');
		$tagSlug = Str::slug($tagName);

		$tag = Tag::where('slug', $tagSlug)->first();

		if(is_null($tag)) {
			// Create a new news tag
			$tag = new Tag;
			$tag->name            	= $tagName;
			$tag->slug              = $tagSlug;
			$tag->status            = 'on';
			$tag->type           	= 'tag';
			$tag->user_id           = Sentry::getId();
			if(!$tag->save()) {
				return false;
			}
		}

		return $tag->toJson();
	}

	/**
	 * News tag create form processing.
	 *
	 * @return Redirect
	 */
	public function postCreate()
	{
		if ( !Sentry::getUser()->hasAnyAccess(['news','news.createtag']) )
			return View::make('backend/notallow');

		// Declare the rules for the form validation
		$rules = array(
			'name'   => 'required|min:3',
			'type' => 'required',
			'status' => 'required'
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		// Create a new news tag
		$tag = new Tag;

		// Update the news tag data
		$tag->name            	= Input::get('name');
		$tag->slug             = e(Str::slug(Input::get('name')));
		if(!is_null($existTag = Tag::where('slug', $tag->slug)->first())) {
			return Redirect::to("admin/tags/$existTag->id/edit")->with('success', Lang::get('admin/tags/message.update.success'));
		}

		$tag->status            = e(Input::get('status'));
		$tag->type           	= e(Input::get('type'));
		$tag->user_id           = Sentry::getId();

		// Was the news tag created?
		if($tag->save())
		{
			// Redirect to the new news tag page
			return Redirect::to("admin/tags/$tag->id/edit")->with('success', Lang::get('admin/tags/message.create.success'));
		}

		// Redirect to the news tag create page
		return Redirect::to('admin/tags/create')->with('error', Lang::get('admin/tags/message.create.error'));
	}

	/**
	 * News tag update.
	 *
	 * @param  int  $tagId
	 * @return View
	 */
	public function getEdit($tagId = null)
	{
		if ( !Sentry::getUser()->hasAnyAccess(['news','news.edittag']) )
			return View::make('backend/notallow');

		// Check if the news tag exists
		if (is_null($tag = Tag::find($tagId)))
		{
			// Redirect to the news management page
			return Redirect::to('admin/tags')->with('error', Lang::get('admin/tags/message.does_not_exist'));
		}

		$postlist = $tag->posts;

		// Show the page
		return View::make('backend/tags/edit', compact('tag', 'postlist'));
	}

	/**
	 * News tag update form processing page.
	 *
	 * @param  int  $tagId
	 * @return Redirect
	 */
	public function postEdit($tagId = null)
	{
		if ( !Sentry::getUser()->hasAnyAccess(['news','news.edittag']) )
			return View::make('backend/notallow');

		// Check if the news tag exists
		if (is_null($tag = Tag::find($tagId)))
		{
			// Redirect to the news management page
			return Redirect::to('admin/tags')->with('error', Lang::get('admin/tags/message.does_not_exist'));
		}

		// Declare the rules for the form validation
		$rules = array(
			'name'   => 'required|min:3',
			'type' => 'required',
			'status' => 'required'
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		// Update the news post data
		$tag->name            	= Input::get('name');
		$tag->slug             = e(Str::slug(Input::get('name')));
		if(!is_null($existTag = Tag::where('slug', $tag->slug)->first())) {
			return Redirect::to("admin/tags/$existTag->id/edit")->with('success', Lang::get('admin/tags/message.update.success'));
		}

		$tag->status            = e(Input::get('status'));
		$tag->type           	= e(Input::get('type'));

		// Was the news post updated?
		if($tag->save())
		{
			// Redirect to the new news tag page
			return Redirect::to("admin/tags/$tagId/edit")->with('success', Lang::get('admin/tags/message.update.success'));
		}

		// Redirect to the tags tag management page
		return Redirect::to("admin/tags/$tagId/edit")->with('error', Lang::get('admin/tags/message.update.error'));
	}

	public function postAddPost() {

		// Declare the rules for the form validation
		$rules = array(
			'tag_id'   => 'required'
		);
		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		$tagId = e(Input::get('tag_id'));

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Redirect to the tags tag management page
			return Redirect::to("admin/tags/$tagId/edit")->with('error', Lang::get('admin/tags/message.update.error'));
		}

		if(Input::get('postids'))
  		{
  			foreach(Input::get('postids') as $postId)
  			{
  				$tagpost = new TagPost;
  				$tagpost->tag_id = $tagId;
  				$tagpost->post_id = $postId;
  				$tagpost->save();
  			}
  		}

		// Redirect to the new tag page
		return Redirect::to("admin/tags/$tagId/edit")->with('success', Lang::get('admin/tags/message.update.success'));
	}

	public function removePost() {		
		$rules = array(
			'tag_id'   => 'required',
			'post_id'   => 'required'
		);

		$postId = e(Input::get('post_id'));
		$tagId = e(Input::get('tag_id'));
		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Redirect to the tags tag management page
			return Redirect::to("admin/tags/$tagId/edit")->with('error', Lang::get('admin/tags/message.update.error'));
		}

		$tagpost = TagPost::where('tag_id', $tagId)->where('post_id', $postId)->first();
		if($tagpost) {
			$tagpost->delete();
		}
		// Redirect to the new tag page
		return Redirect::to("admin/tags/$tagId/edit")->with('success', Lang::get('admin/tags/message.update.success'));
	}

	/**
	 * Delete the given news tag.
	 *
	 * @param  int  $tagId
	 * @return Redirect
	 */
	public function getDelete($tagId)
	{
		if ( !Sentry::getUser()->hasAnyAccess(['news','news.deletetag']) )
			return View::make('backend/notallow');

		// Check if the news post exists
		if (is_null($tag = Tag::find($tagId)))
		{
			// Redirect to the news management page
			return Redirect::to('admin/tags')->with('error', Lang::get('admin/tag/message.not_found'));
		}

		// Delete the tags tag
		$tag->delete();

		// Redirect to the tags management page
		return Redirect::to('admin/tags')->with('success', Lang::get('admin/tags/message.delete.success'));
	}
}