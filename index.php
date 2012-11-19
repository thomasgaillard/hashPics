<?php
	/**
	 * ModelView
	 * Author: @thomasgaillard
	 */
	function get_tweets($hashtag){
		echo "<div id='loader'><img src='img/loader.gif' /><br/>Thank you wait a bit. I am currently working on rendering pics</div>";
		echo "<div id='container'>\n";
		echo "	<ul>\n";
		$i = 1;
		$iP = 0;
		$finish = false;
		while($finish == false && $i <= 15){
	        $url = 'http://search.twitter.com/search.json?q=%23'.$hashtag.'+exclude:retweets&rpp=100&page='.$i.'&include_entities=true&result_type=mixed';
	    	@$tweets = json_decode(file_get_contents($url));
	       	if($tweets->results){
	           	foreach($tweets->results as $entite){
	           		$pics_url = $entite->entities->media[0]->media_url;
	           		$pics_text = $entite->text;
	           		if(isset($pics_url) && $pics_url != ''){
	           			echo "		<li class='item'>\n";
	           			echo "			<a href='".$pics_url."' title='".$pics_text."'>\n";
	           			echo "				<img src='".$pics_url."'/>\n";
	           			echo "			</a>\n";
	           			echo "			<div class='mask'>\n";
	           			echo "				<h2>".$pics_text."</h2>\n";
	           			echo "  			<a href='".$pics_url."' class='info'>Enlarge</a>\n";
	           			echo "			</div>\n";         
	           			echo "		</li>\n";
	           			$iP ++;
	           		}
	           	}
	           	$i ++;
	       	}
	       	else
	       		$finish = true;
		}
		echo "	</ul>\n";
		echo "</div>\n";
		if(($finish && $i == 1) || ($iP == 0))
			echo "	<div id='no-photo'><div>Sorry, no photo found for #".$hashtag."</div><div class='big'>:(</div></div>\n";
	}
	
	
	/**
	 * View
	 * Author: @thomasgaillard
	 */
	function view_index(){
		?>
		<form action='index.php' method='get'>
		<div class="input-prepend input-append">
		  <span class="add-on">#</span>
		  <input type='text' name='hashtag' class="span2" id="appendedPrependedInput" placeholder="hashtag">
		  <input class="btn" type='submit' value='Go!' />
		</div>
		</form>
		<?php
	}
	
	
	/**
	 * Controler
	 * Author: @thomasgaillard
	 */
	$hashtag = $_GET["hashtag"];
	require_once("head.php");
	if(isset($hashtag) && $hashtag != '')
		get_tweets($hashtag);
	else
		view_index();
	require_once("foot.php");
?>