<?php

define('SITENAME','prscn');
define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']."/".SITENAME);
define('SITE_PATH', "http://".$_SERVER['HTTP_HOST']."/".SITENAME);



define('SITE_ADMIN','prscn/admin');
define('DOCUMENT_ROOT_ADMIN', $_SERVER['DOCUMENT_ROOT']."/".SITE_ADMIN);
define('SITE_PATH_ADMIN', "http://".$_SERVER['HTTP_HOST']."/".SITE_ADMIN);


define('FILE_UPLOAD_PATH',DOCUMENT_ROOT.'/uploads');

define('FILE_VIEW_PATH',SITE_PATH.'/uploads');

define('FACEBOOK_REDIRECT_URI',SITE_PATH.'/index.php');


define('ROOT', dirname(__FILE__));
define('CONFIG', DOCUMENT_ROOT.'/config');

define('MODELS_ADMIN', DOCUMENT_ROOT_ADMIN.'/models');
define('CONTROLLERS_ADMIN', DOCUMENT_ROOT_ADMIN.'/controllers');
define('VIEWS_ADMIN', DOCUMENT_ROOT_ADMIN.'/views');
define('LIBS_ADMIN', DOCUMENT_ROOT_ADMIN.'/libraries');
define('AJAX_ADMIN', DOCUMENT_ROOT_ADMIN.'/ajax');

define('MODELS', DOCUMENT_ROOT.'/models');
define('CONTROLLERS', DOCUMENT_ROOT.'/controllers');
define('VIEWS', DOCUMENT_ROOT.'/views');
define('LIBS', DOCUMENT_ROOT.'/libraries');
define('AJAX', DOCUMENT_ROOT.'/ajax');

define('MEDIA_ADMIN', SITE_PATH_ADMIN.'/media');
define('IMAGES_ADMIN', MEDIA_ADMIN.'/img/');
define('CSS_ADMIN', MEDIA_ADMIN.'/css/');
define('JS_ADMIN', MEDIA_ADMIN.'/js/');

define('FBPANEL_PATH', DOCUMENT_ROOT.'/FBPanel/');
define('JWPLAYER_PATH', SITE_PATH.'/jwPlayer/');
define('SIMPLECART_PATH', SITE_PATH.'/simpleCart/');



define('MEDIA', SITE_PATH.'/media');
define('IMAGES', MEDIA.'/img/');
define('CSS', MEDIA.'/css/');
define('JS', MEDIA.'/js/');


define('LOG_PATH',DOCUMENT_ROOT.'/log/');
define('LOG_FILE_NAME',date("Y_m_d_H").".txt");
define('SQL_ERROR_FILE_NAME',"query_error_".date("Y_m_d_H").".txt");

define('INVOICE_PATH',DOCUMENT_ROOT.'/document/invoice/');

define('ADMIN_EMAIL','info@gmail.com');

define('RECORD_PER_PAGE',10);
define("CURRENCY","HKD");
#-------------- SMTP ------------- #

define('SMTP_HOST','smtp.gmail.com');      					// sets GMAIL as the SMTP server
define('SMTP_PORT',465);                   					// set the SMTP port for the GMAIL server
define('SMTP_USERNAME',"panky@gmail.com"); 	// GMAIL username
define('SMTP_PASSWORD',"panky");
define('EMAIL_FROM',"panky@gmail.com");
define('EMAIL_FROM_NAME',"Panky");

define('SITE_SESSION','prscn');

define('RESTRICT_UPLOAD_FILE','txt,pdf');


define('DEFAULT_ATHLETES_PROFILE_AVTAR',IMAGES_ADMIN.'default_avatar.jpg');

define('PROCESSING_IMAGE_TYPE_ONE',"<img src='".IMAGES_ADMIN."ajax-loaders/ajax-loader-1.gif' />");
define('PROCESSING_IMAGE_TYPE_TWO',"<img src='".IMAGES_ADMIN."ajax-loaders/ajax-loader-11.gif' />");

define('INVOICE_PATH',DOCUMENT_ROOT.'/document/invoice/');

?>
