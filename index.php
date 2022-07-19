<?php
// PHP section
// Image directory! fill in! relative to root
$imageDir = '/images/';
define('SERVERPATH', $_SERVER['DOCUMENT_ROOT'].$imageDir);
define('HTTPPATH', 'http://'.$_SERVER['HTTP_HOST'].$imageDir);

// read the names of images from the image directory
$dir = opendir(SERVERPATH);
$javascriptArray = null;
$i = null;
while (false !== ($file = readdir($dir))) {
	if (preg_match('(PNG|png|jpg|JPG|jpeg|JPEG|GIF|gif)', $file)){
	    $javascriptArray .= $i.'"'.HTTPPATH.$file.'"';
	    $i = ',';
	}
}
closedir($dir);
?>

<html lang="en">
	<head>
		<META HTTP-EQUIV="refresh, Cache-Control" CONTENT="no-store,420;url=http://wellness.plymouthharbor.org/" /> 
		<!-- If running a longer video than 420 seconds, CONTENT="" needs to change.   Currently set to 420 seconds (7 minutes) so Wellness can see updates more quickly-->
		
		<title>Wellness Station</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		
		<script type="text/javascript">

			orderedImages = new Array(<?php echo $javascriptArray; ?>);
			imageCount = orderedImages.length;
			firstTime = true;
			duration = "12"; //seconds

			function displayImage(){
				// Cycle through images sequentially based off array index (Images need to be numbered with leading 0's to display in order.  Example:  01, 02, etc.)
				// Do not update the image if loading is not yet completed
				if (document.getElementById('orderedImage').complete || firstTime){
					if (firstTime) {
						thisImage = 0 
						firstTime = false
					}else{
						thisImage++
						if (thisImage == imageCount) {
							thisImage = 0
							//When the final image is played
							//thisImage is set to 0 so start the array over and start the slide show from the beginning
						}
					}
					document.getElementById('orderedImage').src = orderedImages[thisImage]
					//console.log(orderedImages[thisImage]);
					setTimeout("displayImage()", duration * 1000) //duration * milliseconds
				}
			}

		</script>

		<style type="text/css">

		#slideshow{
				width:auto;
				height:auto;

				border-top:0px solid #997;
				border-right:0px solid #997;
				border-bottom:0px solid #664;
				border-left:0px solid #664;
				
				overflow:hidden; /* hide scroll bar (this is a comment) */
				cursor: none;   /* hide cursor */
			}
			
			#orderedImage{
				display:block;
				width:1920;
				height:1080;
				
				border-top:0px solid #664;
				border-right:0px solid #664;
				border-bottom:0px solid #997;
				border-left:0px solid #997;

		      /*  -webkit-animation-name: fade;
 		   		-webkit-animation-iteration-count: 6s infinite;
			    -webkit-animation-timing-function: ease-in-out;
 		   		-webkit-animation-duration: 2s;
	   			-webkit-animation-delay: 1s;
				-webkit-transition-delay: 0s;
			   
				animation-name: fade;
 		   		animation-iteration-count: 6s infinite;
 		   		animation-duration: 3s;
				animation-timing-function: ease-in-out;
				animation-delay: 10s;
				transition-delay: 0s;*/
				
				
			}

	/*	@-webkit-keyframes fade {
		  0% {opacity: 0;}
  		  20% {opacity: 1;}
		  33% {opacity: 1;}
  		  53% {opacity: 0;}
  		  100% {opacity: 0;}
		}

		@keyframes fade {
			0% {opacity: 0;}
			20% {opacity: 1;}
			33% {opacity: 1;}
			53% {opacity: 0;}
			100% {opacity: 0;}
		}*/

			#videoLocationBottomRight {
				position: absolute;
				right: 0px;
				left: 1350px;
				top: 750px;
				bottom: 0px;
			}

			#videoLocationFullScreen {
				position: auto;
				width: auto;
				height: auto;
			}

		</style>
		
	</head>

	<body>
		<div id="slideshow">
			<img id="orderedImage" src="" alt="">
		</div>
		<script type="text/javascript">
		     displayImage();	
		</script>		
	</body>
</html>
