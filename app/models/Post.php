<?php

/**
 * BBCMS - A PHP CMS for web newspapers
 *
 * @package  BBCMS
 * @version  1.0
 * @author   BinhBEER <binhbeer@taymay.vn>
 * @link     http://cms.binhbeer.com
 */

class Post extends Eloquent {

	/**
	 * Indicates if the model should soft delete.
	 *
	 * @var bool
	 */
	protected $softDelete = true;
	
	/**
	 * Deletes a news post and all the associated comments.
	 *
	 * @return bool
	 */
	public function delete()
	{
		// Delete the comments
		$this->comments()->delete();

		// Delete reference cates
		$this->removeCate();
		
		// Delete the news post
		return parent::delete();
	}

	/**
	 * Returns a formatted post content entry, this ensures that
	 * line breaks are returned.
	 *
	 * @return string
	 */
	public function content()
	{
		return $this->content;
	}

	/**
	 * Return the post's author.
	 *
	 * @return User
	 */
	public function author()
	{
		return $this->belongsTo('User', 'user_id');
	}

	/**
	 * Return how many comments this post has.
	 *
	 * @return array
	 */
	public function comments()
	{
		return $this->hasMany('Comment');
	}

	/**
	 * Return the URL to the post.
	 *
	 * @return string
	 */
	public function url()
	{
		return URL::route('view-post', array($this->category->slug, $this->slug));
	}

	/**
	 * Return the post thumbnail image url.
	 *
	 * @return string
	 */
	public function thumbnail()
	{
		# you should save the image url on the database
		# and return that url here.

		return $this->belongsTo('Media', 'media_id');
	}

	public function category() {
		return $this->belongsTo('Category','category_id');
		// return $this->hasMany('CategoryPost','id');
	}

	public function categories() {
		return $this->belongsToMany('Category','category_post','post_id','category_id');
		// return $this->hasMany('CategoryPost','id');
	}

	public function categoryposts() {
		return $this->hasMany('CategoryPost');
		// return $this->hasMany('CategoryPost','id');
	}

	public function removeCate() {
		$this->categoryposts()->delete();
	}
}
