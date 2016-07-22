<?php
$language = get_bloginfo('language');
$charset = get_bloginfo('charset');
$name = get_bloginfo('name');
$url = get_bloginfo('url');
// $link_text = sprintf(wp_kses(__('<a title="%s" href="%s">%s</a> is down for maintenance.', 'auto-maintenance-mode'), array('a' => array('href' => array(), 'title' => array()))), $name, esc_url($url), $name);
?>
<!DOCTYPE html>
<html lang="<?php echo $language; ?>">
<head>
    <meta charset="<?php echo $charset; ?>" />
    <meta name="viewport" content="width=device-width">
    <title><?php echo $name; ?> &#8250; Simple Maintenance</title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="stylesheet" href="<?php echo AUTO_MAINTENANCE_MODE_URL.'/amm-style.css' ?>" type="text/css" media="all" />	
</head>
<body>
    <div id="header">
        <h2><a title="<?php echo $name; ?>" href="<?php echo $url; ?>"><?php echo $name; ?></a></h2>
    </div>	
    <div id="content">
        <h1><?php _e('Auto Maintenance Mode', 'auto-maintenance-mode')?></h1>
        <!-- <p><?php echo $link_text;?></p> -->
        <p><?php _e('Maintenance mode is enabled automatically, since no logged-in user has used it lately!', 'auto-maintenance-mode')?></p>
        <p><?php _e('To disable the maintenance mode, please ', 'auto-maintenance-mode')?><a href="<?php echo wp_login_url()?>">login now</a><?php _e(' or visit this page or any page of this site using a browser where you have already logged-in.', 'auto-maintenance-mode')?></p>
        <p><?php _e('Sorry for the inconvenience.', 'auto-maintenance-mode')?></p>			
    </div>
</body>
</html>
