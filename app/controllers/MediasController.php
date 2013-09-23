<?php

/**
 * BBCMS - A PHP CMS for web newspapers
 *
 * @package  BBCMS
 * @version  1.0
 * @author   BinhBEER <binhbeer@taymay.vn>
 * @link     http://cms.binhbeer.com
 */

class MediasController extends AdminController {

	public function postUpload() {
        $rules = array(
            'picture' => 'image|max:2500|mimes:jpg,jpeg,png'
        );
        $validation = Validator::make(Input::all(), $rules);
        if ($validation->fails())
        {
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
        }

    	$upload = Image::upload(Input::file('picture'), 'medias', true);

        if($upload){

            // save to database
            $media = new Media;
            $media->mpath = $upload['folder'];
            $media->mname = $upload['name'];
            $media->user_id = Sentry::getId();
            $media->save();
            echo $upload['folder'].'/520x500/'.$upload['name'];
        } else {
			echo "Tải ảnh không thành công!";
		}
	}

	public function getUpload() {
		return View::make('medias/upload');
	}

    public function getIndex() {
        $images = array();
        // Get all the news posts
        $images = Media::orderBy('created_at', 'DESC')->paginate(8);

        return View::make('medias/index', compact('images'));
    }

	public function getMy() {
		$images = array();
		// Get all the news posts
		$images = Media::where("user_id", Sentry::getId())->orderBy('created_at', 'DESC')->paginate(8);

		return View::make('medias/my', compact('images'));
	}
}