<html>
<head>
<style>
	html {
		font-size:62.5%;
	}
	body {
		font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;
		font-size:14px;
		line-height:1.42857143;
		color:#333;
		background-color:#fff
	}
	#wrapper {
		width: 853px;
		margin: 0 auto; 
	}
</style>
</head>
<body>
	<div id="wrapper">
		<p><div id="ytplayer"></div></p>
		<p>No more recording youtube videos into gifs: <strong>MuteYoutube.com</strong> makes youtube videos more shareable by muting, looping and simplifying, while keeping the high video quality and functionality, and rewarding the original artist with views. </p>
		<p>How to use:
		<ul>
		<li>Simply replace the "youtube.com" in a video URL with "muteyoutube.com".</li>
		<li>You can add &amp;t=<i>(start time in seconds)</i> and &amp;end=<i>(end time in seconds)</i> to only loop a certain part of the video.
		<li>Example URL: http://www.muteyoutube.com/watch/?v=5nGaXY5Gxy4&t=355&end=360</li>
		</ul></p>
	</div>
	
<?php  

if	(!isset($_GET['v'])) 
    echo "<p>[No video ID found]</p>";
else
{
	$v = htmlspecialchars($_GET["v"]);
	
	if	(isset($_GET['t'])) 
		$t = htmlspecialchars($_GET["t"]);
	else
		$t = 0;
	if	(isset($_GET['end'])) 
		$end = htmlspecialchars($_GET["end"]);
	else
		$end = 0;
	
	echo <<<END
   
		<script>
		var tag = document.createElement('script');
		  tag.src = "https://www.youtube.com/player_api";
		  var firstScriptTag = document.getElementsByTagName('script')[0];
		  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
		  
		 function onYouTubeIframeAPIReady() {
		  var player;
		  player = new YT.Player('ytplayer', {
			videoId: '$v', // YouTube Video ID
			width: 853,               // Player width (in px)
			height: 480,              // Player height (in px)
			playerVars: {
			  suggestedQuality: 'large',
			  autoplay: 1,        // Auto-play the video on load
			  controls: 1,        // Show pause/play buttons in player
			  showinfo: 0,        // Hide the video title
			  modestbranding: 1,  // Hide the Youtube Logo
			  loop: 1,            // Run the video in a loop
			  cc_load_policty: 0, // Hide closed captions
			  iv_load_policy: 3,  // Hide the Video Annotations
			  start: $t,
			  end: $end,
			  playlist: '$v&end=$end',
			  rel: 0			//no related videos
			},
			
			events: {
			  onReady: function(e) {
				e.target.mute();
				e.target.playVideo();
				},
			  onStateChange: function(e){
				if (e.data === 0) {
					e.target.loadVideoById({'videoId': '$v',
							   'startSeconds': $t,
							   'endSeconds': $end});
					}
				}
			}
		  });
		 }
		 
		 // mute example by @labnol 
		</script>
END;
}

	?>
</body>
</html>