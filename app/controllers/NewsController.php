<?php

/**
 * BBCMS - A PHP CMS for web newspapers
 *
 * @package  BBCMS
 * @version  1.0
 * @author   BinhBEER <binhbeer@taymay.vn>
 * @link     http://cms.binhbeer.com
 */

class NewsController extends BaseController {

	/**
	 * Returns all the news posts.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		// Get all the news posts
		$posts = Post::with(array(
			'author' => function($query)
			{
				$query->withTrashed();
			},
		))->orderBy('created_at', 'DESC')->paginate();

		// Show the page
		return View::make('frontend/news/index', compact('posts'));
	}

	/**
	 * View a news post.
	 *
	 * @param  string  $slug
	 * @return View
	 * @throws NotFoundHttpException
	 */
	public function getView($catSlug, $slug)
	{
		// Get this news post data
		$this->data['post'] = $post = Post::with(array(
			'author' => function($query)
			{
				$query->withTrashed();
			},
			'comments',
		))->where('slug', $slug)->first();

		// Check if the news post exists
		if (is_null($post))
		{
			// If we ended up in here, it means that a page or a news post
			// don't exist. So, this means that it is time for 404 error page.
			return App::abort(404);
		}

		// Get this post comments
		$this->data['comments'] = $post->comments()->with(array(
			'author' => function($query)
			{
				$query->withTrashed();
			},
		))->orderBy('created_at', 'DESC')->get();

		// Show the page
		return View::make('frontend/news/view-post', $this->data);
	}

	/**
	 * View a news post.
	 *
	 * @param  string  $slug
	 * @return Redirect
	 */
	public function postView($catSlug, $slug)
	{
		// The user needs to be logged in, make that check please
		if ( ! Sentry::check())
		{
			return Redirect::to("news/$slug#comments")->with('error', 'You need to be logged in to post comments!');
		}

		// Get this news post data
		$post = Post::where('slug', $slug)->first();

		// Declare the rules for the form validation
		$rules = array(
			'comment' => 'required|min:3',
		);

		// Create a new validator instance from our dynamic rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now
		if ($validator->fails())
		{
			// Redirect to this news post page
			return Redirect::to("news/$slug#comments")->withInput()->withErrors($validator);
		}

		// Save the comment
		$comment = new Comment;
		$comment->user_id = Sentry::getUser()->id;
		$comment->content = e(Input::get('comment'));

		// Was the comment saved with success?
		if($post->comments()->save($comment))
		{
			// Redirect to this news post page
			return Redirect::to("news/$slug#comments")->with('success', 'Your comment was successfully added.');
		}

		// Redirect to this news post page
		return Redirect::to("news/$slug#comments")->with('error', 'There was a problem adding your comment, please try again.');
	}

}
