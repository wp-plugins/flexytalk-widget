<?php 
/**
 * Plugin Name: FlexyTalk - Free Live Chat Widget
 * Plugin URI: http://bit.ly/VfHp3A
 * Description: FlexyTalk enables you to chat to your web visitors using your current gmail account. Free lifetime plan with unlimited chats.
 * Version: 2.4.3
 * Author: FlexyTalk
 */


function FT_Process()
{
$installation_mode=get_option(ft_installation_mode);

if($installation_mode=="1"){
	Enqueue_Scripts();
	echo Get_Code();
}
}

function Get_Code() {
$widget_id=get_option(ft_widget_id);
$btn_text=get_option(ft_btn_text);
$btn_layout=get_option(ft_btn_layout);
$gvtr=get_option(ft_gvtr);
$cd=get_option(ft_cd);
$ff=get_option(ft_ff);
$email=get_option(ft_email);
$btn_position=get_option(ft_btn_position);
$window_title=get_option(ft_window_title);
$style="";
$widgetid="";
if($btn_position=="1")
	$style="position:fixed;bottom:10px;right:10px";
	else if($btn_position=="2")
	$style="position:fixed;bottom:10px;left:10px";
	else if($btn_position=="3")
	$style="position:fixed;top:10px;right:10px";
	else if($btn_position=="4")
	$style="position:fixed;top:10px;left:10px";
	
	
	
	if($widget_id=="")
	{
		$widgetid="QUICKTRY__".$email;
	}
	else
	{
		$widgetid=$widget_id;
	}

$htmlCode="<link href='//app.flexytalk.com/btn/". $btn_layout.".css' rel='stylesheet' type='text/css' /><div class='flexytalk' style='z-index:2147483647;".$style."' data-flexytalk-title='".$window_title."' data-flexytalk='".$widgetid."' data-flexytalk-ff='".$ff."' data-flexytalk-chatdirect='".$cd."' data-flexytalk-gvtr='".$gvtr."' ><a href='#' id='dialog_link' class='ft-button dialog-link'><span class='iconchat'></span>".$btn_text."</a></div>";
return $htmlCode;

 
}
//*************** Admin function ***************
function flexytalk_admin() {

	include("flexytalk_settings.php");
}



function flexytalk_admin_actions() {

 add_menu_page('FlexyTalk Settings', 'FlexyTalk Chat', 'administrator',"flexytalk", 'flexytalk_admin', plugins_url( 'img/logo_icon.png', __FILE__ ));

 
}
add_action('admin_menu', 'flexytalk_admin_actions');


add_action('wp_footer', 'FT_Process');
add_action( 'widgets_init', 'flexytalk_load_widgets' );
add_filter( 'plugin_row_meta', 'flexytalk_register_plugin_links',10,2);


function Enqueue_Scripts()
{

	
 	wp_enqueue_script('jquery');
 	wp_enqueue_script('jquery-ui-core');
 	wp_enqueue_script('jquery-ui-dialog');
	wp_enqueue_script('flexytalk','https://app.flexytalk.com/js/flexytalk.js', array(), null, true ); 
	
}

function flexytalk_register_plugin_links($links, $file) {
	$base = plugin_basename(__FILE__);
	if ($file == $base) {
		$links[] = '<a href="admin.php?page=flexytalk">' . __('Settings','flexytalk_widget') . '</a>';
		$links[] = '<a href="http://wordpress.org/extend/plugins/flexytalk-widget/faq/" target="_blank">' . __('FAQ','flexytalk_widget') . '</a>';
		$links[] = '<a href="Mailto:sebastian@flexytalk.com">' . __('Support','flexytalk_widget') . '</a>';
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
	Enqueue_Scripts();
}
		extract( $args );

		/* Our variables from the widget settings. */
		$email=$instance['email'];
		$btnLayout=$instance['btnLayout'];
		$btnText=$instance['btnText'];
		$btnPosition=$instance['btnPosition'];
		$ff=$instance['ff'];
		$gvtr=$instance['gvtr'];
		
		
		

		/* Before widget (defined by themes). */
		echo $before_widget;

		$style="";
		$widgetid="";
if($instance['btnPosition']=="1")
	$style="position:fixed;bottom:10px;right:10px";
	if($instance['btnPosition']=="2")
	$style="position:fixed;bottom:10px;left:10px";
	if($instance['btnPosition']=="3")
	$style="position:fixed;top:10px;right:10px";
	if($instance['btnPosition']=="4")
	$style="position:fixed;top:10px;left:10px";
	if($instance['btnPosition']=="5")
	$style="";
	
	if($instance['WidgetID']=="")
	{
		$widgetid="QUICKTRY__".$instance['email'];
	}
	else
	{
		$widgetid=$instance['WidgetID'];
	}
	
		/* Display name from widget settings if one was input. */
		$htmlCode="<link href='//app.flexytalk.com/btn/". $instance['btnLayout'].".css' rel='stylesheet' type='text/css' /><div class='flexytalk' style='z-index:2147483647;".$style."' data-flexytalk-title='".$instance['WindowTitle']."' data-flexytalk='".$widgetid."' data-flexytalk-ff='".$instance['ff']."' data-flexytalk-chatdirect='".$instance['cd']."' data-flexytalk-gvtr='".$instance['gvtr']."' ><a href='#' id='dialog_link' class='ft-button dialog-link'><span class='iconchat'></span>".$instance['btnText']."</a></div>";

		if ( $htmlCode)
			printf( $htmlCode);

	

		/* After widget (defined by themes). */
		echo $after_widget;
	}

