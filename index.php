<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>FB Test</title>
	</head>
<body>
<div style='font-size: 16px; font-weight: bold; margin: 0 0 10px 0;'>
	This album is synchronized with all photos posted to the NCD page by other users.
</div>
<?php
	require 'fb-sdk/src/facebook.php';

	$facebook = new Facebook(array(
	  'appId'  => '289203454432613',
	  'secret' => 'cd89f29ae74dcd8cae1d10b6ef36519b',
	  'cookie' => true, // enable optional cookie support
	));
	
	//defining action index
	
	$fql    =   "SELECT pid, object_id, src_big, src, link, caption FROM photo WHERE pid IN(SELECT pid from photo_tag WHERE subject='131363313573224')";
	$param  =   array(
	 'method'    => 'fql.query',
	 'query'     => $fql,
	 'callback'  => ''
	);
	$fqlResult   =   $facebook->api($param);

	echo "<div id='gallery'>";
	
	foreach( $fqlResult as $keys => $values ){
		
		if( $values['caption'] == '' ){
			$caption = "";
		}else{
			$caption = $values['caption'];
		}	
		
		echo "<div style='padding: 10px; width: 150px; height: 170px; float: left;'>";
			echo "<a href=\"" . $values['src_big'] . "\" title=\"" . $caption . "\">";
			echo "<img src='" . $values['src'] . "' style='border: medium solid #ffffff;' />";
			echo "</a>"; 
		echo "</div>";
	}
	
	echo "</div>";

?>
	
	
	<!-- START JLIGHTBOX -->
	
		<script type="text/javascript" src="jQuery-lightbox/js/jquery.js"></script>
		<script type="text/javascript" src="jQuery-lightbox/js/jquery.lightbox-0.5.js"></script>
		<link rel="stylesheet" type="text/css" href="jQuery-lightbox/css/jquery.lightbox-0.5.css" media="screen" />
		
		<script type="text/javascript">
		$(function() {
			$('#gallery a').lightBox();
		});
		</script>
	
	<!-- END JLIGHTBOX -->
  </body>
</html>