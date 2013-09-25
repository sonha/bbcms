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
use Comment;
use Redirect;
use Sentry;
use Str;
use Validator;
use View;

class CommentsController extends AdminController {

	/**
	 * Show a list of all the news posts.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		$status = Input::get('status');
		// Grab all the news posts
		if($status) {
			$comments = Comment::where('status', $status)->orderBy('created_at', 'DESC')->paginate(20);
		} else {
			$comments = Comment::orderBy('created_at', 'DESC')->paginate(20);
		}

		// Show the page
		return View::make('backend/comments/index', compact('comments', 'status'));
	}
	/**
	 * Comment update.
	 *
	 * @param  int  $cmtId
	 * @return View
	 */
	public function getEdit($cmtId = null)
	{
		if ( !Sentry::getUser()->hasAnyAccess(['news','news.editcomment']) )
			return View::make('backend/notallow');

		// Check if the news category exists
		if (is_null($comment = Comment::find($cmtId)))
		{
			// Redirect to the news management page
			return Redirect::to('admin/comments')->with('error', Lang::get('admin/comments/message.does_not_exist'));
		}

		// Show the page
		return View::make('backend/comments/edit', compact('comment'));
	}

	/**
	 * Comment update form processing page.
	 *
	 * @param  int  $postId
	 * @return Redirect
	 */
	public function postEdit($cmtId = null)
	{
		if ( !Sentry::getUser()->hasAnyAccess(['news','news.editcomment']) )
			return View::make('backend/notallow');

		// Check if the news post exists
		if (is_null($comment = Comment::find($cmtId)))
		{
			// Redirect to the news management page
			return Redirect::to('admin/comments')->with('error', Lang::get('admin/comments/message.does_not_exist'));
		}

		// Declare the rules for the form validation
		$rules = array(
			'content'   => 'required|min:3',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		// Update the comment data
		$comment->content            = Input::get('content');
		$comment->status            = e(Input::get('status'));

		// Was the comment updated?
		if($comment->save())
		{
			// Redirect to the new news post page
			return Redirect::to("admin/comments/$cmtId/edit")->with('success', Lang::get('admin/comments/message.update.success'));
		}

		// Redirect to the news post management page
		return Redirect::to("admin/comments/$cmtId/edit")->with('error', Lang::get('admin/comments/message.update.error'));
	}

	/**
	 * Delete the given news post.
	 *
	 * @param  int  $cmtId
	 * @return Redirect
	 */
	public function getDelete($cmtId)
	{
		if ( !Sentry::getUser()->hasAnyAccess(['news','news.deletecomment']) )
			return View::make('backend/notallow');

		// Check if the news post exists
		if (is_null($comment = Comment::find($cmtId)))
		{
			// Redirect to the news management page
			return Redirect::to('admin/comments')->with('error', Lang::get('admin/comments/message.not_found'));
		}

		// Delete the news post
		$comment->delete();

		// Redirect to the news posts management page
		return Redirect::to('admin/comments')->with('success', Lang::get('admin/comments/message.delete.success'));
	}
}