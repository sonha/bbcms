<?php

/**
 * BBCMS - A PHP CMS for web newspapers
 *
 * @package  BBCMS
 * @version  1.0
 * @author   BinhBEER <binhbeer@taymay.vn>
 * @link     http://cms.binhbeer.com
 */

class AuthorizedController extends BaseController {

	/**
	 * Whitelisted auth routes.
	 *
	 * @var array
	 */
	protected $whitelist = array();

	/**
	 * Initializer.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// Apply the auth filter
		$this->beforeFilter('auth', array('except' => $this->whitelist));

		// Call parent
		parent::__construct();
	}

}
