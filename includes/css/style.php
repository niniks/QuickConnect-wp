<?php
     $absolute_path = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
 $wp_load = $absolute_path[0] . 'wp-load.php';
 require_once($wp_load);

            global $options;
            //Main colors
            $backgroundColor = get_option('background_color');
            $buttonColor = get_option('button_color');


  header('Content-type: text/css');
  header('Cache-control: must-revalidate');
?>
.connect-websites {
	position:fixed;
	top:50px;
	right:0px;
}

.connect-websites .connect-button {
	background: <?php echo $buttonColor; ?>;
    color: #fff;
    font-size: 24px;
    margin: 0;
    padding: 10px 22px;
    cursor:pointer;
}

.connect-websites ul {
	    margin: 10px 10px;
    opacity: 0;
    background: <?php echo $backgroundColor; ?>;
    padding: 11px;
    position: fixed;
    right: -10px;
    width: 185px;
}

.connect-websites li a {
	    color: #fff;
    font-size: 14px;
    line-height: 30px;
}
.connect-websites ul li {
	list-style-type:none;
	margin:0;
	padding:0;
}
.connect-websites ul h4 {
	color:#fff;
}
.connect-websites ul p {
	color:#fff;
}