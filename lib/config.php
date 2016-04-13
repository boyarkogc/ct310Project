<?php
/*
 * Defines configuration variables for our site
 */
class config{
	//public $url_local    = '/courses/ct310/yr2016sp/aplay/lec21/';
	public $url_public   = '/~ct310/yr2016sp/aplay/lec20/';
	public $base_url     = '';  /* Selected below based upon server */
	public $site_name    = "CT 310: Handling File Uploads";
	public $site_lmod    = "3/20/16";
	public $matience     = false;
	public $session_name = "File Upload Example";
	//public $up_local     =  "/Users/ross/Active/eclipse/mars/courses/ct310/yr2016sp/aplay/lec21/uploads/";
	public $up_public    = "./uploads/";
	public $upload_dir   = ''; /* Selected below based upon server */
	public $pad_length   = 6; 
}

$config = new config();

/* Select the proper base_url for development vs. public server */
//$test_local_p = (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', "::1")));
//$config->base_url   = $test_local_p ? $config->url_local : $config->url_public;
//$config->upload_dir = $test_local_p ? $config->up_local : $config->up_public;
$config->base_url = $config->url_public;
$config->upload_dir = $config->up_public;