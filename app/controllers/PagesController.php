<?php

/**
 * BBCMS - A PHP CMS for web newspapers
 *
 * @package  BBCMS
 * @version  1.0
 * @author   BinhBEER <binhbeer@taymay.vn>
 * @link     http://cms.binhbeer.com
 */

class PagesController extends BaseController {

	/**
	 * View a news post.
	 *
	 * @param  string  $slug
	 * @return View
	 * @throws NotFoundHttpException
	 */
	public function getView($slug)
	{
		// Get this news post data
		$this->data['page'] = $page = Post::where('slug', $slug)->first();

		// Check if the news post exists
		if (is_null($page))
		{
			// If we ended up in here, it means that a page or a news post
			// don't exist. So, this means that it is time for 404 error page.
			return App::abort(404);
		}

		// Show the page
		return View::make('frontend/pages/view-page', $this->data);
	}

}