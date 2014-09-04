<?php
/**
 * Plugin Name: FlexyTalk Live Chat
 * Plugin URI: http://www.flexytalk.com
 * Description: FlexTalk - Intuitive, simple but powerful Live Chat solution. Connect from any mobile device or PC  - Free plan available
 * Version: 3.1.7
 * Author: FlexyTalk
 */


function FT_Process()
{
$installation_mode=get_option(ft_installation_mode);

if($installation_mode=="1"){
	echo Get_Code();
	}
}

function Get_Code() {
$datadept=ft_get_dept();
$widget_id=get_option(ft_widget_id);
$htmlCode="<script id='ftcontent' data-flexytalk=".$widget_id." ".$datadept. ">var script = document.createElement('script');script.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + '//www.flexytalk.net/app/v3/js/flexytalk.js';document.getElementsByTagName('head')[0].appendChild(script);
   </script>";
return $htmlCode;
}
function ft_get_dept()
{
$dept_code=get_option(ft_dept);
$deptcodeStr="";

if($dept_code!="" ){
	$deptcodeStr=" data-flexytalk-dept='".$dept_code."' ";
}
return $deptcodeStr;
}
//*************** Admin function ***************
function flexytalk_admin() {
$usr=get_option(ft_username);
$pwd=get_option(ft_password);
if( strlen($usr)>0 && strlen($pwd)>0)
	echo '<iframe src="http://panel.flexytalk.com/account/pluginlogin/'.$usr.'/'.$pwd .'/1" width="100%" height="100%" style="min-height:850px; width:100%" frameborder=0 ></iframe>';
else
include("flexytalk_settings.php");
}




function flexytalk_admin_actions() {

 add_menu_page('FlexyTalk', 'FlexyTalk', 'administrator','flexytalk', 'flexytalk_admin', plugins_url( 'img/logo_icon.png', __FILE__ ));
 add_submenu_page('flexytalk', 'Control Panel','Control Panel', 'administrator','flexytalk', 'flexytalk_admin');
 add_submenu_page( 'flexytalk', 'Get Online now!', 'Get Online now!', 'administrator', 'flexytalk_im', 'flexytalk_im' );
 add_submenu_page( 'flexytalk', 'Account Settings', 'Account Settings', 'administrator', 'flexytalk_settings', 'flexytalk_settings' );

}
add_action('admin_menu', 'flexytalk_admin_actions');
add_action('wp_footer', 'FT_Process');
add_action( 'widgets_init', 'flexytalk_load_widgets' );
add_filter( 'plugin_row_meta', 'flexytalk_register_plugin_links',10,2);



function flexytalk_settings()
{
 
include("flexytalk_settings.php");
}

function flexytalk_im() {

$usr=get_option(ft_username);
$pwd=get_option(ft_password);
if( strlen($usr)>0 && strlen($pwd)>0)
	include("flexytalk_im.php");
else
include("flexytalk_settings.php");
}





function curl($url)
{

   $ch =@curl_init(); 
   if ( $ch && $url) {
		// curl okay
		// set URL and other appropriate options
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch,  CURLOPT_RETURNTRANSFER , true);	
		curl_exec($ch);
		curl_close($ch);
	}	

}


function flexytalk_register_plugin_links($links, $file) {
	$base = plugin_basename(__FILE__);
	if ($file == $base) {
		$links[] = '<a href="admin.php?page=flexytalk">' . __('Settings','flexytalk_widget') . '</a>';
		$links[] = '<a href="http://www.flexytalk.com/support/faq/" target="_blank">' . __('FAQ','flexytalk_widget') . '</a>';
		$links[] = '<a href="http://www.flexytalk.com/support/" target="_blank">' . __('Support','flexytalk_widget') . '</a>';
	}
	return $links;
}

function flexytalk_load_widgets() {
	register_widget( 'FlexyTalk_Widget' );
}
class FlexyTalk_Widget extends WP_Widget {

	function FlexyTalk_Widget() {

	$widget_ops = array( 'classname' => 'FlexyTalk', 'description' => __('Chat with your website visitors.', 'FlexyTalk') );
	$control_ops = array( 'width' => 700, 'height' => 350, 'id_base' => 'flexytalk-widget' );
	$this->WP_Widget( 'flexytalk-widget', __('FlexyTalk Free Live Chat Widget', 'FlexyTalk Free Live Chat Widget'), $widget_ops, $control_ops );
	}

function widget( $args, $instance ) {
if(is_active_widget( '', '', 'flexytalk-widget')){


		extract( $args );

		/* Before widget (defined by themes). */
		echo $before_widget;


		$htmlCode="<div class='ft_widget_container'/>";
		$installation_mode=get_option(ft_installation_mode);

		if($installation_mode=="0"){
		$widget_id=get_option(ft_widget_id);
		$htmlCode=$htmlCode. "<script id='ftcontent' data-flexytalk=".$widget_id. ft_get_dept().">
         var script = document.createElement('script');
         script.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + '//www.flexytalk.net/app/v3/js/flexytalk.js';
         document.getElementsByTagName('head')[0].appendChild(script);
   </script>";
}

	printf( $htmlCode);

	

		/* After widget (defined by themes). */
		echo $after_widget;
	}
	


}
}
?>