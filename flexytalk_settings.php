<?php 
// return tru if $str ends with $sub
function endsWith( $str, $sub ) {
    return ( substr( $str, strlen( $str ) - strlen( $sub ) ) == $sub );
}
	$message="";
	if($_POST['flexytalk_hidden'] == 'Y') {
		//Form data sent
		$btn_text_on = $_POST['ft_btn_text_on'];
		update_option('ft_btn_text_on', $btn_text_on);

		$installation_mode = $_POST['ft_installation_mode'];
		update_option('ft_installation_mode', $installation_mode);		
		
		$btn_layout = $_POST['ft_btn_layout'];
		update_option('ft_btn_layout', $btn_layout);
		
		$gvtr = $_POST['ft_gvtr'];
		update_option('ft_gvtr', $gvtr);
		
		$ff = $_POST['ft_ff'];
		update_option('ft_ff', $ff);
		
		$show_op = $_POST['ft_show_op'];
		update_option('ft_show_op', $show_op);
		
		$btn_text_off = $_POST['ft_btn_text_off'];
		update_option('ft_btn_text_off', $btn_text_off);
		
		$op_gender = $_POST['ft_op_gender'];
		update_option('ft_op_gender', $op_gender);
		
		$custom_img = $_POST['ft_custom_image'];
		update_option('ft_custom_image', $custom_img);
		
		$op_size = $_POST['ft_op_size'];
		update_option('ft_op_size', $op_size);
		
		$hide_tb = $_POST['ft_hide_tb'];
		update_option('ft_hide_tb', $hide_tb);

		$cd = $_POST['ft_cd'];
		update_option('ft_cd', $cd);
		
		$window_title = $_POST['ft_window_title'];
		update_option('ft_window_title', $window_title);

		$email = $_POST['ft_email'];
		$p_email=get_option(ft_email);
		if($email=="" or endsWith($email,"yahoo.com"))
			$message="Please, enter a valid GMAIL OR JABBER address";
		else
		{
			if(endsWith($email,"gmail.com"))
			{
				$message="Options Saved. <br/><br/>";
			}
			else
			{
				$message="Options saved. Please, verify that the IM acccount you entered is valid. If it is a GOOGLE APPS DOMAIN, the domain must be configured as explained in <a href='http://support.google.com/a/bin/answer.py?hl=en&answer=34143' target='_blank'>this tutorial</a><br/><br/>";
				
				
			}
			if($p_email != $email){
				$message=$message."To continue with the setup process, navigate to your website and click the live chat button. A welcome message will be displayed, and a chat invite will be sent to your IM account which you have to accept. This chat invite can be found at GMAIL'S left sidebar near your chat contacts. ";
				}
				
			update_option('ft_email', $email);
			
		}
		
		
		$widget_id = $_POST['ft_widget_id'];
		update_option('ft_widget_id', $widget_id);
		
		$btn_position = $_POST['ft_btn_position'];
		update_option('ft_btn_position', $btn_position);
		?>
		<div class="updated"><p><strong><?php echo($message ); ?></strong></p></div>
		<?php
	} else {
		//Normal page display
if(get_option('ft_btn_text_on')=='')
	update_option('ft_btn_text_on', 'CLICK TO CHAT');
	
	if(get_option('ft_btn_text_off')=='')
	update_option('ft_btn_text_off', 'Offline - Leave a message');
	
	if(get_option('ft_show_op')=='')
	update_option('ft_show_op', '1');
	
	if(get_option('ft_op_gender')=='')
	update_option('ft_op_gender', 'm');
	
	if(get_option('ft_op_size')=='')
	update_option('ft_op_size', 'm');
	
	if(get_option('ft_hide_tb')=='')
	update_option('ft_hide_tb', '0');
	
if(get_option('ft_btn_layout')=='')
	update_option('ft_btn_layout', 'sunny');
if(get_option('ft_gvtr')=='')
	update_option('ft_gvtr', '0');
if(get_option('ft_ff')=='')
	update_option('ft_ff', '10');
if(get_option('ft_cd')=='')
	update_option('ft_cd', '0');
if(get_option('ft_window_title')=='')
	update_option('ft_window_title', 'LIVE CHAT');
if(get_option('ft_btn_position')=='')
	update_option('ft_btn_position', '1');
if(get_option('ft_installation_mode')=='')
	update_option('ft_installation_mode', '1');


		$btn_text_on = get_option('ft_btn_text_on');
		$btn_layout = get_option('ft_btn_layout');
		$gvtr = get_option('ft_gvtr');
		$ff = get_option('ft_ff');
		$cd = get_option('ft_cd');
		$window_title = get_option('ft_window_title');
		$email = get_option('ft_email');
		$widget_id = get_option('ft_widget_id');
		$btn_position = get_option('ft_btn_position');
		$op_gender = get_option('ft_op_gender');
		$op_size = get_option('ft_op_size');
		$show_op = get_option('ft_show_op');
		$custom_image = get_option('ft_custom_image');
		$hide_tb = get_option('ft_hide_tb');
		$btn_text_off = get_option('ft_btn_text_off');
		$installation_mode = get_option('ft_installation_mode');

		}
	
	
