<?php
$language = get_bloginfo('language');
$charset = get_bloginfo('charset');
$name = get_bloginfo('name');
$url = get_bloginfo('url');
?>
<!DOCTYPE html>
<html lang="<?php echo $language; ?>">
<head>
    <meta charset="<?php echo $charset; ?>" />
    <meta name="viewport" content="width=device-width, initial-width=1">
    <title><?php echo $name; ?> &#8250; Auto Maintenance Mode</title>
    <link rel="stylesheet" href="<?php echo AUTO_MAINTENANCE_MODE_URL.'/amm-style.css' ?>" type="text/css" media="all" />	
</head>
<body>
    <div id="header">
        <h2><a title="<?php echo $name; ?>" href="<?php echo $url; ?>"><?php echo $name; ?></a></h2>
    </div>	
    <div id="content">
        <h1><?php _e('Auto Maintenance Mode', 'auto-maintenance-mode')?></h1>
        <!-- <p><?php echo $link_text;?></p> -->
        <p><?php _e('Maintenance mode is enabled automatically, due to lack of activity from logged-in users!', 'auto-maintenance-mode')?></p>
		<p><?php _e('To disable the maintenance mode, please ', 'auto-maintenance-mode')?><strong><a href="<?php echo wp_login_url()?>"><?php _e('login now', 'auto-maintenance-mode'); ?></a></strong><?php _e(' or visit this page or any page of this site using a browser where you have already logged-in.', 'auto-maintenance-mode')?></p>
        <p><?php _e('Sorry for the inconvenience.', 'auto-maintenance-mode')?></p>			
    </div>
</body>
</html>
