<?php

/**
 * BBCMS - A PHP CMS for web newspapers
 *
 * @package  BBCMS
 * @version  1.0
 * @author   BinhBEER <binhbeer@taymay.vn>
 * @link     http://cms.binhbeer.com
 */

return array(
    'library'     => 'gd',
    'upload_dir'  => 'uploads',
    'upload_path' => public_path() . '/uploads/',
    'quality'     => 100,

    'dimensions' => array(
        'thumb'  => array(100, 100, true,  100),
        'thumb1'  => array(150, 80, true,  100),
        'thumb2'  => array(180, 100, true,  100),
        'thumb3'  => array(220, 280, true,  100),
        'thumb4'  => array(260, 130, true,  100),
        'medium' => array(520, 500, false, 100),
        'medium1' => array(500, 350, true, 100),
        'medium2' => array(330, 160, true, 100),
    ),
);