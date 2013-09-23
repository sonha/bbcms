<?php

/**
 * BBCMS - A PHP CMS for web newspapers
 *
 * @package  BBCMS
 * @version  1.0
 * @author   BinhBEER <binhbeer@taymay.vn>
 * @link     http://cms.binhbeer.com
 */

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		// Get all the news posts
		$this->data['posts'] = Post::where('post_type', 'post')->where('status', 'published')->where('showon_homepage', 1)->with(array(
			'author' => function($query)
			{
				$query->withTrashed();
			},
		))->orderBy('publish_date', 'DESC')->paginate();

		return View::make('frontend/home', $this->data);
	}

}