function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		
		$instance['email'] = $new_instance['email'];
		$instance['btnText'] = $new_instance['btnText'];
		$instance['btnLayout'] = $new_instance['btnLayout'];
		$instance['btnPosition'] = $new_instance['btnPosition'];
		$instance['WindowTitle'] = $new_instance['WindowTitle'];
		$instance['WidgetID'] = $new_instance['WidgetID'];
		$instance['ff'] = $new_instance['ff'];
		$instance['cd'] = $new_instance['cd'];
		$instance['gvtr'] = $new_instance['gvtr'];
		
		return $instance;
	}
function form( $instance ) {

/* Set up some default widget settings. */
		$defaults = array( 'btnText' => __('CLICK TO CHAT', ''), 'btnLayout' => __('cupertino', ''), 'email' => __('', ''), 'cd'=>__("0",""), 'btnPosition'=>__("1",""), 'WindowTitle' => __('LIVE CHAT', ''), 'ff' => __('10', ''), 'WidgetID' => __('', ''), 'gvtr' =>__('0',''));
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
<table class="wc_status_table widefat" cellspacing="0">

			<thead>
				<tr>
					<th colspan="2">Activation</th>
				</tr>
			</thead>

			<tbody>
                <tr>
                    <td>GMail / JABBER Account</td>
                    <td><input style="width:300px" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" value="<?php echo $instance['email']; ?>" style="width:100%;" /> <i>(username@gmail.com) </i> </td>
					
                </tr>
                <tr>
                    <td style="width:20%">Widget ID</td>
                    <td><input style="width:300px" id="<?php echo $this->get_field_id( 'WidgetID' ); ?>" name="<?php echo $this->get_field_name( 'WidgetID' ); ?>" value="<?php echo $instance['WidgetID']; ?>" style="width:100%;" /> <i>(Reserved for <a target="_blank" href="http://bit.ly/VfHp3A">Premium Users</a>)</i>
					</td>
				
                </tr>
             	
			</tbody>

			<thead>
				<tr>
					<th colspan="2">Settings</th>
				</tr>
			</thead>

			<tbody>
                <tr>
                    <td>Chat Button Text</td>
                    <td><input id="<?php echo $this->get_field_id( 'btnText' ); ?>" name="<?php echo $this->get_field_name( 'btnText' ); ?>" value="<?php echo $instance['btnText']; ?>" style="width:300px" /></td>
				
                </tr>
                <tr>
                    <td>Chat Button Position</td>
                    <td><select id="<?php echo $this->get_field_id( 'btnPosition' ); ?>" name="<?php echo $this->get_field_name( 'btnPosition' ); ?>">
					<option value="1" <?php selected( $instance['btnPosition'], "1");?>>Bottom - Right</option>
					<option value="2" <?php selected( $instance['btnPosition'], "2");?>>Bottom - Left</option>
					<option value="3" <?php selected( $instance['btnPosition'], "3");?>>Top - Right</option>
					<option value="4" <?php selected( $instance['btnPosition'], "4");?>>Top - Left</option>
					<option value="5" <?php selected( $instance['btnPosition'], "5");?>>Flow</option>
					</select>
					</td>
					
                </tr>
                <tr>
                    <td>Live Chat Widget Title</td>
					<td><input id="<?php echo $this->get_field_id( 'WindowTitle' ); ?>" name="<?php echo $this->get_field_name( 'WindowTitle' ); ?>" value="<?php echo $instance['WindowTitle']; ?>" style="width:300px" /></td>
					
                </tr>
				<tr>
                    <td>Form Factor</td>
					<td><select id="<?php echo $this->get_field_id( 'ff' ); ?>" name="<?php echo $this->get_field_name( 'ff' ); ?>">
					<option value="9" <?php selected( $instance['ff'], "9");?>>XS</option>
					<option value="10" <?php selected( $instance['ff'], "10");?>>S</option>
					<option value="11" <?php selected( $instance['ff'], "11");?>>M</option>
					<option value="12" <?php selected( $instance['ff'], "12");?>>L</option>
					<option value="13" <?php selected( $instance['ff'], "13");?>>XL</option>
					<option value="14" <?php selected( $instance['ff'], "14");?>>XXL</option>
					</select>
					</td>
					
                </tr>
				<tr>
                    <td>Display Options</td>
					<td><select id="<?php echo $this->get_field_id( 'cd' ); ?>" name="<?php echo $this->get_field_name( 'cd' ); ?>">
					<option value="0" <?php selected( $instance['cd'], "0");?>>Display pre-chat form</option>
					<option value="1" <?php selected( $instance['cd'], "1");?>>Display Chat Room</option>
					</select>
					</td>
					
                </tr>
			</tbody>

			<thead>
				<tr>
					<th colspan="2">Integration</th>
				</tr>
			</thead>
			<tbody>
                <tr>
                    <td>Facebook</td>
                    <td><a href="http://www.facebook.com/dialog/pagetab?app_id=262700000525594&redirect_uri=http://www.flexytalk.com/home/tabadded" target="_blank">Setup</a> <i>(Installs a live chat widget on your FaceBook business site)</i></td>
					
                </tr>
                <tr>
                    <td>Gravatar</td>
                    <td><input class="checkbox" value="1" type="checkbox" <?php checked( $instance['gvtr'], '1'); ?> id="<?php echo $this->get_field_id( 'gvtr' ); ?>" name="<?php echo $this->get_field_name( 'gvtr' ); ?>" /> <label for="<?php echo $this->get_field_id( 'gvtr' ); ?>">Show my GRAVATAR profile</label> <i>(Your Gravatar e-mail account must be the same as GMail Account entered above)</i></td>
					
                </tr>
			</tbody>
			
			<thead>
				<tr>
					<th colspan="2">Chat Button Gallery</th>
				</tr>
			</thead>

			<tbody>
                <tr>
                    
                    <td colspan="2">
					<table>
					<tr>
					<td>
					<input class="radio" value="hot-sneaks" type="radio" <?php checked( $instance['btnLayout'], "hot-sneaks"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/hot-sneaks.png', __FILE__ ); ?>"/></label>
</td>
<td>


<input class="radio" type="radio" value="humanity" <?php checked( $instance['btnLayout'], "humanity"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/humanity.png', __FILE__ ); ?>"/></label>
</td>
<td>

<input class="radio" type="radio" value="lefrog" <?php checked( $instance['btnLayout'], "lefrog"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/lefrog.png', __FILE__ ); ?>"/></label>

</td>
<td>
<input class="radio" type="radio" value="mint-choc" <?php checked( $instance['btnLayout'], "mint-choc"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/mint-choc.png', __FILE__ ); ?>"/></label>
</td>
</tr>
<tr>
<td>

<input class="radio" type="radio" style="bottom:10px" value="overcast" <?php checked( $instance['btnLayout'], "overcast"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/overcast.png', __FILE__ ); ?>"/></label>
</td>
<td>

<input class="radio" type="radio" value="pepper-grinder" <?php checked( $instance['btnLayout'], "pepper-grinder"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/pepper-grinder.png', __FILE__ ); ?>"/></label>
</td>
<td>

<input class="radio" type="radio" value="redmond" <?php checked( $instance['btnLayout'], "redmond"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/redmond.png', __FILE__ ); ?>"/></label>
</td>
<td>

<input class="radio" type="radio" value="smoothness" <?php checked( $instance['btnLayout'], "smoothness"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/smoothness.png', __FILE__ ); ?>"/></label>
</td>
</tr>
<tr>
<td>

<input class="radio" type="radio" value="south-street" <?php checked( $instance['btnLayout'], "south-street"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/south-street.png', __FILE__ ); ?>"/></label>
</td>
<td>
<input class="radio" type="radio" value="start" <?php checked( $instance['btnLayout'], "start"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/start.png', __FILE__ ); ?>"/></label>

</td>
<td>
<input class="radio" type="radio" value="sunny" <?php checked( $instance['btnLayout'], "sunny"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/sunny.png', __FILE__ ); ?>"/></label>

</td>
<td>
<input class="radio" type="radio" value="swanky-purse" <?php checked( $instance['btnLayout'], "swanky-purse"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/swanky-purse.png', __FILE__ ); ?>"/></label>
</td>
</tr>
<tr>
<td>

<input class="radio" type="radio" value="trontastic" <?php checked( $instance['btnLayout'], "trontastic"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/trontastic.png', __FILE__ ); ?>"/></label>

</td>
<td>
<input class="radio" type="radio" value="ui-darkness" <?php checked( $instance['btnLayout'], "ui-darkness"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/ui-darkness.png', __FILE__ ); ?>"/></label>

</td>
<td>
<input class="radio" type="radio" value="ui-lightness" <?php checked( $instance['btnLayout'], "ui-lightness"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/ui-lightness.png', __FILE__ ); ?>"/></label>
</td>
<td>

<input class="radio" type="radio" value="vader" <?php checked( $instance['btnLayout'], "vader"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/vader.png', __FILE__ ); ?>"/></label>
</td>
</tr>
<tr>
<td>

<input class="radio" type="radio" value="black-tie" <?php checked( $instance['btnLayout'], "black-tie"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/black-tie.png', __FILE__ ); ?>"/></label>
</td>
<td>
<input class="radio" type="radio" value="flick" <?php checked( $instance['btnLayout'], "flick"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/flick.png', __FILE__ ); ?>"/></label>
</td>
<td>
<input class="radio" type="radio" value="excite-bike" <?php checked( $instance['btnLayout'], "excite-bike"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/excite-bike.png', __FILE__ ); ?>"/></label>

</td>
<td>
<input class="radio" type="radio" value="eggplant" <?php checked( $instance['btnLayout'], "eggplant"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/eggplant.png', __FILE__ ); ?>"/></label>

</td>
</tr>
<tr>
<td>
<input class="radio" type="radio" value="dot-luv" <?php checked( $instance['btnLayout'], "dot-luv"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/dot-luv.png', __FILE__ ); ?>"/></label>

</td>
<td>
<input class="radio" type="radio" value="dark-hive" <?php checked( $instance['btnLayout'], "dark-hive"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/dark-hive.png', __FILE__ ); ?>"/></label>
</td>
<td>

<input class="radio" type="radio" value="cupertino" <?php checked( $instance['btnLayout'], "cupertino"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/cupertino.png', __FILE__ ); ?>"/></label>

</td>
<td>
<input class="radio" type="radio" value="blitzer" <?php checked( $instance['btnLayout'], "blitzer"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/blitzer.png', __FILE__ ); ?>"/></label>
			
			</td>
                </tr>
				</table>
				</td></tr>
			</tbody>
			<thead>
				<tr>
					<th colspan="2">Help</th>
				</tr>
			</thead>
			<tbody>
                <tr>
                    <td colspan="2"><a href="javascript:UserVoice.showPopupWidget();">Support & Tutorials</a></td>
					
                    
                </tr>
                <tr>
                    <td colspan="2"><a target="_blank" href="http://bit.ly/VfHp3A">Customizations</a></td>
                   
					
                </tr>
			</tbody>
<thead>
				<tr>
					<th colspan="2"></th>
				</tr>
			</thead>
			<tbody>
                <tr>
                    <td colspan="2"><iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Ffacebook.com%2Fflexytalk&amp;send=false&amp;layout=standard&amp;width=350&amp;show_faces=false&amp;font&amp;colorscheme=light&amp;action=like&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:350px; height:35px;" allowTransparency="true"></iframe></td>
					<tr/>
					<tr>
  <td colspan="2"><strong>Please</strong>, <a href="http://wordpress.org/support/view/plugin-reviews/flexytalk-widget" target="_blank">take a moment to rate this plugin</a>, <strong>thank you!</strong></td>
					
                    
                </tr>

			</tbody>

			
		</table>

<script type="text/javascript">

  var uvOptions = {};
  (function() {
    var uv = document.createElement('script'); uv.type = 'text/javascript'; uv.async = true;
    uv.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'widget.uservoice.com/thrGSHsPjpbbbLJtWTvw.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(uv, s);
  })();
</script>
	<?php
	}



}

?>