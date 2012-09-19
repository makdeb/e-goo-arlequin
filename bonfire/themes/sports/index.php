<?php
	// Setup our default assets to load.
	Assets::add_js( array(
		base_url() .'assets/js/jquery-1.7.1.min',
		));
	
?>

<!doctype html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<?php header('Content-type: text/html; charset=utf-8')?>
	<title><?php echo config_item('site.title'); ?></title>
	<meta name="keywords" content="прогнозы, спорт, ставки" />
	
	<link rel="shortcut icon" type="image/x-icon" href="/trophy-icon.png">
	<script type="text/javascript" src="/bonfire/themes/sports/js/validate.js"></script>
	
	<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
	<script type="text/javascript">stLight.options({publisher: "ur-2eb3f17a-efcb-cfef-5fe4-fc9b4403830e"}); </script>
	
	<?php echo Assets::css(); ?>
	
	<?php echo Assets::js(); ?>

	<script type="text/javascript">

 		 var _gaq = _gaq || [];
  		_gaq.push(['_setAccount', 'UA-31035026-1']);
  		_gaq.push(['_trackPageview']);

  		(function() {
    		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  		})();

	</script>

	<!--[if IE 6]>
	<script src="<?php echo base_url() .'assets/js/DD_belatedPNG.js';?>"></script>
	
  	<script>
		DD_belatedPNG.fix('#slider, #greedy,.bx-window'); 
	</script>
	
	<![endif]-->
</head>
<body>

	<div id='body'>
	
		<?php echo theme_view('header'); ?>
	
	<div id='wrapper'>
	
			<div id='content'>
			
			
			<?php echo Template::yield(); ?>
           		
			
			</div>
			
			<div id="sidebar">
				<?php Template::block('sidebar','sidebar'); ?>
			</div>
		
	</div>
	</div>
	
		<div id="foo_wrap">
		<?php echo theme_view('footer'); ?>
		
		</div>
		<img src="<?php echo Template::theme_url() ;?>images/buy_new.png" width="1" height="1" style="visibility: hidden;"/>
		<img src="<?php echo Template::theme_url() ;?>images/met_button_t2.png" width="1" height="1" style="visibility: hidden;"/>
		<img src="<?php echo Template::theme_url() ;?>images/face_29.png" width="1" height="1" style="visibility: hidden;"/>
		<img src="<?php echo Template::theme_url() ;?>images/vko_29.png" width="1" height="1" style="visibility: hidden;"/>
		<img src="<?php echo Template::theme_url() ;?>images/twitter_29.png" width="1" height="1" style="visibility: hidden;"/>

</html>