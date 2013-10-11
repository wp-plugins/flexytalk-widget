<?php

$username = get_option('ft_username');
$password = get_option('ft_password');
?>
<script>		
function submitform()
{
    document.forms["flexyim"].submit();
}
</script>
<div class="wrap">
<table class="wc_status_table widefat" cellspacing="0">
<thead>
				<tr>
					<th><h2>FlexyTalk Web Client - Flexy Instant Messenger</h2></th>
				</tr>
			</thead>
<tbody>
                <tr>
                    <td style="font-size:1.2em;padding-bottom:1.5em">FlexyIM Web works with modern web browsers: Chrome, Safari, Firefox and Internet Explorer 10, but also on iPad, iPhone, BlackBerry 10, Android and other modern mobile devices.</td>
</tr>
</tbody>
<thead>
				<tr>
					<th>Desktop Notifications</th>
				</tr>
			</thead>
<tbody>
                <tr>
                    <td style="font-size:1.2em;padding-bottom:1.5em">Chrome, Safari and Maxthon support the Desktop Notification option as tested by us. This option can only be enabled with users permission. After login in to  the FlexyIM web client using the button below, click the “Enable Notifications” button in the header to grant your browser permission to send you Desktop Notifications. You only have to do this once per browser. When your Notifications are already enabled, you will receive a 'Notification Enabled' message when clicking the button, to test the functionality. </td>
</tr>
</tbody>
<thead>
				<tr>
					<th><form id="flexyim" action="http://flexyim.flexytalk.im/" method="post" target="_blank" >
<input type="hidden" name="username" value="<?php echo $username ?>"> <input type="hidden" name="password" value="<?php echo $password ?>">
 <input type="submit" class="button button-primary"  value="Get Online Now!">
</form>
</th>
				</tr>
			</thead>
</table>