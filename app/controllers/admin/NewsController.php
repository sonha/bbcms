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
use Category;
use CategoryPost;
use PostTag;
use Media;
use DateTime;
use Redirect;
use Sentry;
use Str;
use Validator;
use View;

class NewsController extends AdminController {

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
			$posts = Post::where('post_type', 'post')->where('status', $status)->orderBy('created_at', 'DESC')->paginate(30);
		} else {
			$posts = Post::where('post_type', 'post')->orderBy('created_at', 'DESC')->paginate(30);
		}

		$categories = Category::orderBy('showon_menu', 'ASC')->get();

		// Show the page
		return View::make('backend/news/index', compact('posts', 'categories', 'status'));
	}

	/**
	 * Search post.
	 *
	 * @return View
	 */
	public function getSearch()
	{
		$status = Input::get('status');
		$keyword = Input::get('key');
		$category_id = Input::get('category_id');
		$keyslug = Str::slug($keyword);
		// Grab the news posts
		if($category_id!=0) {
			$posts = Post::where('category_id', '=', $category_id)->where('slug', 'like', '%'.$keyslug.'%')->orderBy('created_at', 'DESC')->paginate(30);
		} else {
			$posts = Post::where('slug', 'like', '%'.$keyslug.'%')->orderBy('created_at', 'DESC')->paginate(30);
		}

		$categories = Category::orderBy('showon_menu', 'ASC')->get();

		// Show the page
		return View::make('backend/news/index', compact('posts', 'categories', 'category_id', 'keyword', 'status'));
	}

	/**
	 * News post create.
	 *
	 * @return View
	 */
	public function getCreate()
	{
		if ( !Sentry::getUser()->hasAnyAccess(['news','news.create']) )
			return View::make('backend/notallow');

		$categories = Category::orderBy('showon_menu', 'ASC')->get();
		// Show the page
		return View::make('backend/news/create', compact('categories'));
	}

	/**
	 * News post create form processing.
	 *
	 * @return Redirect
	 */
	public function postCreate()
	{
		if ( !Sentry::getUser()->hasAnyAccess(['news','news.create']) )
			return View::make('backend/notallow');

		// Declare the rules for the form validation
		$rules = array(
			'title'   => 'required|min:3',
			'excerpt' => 'required|min:3',
			'content' => 'required|min:3'
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		// Create a new news post
		$post = new Post;

		// Update the news post data
		$post->title            = Input::get('title');

		if (Input::get('slug'))
		{
			$post->slug         = $this->slug(Input::get('slug'));
		} else {
			$post->slug         = e(Str::slug(Input::get('title')));
		}

		$post->excerpt          = Input::get('excerpt');
		$post->content          = Input::get('content');
		$post->is_featured      = e(Input::get('is_featured', 0));
		$post->is_popular       = e(Input::get('is_popular', 0));
		$post->showon_homepage	= e(Input::get('showon_homepage', 0));
		$post->allow_comments	= e(Input::get('allow_comments', 0));
		$post->publish_date     = Input::get('publish_date') ? Input::get('publish_date') : new DateTime;
		$post->media_id     	= e(Input::get('media_id'));
		$post->status          	= e(Input::get('status'));

		$post->meta_title       = e(Input::get('meta-title'));
		$post->meta_description = e(Input::get('meta-description'));
		$post->meta_keywords    = e(Input::get('meta-keywords'));
		$post->user_id          = Sentry::getId();

		// Was the news post created?
		if($post->save())
		{
			// Update reference topics
			$topicIds = e(Input::get('topics'));
			if($topicIds) {
	  			$post->insertTags($topicIds);
			}

			// Update reference tags
			$tagIds = e(Input::get('tags'));
			if($tagIds) {
	  			$post->insertTags($tagIds);
			}

			// Update reference categories
			if(Input::get('categories'))
	  		{
	  			foreach(Input::get('categories') as $cateId)
	  			{
	  				$catepost = new CategoryPost;
	  				$catepost->category_id = $cateId;
	  				$catepost->post_id = $post->id;
	  				$catepost->save();
	  			}
	  		}
			// Redirect to the new news post page
			return Redirect::to("admin/news/$post->id/edit")->with('success', Lang::get('admin/news/message.create.success'));
		}

		// Redirect to the news post create page
		return Redirect::to('admin/news/create')->with('error', Lang::get('admin/news/message.create.error'));
	}

	/**
	 * News post update.
	 *
	 * @param  int  $postId
	 * @return View
	 */
	public function getEdit($postId = null)
	{
		if ( !Sentry::getUser()->hasAnyAccess(['news','news.edit']) )
			return View::make('backend/notallow');

		// Check if the news post exists
		if (is_null($post = Post::find($postId)))
		{
			// Redirect to the news management page
			return Redirect::to('admin/news')->with('error', Lang::get('admin/news/message.does_not_exist'));
		}
		$categories = Category::orderBy('showon_menu', 'ASC')->get();
		$post_categories = $post->categoryposts()->get();

		$catIds = array();
		foreach ($post_categories as $cat) {
			$catIds[] = $cat->category_id;
		}
		$media = null;
		if($post->media_id) {
			$media = Media::find($post->media_id);
		}

		$topics = $post->topics;
		$topicIds = array();
		foreach ($topics as $t) {
			$topicIds[] = $t->id;
		}

		$tags = $post->tags;
		$tagIds = array();
		foreach ($tags as $t) {
			$tagIds[] = $t->id;
		}
		
		// Show the page
		return View::make('backend/news/edit', compact('post', 'categories', 'catIds', 'topicIds', 'tagIds', 'media', 'topics', 'tags'));
	}

	/**
	 * News Post update form processing page.
	 *
	 * @param  int  $postId
	 * @return Redirect
	 */
	public function postEdit($postId = null)
	{
		if ( !Sentry::getUser()->hasAnyAccess(['news','news.edit']) )
			return View::make('backend/notallow');

		// Check if the news post exists
		if (is_null($post = Post::find($postId)))
		{
			// Redirect to the news management page
			return Redirect::to('admin/news')->with('error', Lang::get('admin/news/message.does_not_exist'));
		}

		// Declare the rules for the form validation
		$rules = array(
			'title'   => 'required|min:3',
			'excerpt' => 'required|min:3',
			'content' => 'required|min:3',
			'publish_date' => 'required',
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
		$post->title            = e(Input::get('title'));

		if (Input::get('slug')) 
		{
			if((Input::get('slug') != $post->slug))
				$post->slug         = $this->slug(Input::get('slug'));
		} else {
			$post->slug         = e(Str::slug(Input::get('title')));
		}

		$post->excerpt          = Input::get('excerpt');
		$post->content          = Input::get('content');
		$post->is_featured      = e(Input::get('is_featured', 0));
		$post->is_popular       = e(Input::get('is_popular', 0));
		$post->showon_homepage	= e(Input::get('showon_homepage', 0));
		$post->allow_comments	= e(Input::get('allow_comments', 0));
		$post->publish_date     = e(Input::get('publish_date'));
		$post->media_id     	= e(Input::get('media_id'));
		$post->status          	= e(Input::get('status'));

		$post->meta_title       = e(Input::get('meta-title'));
		$post->meta_description = e(Input::get('meta-description'));
		$post->meta_keywords    = e(Input::get('meta-keywords'));

		// Was the news post updated?
		if($post->save())
		{
			// Update reference topics
			$topicIds = e(Input::get('topics'));
			if($topicIds) {
	  			$post->removeTag();
	  			$post->insertTags($topicIds);
			}

			// Update reference tags
			$tagIds = e(Input::get('tags'));
			if($tagIds) {
	  			$post->removeTag();
	  			$post->insertTags($tagIds);
			}

			// Update reference categories
			if(Input::get('categories'))
	  		{
	  			$post->removeCate();
	  			foreach(Input::get('categories') as $cateId)
	  			{
	  				$catepost = new CategoryPost;
	  				$catepost->category_id = $cateId;
	  				$catepost->post_id = $post->id;
	  				$catepost->save();
	  			}
	  		}
			// Redirect to the new news post page
			return Redirect::to("admin/news/$postId/edit")->with('success', Lang::get('admin/news/message.update.success'));
		}

		// Redirect to the news post management page
		return Redirect::to("admin/news/$postId/edit")->with('error', Lang::get('admin/news/message.update.error'));
	}

	/**
	 * Delete the given news post.
	 *
	 * @param  int  $postId
	 * @return Redirect
	 */
	public function getDelete($postId)
	{
		if ( !Sentry::getUser()->hasAnyAccess(['news','news.delete']) )
			return View::make('backend/notallow');

		// Check if the news post exists
		if (is_null($post = Post::find($postId)))
		{
			// Redirect to the news management page
			return Redirect::to('admin/news')->with('error', Lang::get('admin/news/message.not_found'));
		}

		// Delete the news post
		$post->delete();

		// Redirect to the news posts management page
		return Redirect::to('admin/news')->with('success', Lang::get('admin/news/message.delete.success'));
	}
	/**
	 * Set cover image.
	 *
	 * @param  int  $postId
	 * @param  int  $mediaId
	 * @return Redirect
	 */
	public function postSetCover() {

        $rules = array(
            'media_id' => 'required'
        );
        $validation = Validator::make(Input::all(), $rules);
        if ($validation->fails())
        {
            Messages::add('error','Co loi xay ra!');
        }else{
        	$media = Media::find(e(Input::get('media_id')));
        	if (!is_null($post = Post::find(e(Input::get('post_id')))) && !is_null($media))
			{
				$post->media_id = $media->id;
				$post->save();
				return $media->toJson();
			} else if($media) {
				return $media->toJson();
			}
        }
	}
	/**
	 * Set primary category post.
	 *
	 * @param  int  $postId
	 * @param  int  $categoryId
	 * @return Redirect
	 */
	public function postSetCategory() {

        $rules = array(
            'category_id' => 'required'
        );
        $validation = Validator::make(Input::all(), $rules);
        if ($validation->fails())
        {
            Messages::add('error','Co loi xay ra!');
        }else{
        	if (!is_null($post = Post::find(e(Input::get('post_id')))))
			{
				$post->category_id = Input::get('category_id');
				$post->save();
			}
        }
    }


	/**
	 * get news list to modal.
	 *
	 * @param  int  $postId
	 * @param  int  $categoryId
	 * @return Redirect
	 */
	public function getPostList() {

		$tag_id = Input::get('tag_id');
		$keyword = Input::get('keyword');
		$category_id = Input::get('category_id');
		$keyslug = Str::slug($keyword);
		// Grab the news posts
		if($category_id!=0) {
			$posts = Post::where('category_id', '=', $category_id)->where('slug', 'like', '%'.$keyslug.'%')->where('status', 'published')->orderBy('created_at', 'DESC')->paginate(8);
		} else {
			$posts = Post::where('slug', 'like', '%'.$keyslug.'%')->where('status', 'published')->orderBy('created_at', 'DESC')->paginate(8);
		}

		$categories = Category::orderBy('showon_menu', 'ASC')->get();

		// Show the page
		return View::make('backend/news/postlist', compact('posts', 'categories', 'category_id', 'keyword', 'tag_id'));
    }


	/**
	 * Return unique slug.
	 *
	 * @return User
	 */
	public function slug($slug)
	{
		$existPost = Post::where('slug', $slug)->first();

		if (!is_null($existPost)) {
			return $slug.'-'.time();
		}

		return $slug;
	}
}
