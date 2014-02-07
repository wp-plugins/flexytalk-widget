<?php 
// return tru if $str ends with $sub
function endsWithFT( $str, $sub ) {
    return ( substr( $str, strlen( $str ) - strlen( $sub ) ) == $sub );
}

function curl2($url)
{

   $ch =@curl_init(); 
   if ( $ch && $url) {
		// curl okay
		// set URL and other appropriate options
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch,  CURLOPT_RETURNTRANSFER , true);


		
$result=curl_exec($ch);

curl_close($ch);
return $result;
	}	

}


	$message="Account Settings Updated";
	if($_POST['flexytalk_hidden'] == 'Y') {
		$username=$_POST['ft_username'];
		$password=$_POST['ft_password'];
		$installation_mode=$_POST['ft_installation_mode'];
		 $response= curl2("http://panel.flexytalk.com/plugin/FlexyID?usr=".$username ."&psw=".$password);
		 log_me($response);
		if($response !="\"0\"")
		{
			update_option('ft_username', $username);
			update_option('ft_password', $password);
			update_option('ft_widget_id', $response);
			update_option('ft_installation_mode', $installation_mode);
			$message="account settings updated";
			$divclass="updated";
			
		
		}
		else
		{
			$message="Wrong Credentials";
			$divclass="error";
		}
		?>
		<div class=<?php echo($divclass);?>><p><strong><?php echo($message ); ?></strong></p></div>
		<?php
	}
	else {

	if(get_option('ft_installation_mode')=='')
	update_option('ft_installation_mode', '1');

		$widget_id = get_option('ft_widget_id');
		$username = get_option('ft_username');
		$password = get_option('ft_password');
	    $installation_mode = get_option('ft_installation_mode');
		
		}
	
	
?>
<div class="wrap">
<?php    echo "<h2>" . __( 'FlexyTalk Settings', 'flextalk_trdom' ) ."</h2>" ?>
<form name="flexytalk_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<input type="hidden" name="flexytalk_hidden" value="Y">
<p class="submit">
	
	</p>
	<table class="wc_status_table widefat" cellspacing="0">

			<thead>
				<tr>
					<th colspan="2">Activation</th>
				</tr>
			</thead>

			<tbody>
                <tr>
                    <td><input  class="button button-primary" style="width:250px" name="Submit" value="Create a FlexyTalk Account" onclick="javascript:window.open('http://www.flexytalk.com/pricing/','_blank');"> </td>
                    <td><i> You can signup for a FREE 14-days trial on our Solo or Team Plan. No credit cards required for signing up. After the trial you can renew your plan with a monthly or annual payment (discount). You can also signup for our Free plan, which doesn’t require any payment at all. <a target="_blank" href="http://www.flexytalk.com/support/faq/">Read our F.A.Q. for more information</a> </i></td>
					
                </tr>
<tr>
                     <td style="width:20%">Username</td>
                    <td><input style="width:150px" name="ft_username" value="<?php echo $username; ?>" style="width:100%;" id="ftpassword" placeholder="Enter your username" autocomplete="off" /><i>&nbsp;&nbsp;&nbsp;Use the login credentials for the FlexyTalk control panel (ie. ft13xxxx)</i></td>
                </tr>

<tr>
                     <td style="width:20%">Password</td>
                    <td><input style="width:150px" name="ft_password" value="<?php echo $password; ?>" style="width:100%;" type="password" id="ftpassword" placeholder="Enter your password" autocomplete="off" /> <i>&nbsp;&nbsp;These login credentials are mailed to you after the Plan was created.</i>

</td>
                </tr>
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
					<th colspan="2"></th>
				</tr>
			</thead>
			<tbody>
                <tr>
                    <td colspan="2"><iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Ffacebook.com%2Fflexytalk&amp;send=false&amp;layout=standard&amp;width=350&amp;show_faces=false&amp;font&amp;colorscheme=light&amp;action=like&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:350px; height:35px;" allowTransparency="true"></iframe>
					<br />
<a href="https://twitter.com/flexytalk" class="twitter-follow-button" data-show-count="false" data-lang="en">Follow @@flexytalk</a>
<script>!function (d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (!d.getElementById(id)) { js = d.createElement(s); js.id = id; js.src = "//platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs); } }(document, "script", "twitter-wjs");</script>
</td>
					<tr/>
					<tr>
  <td colspan="2"><strong>Please</strong>, <a href="http://wordpress.org/support/view/plugin-reviews/flexytalk-widget" target="_blank">take a moment to rate this plugin</a>, <strong>thank you!</strong></td>
					
                    
                </tr>
               
               
			</tbody>

			
		</table>

	

	<p class="submit">
	<input type="submit" class="button button-primary" name="Submit" value="<?php _e('Update Options', 'flexytalk_trdom' ) ?>" />
	</p>
</form>

</div>	 