?>
<div class="wrap">
<?php    echo "<h2>" . __( 'FlexyTalk Settings', 'flextalk_trdom' ) . "</h2>"; ?>
<form name="flexytalk_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<input type="hidden" name="flexytalk_hidden" value="Y">
	<table class="wc_status_table widefat" cellspacing="0">

			<thead>
				<tr>
					<th colspan="2">Activation</th>
				</tr>
			</thead>

			<tbody>
                <tr>
                    <td>GMail / JABBER Account</td>
                    <td><input style="width:300px"  name="ft_email" value="<?php echo $email; ?>" style="width:100%;" /> <i>(username@gmail.com) - The INSTANT MESSAGING Account you will use to chat with your website visitors</i> </td>
					
                </tr>
               
             	
			</tbody>
<thead>
				<tr>
					<th colspan="2">Installation Mode</th>
				</tr>
			</thead>
			<tbody>
                <tr>
				<td colspan="2"><input class="radio" value="1" type="radio" <?php checked( $installation_mode, '1'); ?> name="ft_installation_mode" /> <label for="ft_installation_mode">Activate FlexyTalk Live Chat on all the website pages</td>
				</tr>
				<tr>
				<td colspan="2"><input class="radio" value="0" type="radio" <?php checked( $installation_mode, '0');  ?> name="ft_installation_mode" /> <label for="ft_installation_mode">Don't activate the plugin. I'll use <a href="widgets.php">FlexyTalk widget</a> instead </td>
				</tr>
				</tbody>
				
			<thead>
				<tr>
					<th colspan="2">Settings</th>
				</tr>
			</thead>

			<tbody>
                <tr>
                    <td>Online Toolbar Text</td>
                    <td><input  name="ft_btn_text_on" value="<?php echo $btn_text_on; ?>" style="width:300px" /></td>
				
                </tr>
				<tr>
                    <td>Offline  Toolbar Text</td>
                    <td><input  name="ft_btn_text_off" value="<?php echo $btn_text_off; ?>" style="width:300px" /></td>
				
                </tr>
                <tr>
                    <td>Chat Button Position</td>
                    <td><select  name="ft_btn_position">
					<option value="1" <?php selected( $btn_position, "1");?>>Bottom - Right</option>
					<option value="2" <?php selected( $btn_position, "2");?>>Bottom - Left</option>
					<option value="3" <?php selected( $btn_position, "3");?>>Top - Right</option>
					<option value="4" <?php selected( $btn_position, "4");?>>Top - Left</option>
					
					</select>
					</td>
					
                </tr>
                <tr>
                    <td>Live Chat Widget Title</td>
					<td><input  name="ft_window_title" value="<?php echo $window_title; ?>" style="width:300px" /></td>
					
                </tr>
				<tr>
                    <td>Form Factor</td>
					<td><select  name="ft_ff">
					<option value="9" <?php selected( $ff, "9");?>>XS</option>
					<option value="10" <?php selected( $ff, "10");?>>S</option>
					<option value="11" <?php selected( $ff, "11");?>>M</option>
					<option value="12" <?php selected( $ff, "12");?>>L</option>
					<option value="13" <?php selected( $ff, "13");?>>XL</option>
					<option value="14" <?php selected( $ff, "14");?>>XXL</option>
					</select>
					</td>
					
                </tr>
				<tr>
                    <td>Display Options</td>
					<td><select  name="ft_cd">
					<option value="0" <?php selected( $cd, "0");?>>Display pre-chat form</option>
					<option value="1" <?php selected( $cd, "1");?>>Display Chat Room</option>
					</select>
					</td>
					
                </tr>
			</tbody>
			<thead>
				<tr>
					<th colspan="2">Agent Image - <i>Displays a 3D image on top of the chat toolbar</i></th>
				</tr>
			</thead>
			<tbody>
                <tr>
				 <td  colspan="2"><input class="checkbox" value="1" type="checkbox" <?php checked( $show_op, '1'); ?> name="ft_show_op" /> <label for="ft_show_op"> Display Agent Image</label></td>
                  
                </tr>
				 <tr>
                    <td>Agent Image Size</td>
                   <td><select  name="ft_op_size">
					<option value="s" <?php selected( $op_size, "s");?>>Small</option>
					<option value="m" <?php selected( $op_size, "m");?>>Medium</option>
					<option value="l" <?php selected( $op_size, "l");?>>Large</option>
					</select>
					</td>
                </tr>
				 <tr>
                    <td>Agent Gender</td>
                     <td><select  name="ft_op_gender">
					<option value="m" <?php selected( $op_gender, "m");?>>Male</option>
					<option value="f" <?php selected( $op_gender, "f");?>>Female</option>
				
					</select>
					</td>
                </tr>
				</tbody>
				<thead>
				<tr>
					<th colspan="2">Reserved for Premium Accounts</th>
				</tr>
				
			</thead>
			<tbody>
                <tr>
                     <td style="width:20%">Widget ID</td>
                    <td><input style="width:300px" name="ft_widget_id" value="<?php echo $widget_id; ?>" style="width:100%;" /> </td>
                </tr>
				<tr>
                     <td style="width:20%">Custom Bubble Image (Replaces the default 3D agent image)</td>
                    <td><input style="width:300px" name="ft_custom_image" value="<?php echo $custom_img; ?>" style="width:100%;" /> (https://mywebsite.com/img/myimage.png) </td>
                </tr>
				<tr>
                     <td colspan="2"><input class="checkbox" value="1" type="checkbox" <?php checked( $hide_tb, '1'); ?> name="ft_hide_tb" /> <label for="ft_hide_tb"> Hide chat toolbar when all agents are offline</label></td>
                   
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
                    <td><input class="checkbox" value="1" type="checkbox" <?php checked( $gvtr, '1'); ?> name="ft_gvtr" /> <label for="ft_gvtr">Show my GRAVATAR profile</label> <i>(Your Gravatar e-mail account must be the same as GMail Account entered above)</i></td>
					
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
					<input class="radio" value="hot-sneaks" type="radio" <?php checked( $btn_layout, "hot-sneaks"); ?>  name="ft_btn_layout" /> 
			<label for="ft_btn_layout"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/hot-sneaks.png', __FILE__ ); ?>"/></label>
</td>
<td>


<input class="radio" type="radio" value="humanity" <?php checked( $btn_layout, "humanity"); ?>  name="ft_btn_layout" /> 
			<label for="ft_btn_layout"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/humanity.png', __FILE__ ); ?>"/></label>
</td>
<td>

<input class="radio" type="radio" value="lefrog" <?php checked( $btn_layout, "lefrog"); ?>  name="ft_btn_layout" /> 
			<label for="ft_btn_layout"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/lefrog.png', __FILE__ ); ?>"/></label>

</td>
<td>
<input class="radio" type="radio" value="mint-choc" <?php checked( $btn_layout, "mint-choc"); ?>  name="ft_btn_layout" /> 
			<label for="ft_btn_layout"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/mint-choc.png', __FILE__ ); ?>"/></label>
</td>
</tr>
<tr>
<td>

<input class="radio" type="radio" style="bottom:10px" value="overcast" <?php checked( $btn_layout, "overcast"); ?>  name="ft_btn_layout" /> 
			<label for="ft_btn_layout"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/overcast.png', __FILE__ ); ?>"/></label>
</td>
<td>

<input class="radio" type="radio" value="pepper-grinder" <?php checked( $btn_layout, "pepper-grinder"); ?>  name="ft_btn_layout" /> 
			<label for="ft_btn_layout"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/pepper-grinder.png', __FILE__ ); ?>"/></label>
</td>
<td>

<input class="radio" type="radio" value="redmond" <?php checked( $btn_layout, "redmond"); ?>  name="ft_btn_layout" /> 
			<label for="ft_btn_layout"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/redmond.png', __FILE__ ); ?>"/></label>
</td>
<td>

<input class="radio" type="radio" value="smoothness" <?php checked( $btn_layout, "smoothness"); ?>  name="ft_btn_layout" /> 
			<label for="ft_btn_layout"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/smoothness.png', __FILE__ ); ?>"/></label>
</td>
</tr>
<tr>
<td>

<input class="radio" type="radio" value="south-street" <?php checked( $btn_layout, "south-street"); ?>  name="ft_btn_layout" /> 
			<label for="ft_btn_layout"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/south-street.png', __FILE__ ); ?>"/></label>
</td>
<td>
<input class="radio" type="radio" value="start" <?php checked( $btn_layout, "start"); ?>  name="ft_btn_layout" /> 
			<label for="ft_btn_layout"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/start.png', __FILE__ ); ?>"/></label>

</td>
<td>
<input class="radio" type="radio" value="sunny" <?php checked( $btn_layout, "sunny"); ?>  name="ft_btn_layout" /> 
			<label for="ft_btn_layout"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/sunny.png', __FILE__ ); ?>"/></label>

</td>
<td>
<input class="radio" type="radio" value="swanky-purse" <?php checked( $btn_layout, "swanky-purse"); ?>  name="ft_btn_layout" /> 
			<label for="ft_btn_layout"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/swanky-purse.png', __FILE__ ); ?>"/></label>
</td>
</tr>
<tr>
<td>

<input class="radio" type="radio" value="trontastic" <?php checked( $btn_layout, "trontastic"); ?>  name="ft_btn_layout" /> 
			<label for="ft_btn_layout"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/trontastic.png', __FILE__ ); ?>"/></label>

</td>
<td>
<input class="radio" type="radio" value="ui-darkness" <?php checked( $btn_layout, "ui-darkness"); ?>  name="ft_btn_layout" /> 
			<label for="ft_btn_layout"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/ui-darkness.png', __FILE__ ); ?>"/></label>

</td>
<td>
<input class="radio" type="radio" value="ui-lightness" <?php checked( $btn_layout, "ui-lightness"); ?>  name="ft_btn_layout" /> 
			<label for="ft_btn_layout"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/ui-lightness.png', __FILE__ ); ?>"/></label>
</td>
<td>

<input class="radio" type="radio" value="vader" <?php checked( $btn_layout, "vader"); ?>  name="ft_btn_layout" /> 
			<label for="ft_btn_layout"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/vader.png', __FILE__ ); ?>"/></label>
</td>
</tr>
<tr>
<td>

<input class="radio" type="radio" value="black-tie" <?php checked( $btn_layout, "black-tie"); ?>  name="ft_btn_layout" /> 
			<label for="ft_btn_layout"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/black-tie.png', __FILE__ ); ?>"/></label>
</td>
<td>
<input class="radio" type="radio" value="flick" <?php checked( $btn_layout, "flick"); ?>  name="ft_btn_layout" /> 
			<label for="ft_btn_layout"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/flick.png', __FILE__ ); ?>"/></label>
</td>
<td>
<input class="radio" type="radio" value="excite-bike" <?php checked( $btn_layout, "excite-bike"); ?>  name="ft_btn_layout" /> 
			<label for="ft_btn_layout"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/excite-bike.png', __FILE__ ); ?>"/></label>

</td>
<td>
<input class="radio" type="radio" value="eggplant" <?php checked( $btn_layout, "eggplant"); ?>  name="ft_btn_layout" /> 
			<label for="ft_btn_layout"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/eggplant.png', __FILE__ ); ?>"/></label>

</td>
</tr>
<tr>
<td>
<input class="radio" type="radio" value="dot-luv" <?php checked( $btn_layout, "dot-luv"); ?>  name="ft_btn_layout" /> 
			<label for="ft_btn_layout"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/dot-luv.png', __FILE__ ); ?>"/></label>

</td>
<td>
<input class="radio" type="radio" value="dark-hive" <?php checked( $btn_layout, "dark-hive"); ?>  name="ft_btn_layout" /> 
			<label for="ft_btn_layout"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/dark-hive.png', __FILE__ ); ?>"/></label>
</td>
<td>

<input class="radio" type="radio" value="cupertino" <?php checked( $btn_layout, "cupertino"); ?>  name="ft_btn_layout" /> 
			<label for="ft_btn_layout"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/cupertino.png', __FILE__ ); ?>"/></label>

</td>
<td>
<input class="radio" type="radio" value="blitzer" <?php checked( $btn_layout, "blitzer"); ?>  name="ft_btn_layout" /> 
			<label for="ft_btn_layout"><img style="width:127px;height:32px" src="<?php echo plugins_url( 'img/blitzer.png', __FILE__ ); ?>"/></label>
			
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
	

	<p class="submit">
	<input type="submit" class="button button-primary" name="Submit" value="<?php _e('Update Options', 'flexytalk_trdom' ) ?>" />
	</p>
</form>
<script type="text/javascript">

  var uvOptions = {};
  (function() {
    var uv = document.createElement('script'); uv.type = 'text/javascript'; uv.async = true;
    uv.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'widget.uservoice.com/thrGSHsPjpbbbLJtWTvw.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(uv, s);
  })();
</script>
</div>	 