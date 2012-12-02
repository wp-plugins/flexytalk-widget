<?php
/**
 * Plugin Name: FlexyTalk - Free Live Chat Widget
 * Plugin URI: http://wordpress.org/extend/plugins/flexytalk-widget/
 * Description: FlexyTalk enables you to chat to your web visitors using your current gmail account. No need to signup anywhere, it just works out of the box. it's absolutely free. There are no limits on the number of chats you can answer, it's ad-free and no annoying messages are sent to the visitor.
 * Version: 1.0
 * Author: Sebastian Odena
 */

/**
 * Add function to widgets_init that'll load our widget.
 * 
 */
add_action( 'widgets_init', 'flexytalk_load_widgets' );

/**
 * Register our widget.
 * 'FlexyTalk_Widget' is the widget class used below.
 *
 * 
 */
function flexytalk_load_widgets() {
	register_widget( 'FlexyTalk_Widget' );
}

/**
 * FlexyTalk Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 * 
 */
class FlexyTalk_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function FlexyTalk_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'FlexyTalk', 'description' => __('Chat with your website visitors.', 'FlexyTalk') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 700, 'height' => 350, 'id_base' => 'flexytalk-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'flexytalk-widget', __('FlexyTalk Free Live Chat Widget', 'FlexyTalk Free Live Chat Widget'), $widget_ops, $control_ops );

	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$email=$instance['email'];
		$btnLayout=$instance['btnLayout'];
		$btnText=$instance['btnText'];
		
		

		/* Before widget (defined by themes). */
		echo $before_widget;

		
		/* Display name from widget settings if one was input. */
		$htmlCode="<link href='//app.flexytalk.com/btn/". $instance['btnLayout'].".css' rel='stylesheet' type='text/css' /><div class='flexytalk' data-flexytalk='QUICKTRY__".$instance['email']."' ><a href='#' id='dialog_link' class='ft-button dialog-link'><span class='iconchat'></span>".$instance['btnText']."</a></div><script src='//app.flexytalk.com/js/FlexyTalk.js' ></script>";

		if ( $htmlCode)
			printf( $htmlCode);

	

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		
		$instance['email'] = $new_instance['email'];
		$instance['btnText'] = $new_instance['btnText'];
		$instance['btnLayout'] = $new_instance['btnLayout'];

		
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 
	 */
	function form( $instance ) {

/* Set up some default widget settings. */
		$defaults = array( 'btnText' => __('CLICK TO CHAT', ''), 'btnLayout' => __('cupertino', ''), 'email' => __('yourGmailAccount@gmail.com', ''));
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

<span>Enter the Gmail account you'll use to answer chats requests coming from your website. A Google Hosted Domain or any Jabber account will also do OK.</span>
<p> 
<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e('Gmail Account (email):', 'hybrid'); ?></label>
<input style="width:300px" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" value="<?php echo $instance['email']; ?>" style="width:100%;" />
 </p>
<hr />
<p>
<span>Choose the button layout. Check out the mouse over effects of each button on your real WordPress site.</span>
<table>

<tr>
<td>

<input class="radio" type="radio" value="hot-sneaks" <?php checked( $instance['btnLayout'], true ); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img src="<?php echo plugins_url( 'img/hot-sneaks.png', __FILE__ ); ?>"/></label>
</td>
<td>

<input class="radio" type="radio" value="humanity" <?php checked( $instance['btnLayout'], "humanity"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img src="<?php echo plugins_url( 'img/humanity.png', __FILE__ ); ?>"/></label>
</td>
<td>

<input class="radio" type="radio" value="lefrog" <?php checked( $instance['btnLayout'], "lefrog"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img src="<?php echo plugins_url( 'img/lefrog.png', __FILE__ ); ?>"/></label>
</td>
<td>

<input class="radio" type="radio" value="mint-choc" <?php checked( $instance['btnLayout'], "mint-choc"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img src="<?php echo plugins_url( 'img/mint-choc.png', __FILE__ ); ?>"/></label>
</td>
</tr>
<tr>
<td>

<input class="radio" type="radio" style="bottom:10px" value="overcast" <?php checked( $instance['btnLayout'], "overcast"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img src="<?php echo plugins_url( 'img/overcast.png', __FILE__ ); ?>"/></label>
</td>
<td>

<input class="radio" type="radio" value="pepper-grinder" <?php checked( $instance['btnLayout'], "pepper-grinder"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img src="<?php echo plugins_url( 'img/pepper-grinder.png', __FILE__ ); ?>"/></label>
</td>
<td>

<input class="radio" type="radio" value="redmond" <?php checked( $instance['btnLayout'], "redmond"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img src="<?php echo plugins_url( 'img/redmond.png', __FILE__ ); ?>"/></label>
</td>
<td>

<input class="radio" type="radio" value="smoothness" <?php checked( $instance['btnLayout'], "smoothness"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img src="<?php echo plugins_url( 'img/smoothness.png', __FILE__ ); ?>"/></label>
</td>
</tr>
<tr>
<td>

<input class="radio" type="radio" value="south-street" <?php checked( $instance['btnLayout'], "south-street"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img src="<?php echo plugins_url( 'img/south-street.png', __FILE__ ); ?>"/></label>
</td>
<td>

<input class="radio" type="radio" value="start" <?php checked( $instance['btnLayout'], "start"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img src="<?php echo plugins_url( 'img/start.png', __FILE__ ); ?>"/></label>
</td>
<td>

<input class="radio" type="radio" value="sunny" <?php checked( $instance['btnLayout'], "sunny"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img src="<?php echo plugins_url( 'img/sunny.png', __FILE__ ); ?>"/></label>
</td>
<td>

<input class="radio" type="radio" value="swanky-purse" <?php checked( $instance['btnLayout'], "swanky-purse"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img src="<?php echo plugins_url( 'img/swanky-purse.png', __FILE__ ); ?>"/></label>
</td>
</tr>
<tr>
<td>

<input class="radio" type="radio" value="trontastic" <?php checked( $instance['btnLayout'], "trontastic"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img src="<?php echo plugins_url( 'img/trontastic.png', __FILE__ ); ?>"/></label>
</td>
<td>

<input class="radio" type="radio" value="ui-darkness" <?php checked( $instance['btnLayout'], "ui-darkness"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img src="<?php echo plugins_url( 'img/ui-darkness.png', __FILE__ ); ?>"/></label>
</td>
<td>

<input class="radio" type="radio" value="ui-lightness" <?php checked( $instance['btnLayout'], "ui-lightness"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img src="<?php echo plugins_url( 'img/ui-lightness.png', __FILE__ ); ?>"/></label>
</td>
<td>

<input class="radio" type="radio" value="vader" <?php checked( $instance['btnLayout'], "vader"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img src="<?php echo plugins_url( 'img/vader.png', __FILE__ ); ?>"/></label>
</td>
</tr>
<tr>
<td>

<input class="radio" type="radio" value="black-tie" <?php checked( $instance['btnLayout'], "black-tie"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img src="<?php echo plugins_url( 'img/black-tie.png', __FILE__ ); ?>"/></label>
</td>
<td>

<input class="radio" type="radio" value="flick" <?php checked( $instance['btnLayout'], "flick"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img src="<?php echo plugins_url( 'img/flick.png', __FILE__ ); ?>"/></label>
</td>
<td>

<input class="radio" type="radio" value="excite-bike" <?php checked( $instance['btnLayout'], "excite-bike"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img src="<?php echo plugins_url( 'img/excite-bike.png', __FILE__ ); ?>"/></label>
</td>
<td>

<input class="radio" type="radio" value="eggplant" <?php checked( $instance['btnLayout'], "eggplant"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img src="<?php echo plugins_url( 'img/eggplant.png', __FILE__ ); ?>"/></label>
</td>
</tr>
<tr>
<td>

<input class="radio" type="radio" value="dot-luv" <?php checked( $instance['btnLayout'], "dot-luv"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img src="<?php echo plugins_url( 'img/dot-luv.png', __FILE__ ); ?>"/></label>
</td>
<td>

<input class="radio" type="radio" value="dark-hive" <?php checked( $instance['btnLayout'], "dark-hive"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img src="<?php echo plugins_url( 'img/dark-hive.png', __FILE__ ); ?>"/></label>
</td>
<td>

<input class="radio" type="radio" value="cupertino" <?php checked( $instance['btnLayout'], "cupertino"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img src="<?php echo plugins_url( 'img/cupertino.png', __FILE__ ); ?>"/></label>
</td>
<td>

<input class="radio" type="radio" value="blitzer" <?php checked( $instance['btnLayout'], "blitzer"); ?> id="<?php echo $this->get_field_id( 'btnLayout' ); ?>" name="<?php echo $this->get_field_name( 'btnLayout' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'btnLayout' ); ?>"><img src="<?php echo plugins_url( 'img/blitzer.png', __FILE__ ); ?>"/></label>
</td>
</tr>
</table>
</p>
<hr />
<span>Enter the text to be displayed on the "chat" button </span><br />
<p> 
<label for="<?php echo $this->get_field_id( 'btnText' ); ?>"><?php _e('Button Text:', 'hybrid'); ?></label>
<input id="<?php echo $this->get_field_id( 'btnText' ); ?>" name="<?php echo $this->get_field_name( 'btnText' ); ?>" value="<?php echo $instance['btnText']; ?>" style="width:300px" />
 </p>
<br>
<span> If something goes wrong, please email us at <a href="mailto:support@flexytalk.com">support@flexytalk.com</a></span>
		
	<?php
	}
}

?>