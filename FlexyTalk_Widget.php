<?php
/**
 * Plugin Name: FlexyTalk - Free Live Chat Widget
 * Plugin URI: http://bit.ly/VfHp3A
 * Description: FlexTalk - Intuitive, simple but powerful Live Chat solution. Connect from any mobile device or PC  - Free plan available
 * Version: 3.0
 * Author: FlexyTalk
 */


function FT_Process()
{
	echo Get_Code();
}

function Get_Code() {

$widget_id=get_option(ft_widget_id);
$htmlCode="<script id='ftcontent' data-flexytalk=".$widget_id.">
         var script = document.createElement('script');
         script.src = ('https' == document.location.protocol ? 'https:' : 'http:') + '//www.flexytalk.net/app/v3/js/flexytalk.js';
      
         document.getElementsByTagName('head')[0].appendChild(script);
   </script>";
return $htmlCode;

 
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

function log_me($message) {
  
        if (is_array($message) || is_object($message)) {
            error_log(print_r($message, true));
        } else {
            error_log($message);
        }
    
}

function flexytalk_admin_actions() {

 add_menu_page('FlexyTalk Control Panel', 'FlexyTalk Chat', 'administrator','flexytalk', 'flexytalk_admin', plugins_url( 'img/logo_icon.png', __FILE__ ));

   add_submenu_page( 'flexytalk', 'Account Settings', 'Account Settings', 'administrator', 'flexytalk_settings', 'flexytalk_settings' );


 
}
add_action('admin_menu', 'flexytalk_admin_actions');
add_action('wp_footer', 'FT_Process');
register_activation_hook( __FILE__, 'flexytalk_activate' );
add_action( 'widgets_init', 'flexytalk_load_widgets' );
add_filter( 'plugin_row_meta', 'flexytalk_register_plugin_links',10,2);
rdr_setup();

function flexytalk_activate()
{
add_option('Flexy_Activate','Plugin-Slug');
}

function flexytalk_settings()
{
include("flexytalk_settings.php");
}

function rdr_setup(){
if (get_option('Flexy_Activate')=='Plugin-Slug') {
	delete_option('Flexy_Activate');
	MigrateSettings();
	
	}
	// header('location: admin.php?page=flexytalk');
	// exit;
}

function MigrateSettings()
{

$flexyid=get_option(ft_widget_id);
if(isset($flexyid) && strlen($flexyid)>0)
	{

$widget_id=str_replace("\"","",get_option(ft_widget_id));
$btn_text=get_option(ft_btn_text_on);
$btn_layout=get_option(ft_btn_layout);
$gvtr=get_option(ft_gvtr);
$cd=get_option(ft_cd);
$ff=get_option(ft_ff);
$email=get_option(ft_email);
$btn_position=get_option(ft_btn_position);
$window_title=get_option(ft_window_title);
$show_op=get_option(ft_show_op);
$op_gender=get_option(ft_op_gender);
$op_size=get_option(ft_op_size);
$custom_image=get_option(ft_custom_image);
$hide_tb=get_option(ft_hide_tb);
$offmessage=get_option(ft_btn_text_off);
$url="http://panel.flexytalk.com/plugin/migrate?flexyid=".urlencode($widget_id)."&btntext=".urlencode($btn_text)."&btn_layout=".urlencode($btn_layout)."&cd=".urlencode($cd)."&ff=".urlencode($ff)."&btn_position=".urlencode($btn_position)."&window=".urlencode($window_title)."&show_op=".urlencode($show_op)."&op_gender=".urlencode($op_gender)."&op_size=".urlencode($op_size)."&custom_image=".urlencode($custom_image)."&hide=".urlencode($hide)."&off=".urlencode($offmessage);

curl($url);
}
}

function curl($url)
{

   $ch =@curl_init(); 
   if ( $ch && $url) {
		// curl okay
		// set URL and other appropriate options
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch,  CURLOPT_RETURNTRANSFER , f);	
		curl_exec($ch);
		curl_close($ch);
	}	

}


function flexytalk_register_plugin_links($links, $file) {
	$base = plugin_basename(__FILE__);
	if ($file == $base) {
		$links[] = '<a href="admin.php?page=flexytalk">' . __('Settings','flexytalk_widget') . '</a>';
		$links[] = '<a href="http://www.flexytalk.com" target="_blank">' . __('FAQ','flexytalk_widget') . '</a>';
		$links[] = '<a href="Mailto:sales@flexytalk.com">' . __('Support','flexytalk_widget') . '</a>';
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
	$this->WP_Widget( 'flexytalk-widget', __('FlexyTalk Free Live Chat Widget', 'FlexyTalk Free Live Chat Widget'), 				$widget_ops, $control_ops );
	}

function widget( $args, $instance ) {
if(is_active_widget( '', '', 'flexytalk-widget')){

}
		extract( $args );

		/* Before widget (defined by themes). */
		echo $before_widget;


		$htmlCode="<div class='ft_widget_container'/>";

		if ( $htmlCode)
			printf( $htmlCode);

	

		/* After widget (defined by themes). */
		echo $after_widget;
	}


}
?>