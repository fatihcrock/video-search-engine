<?php 
require_once 'libraries.php';
require_once 'videocore.php';



$video= new VideoCore();


$video->set_reklam('Redd ');


if(is_ajax()) {
    echo '<div class="col-md-8">';
    $searchkeywords = $video->set_keyword($_POST['keywords'])->get_keyword();
	$videos = $video->search_videos();
	
   
	foreach ($videos['youtube'] as $videoy) {
		if($videoy->accessControl->embed =='allowed'){
		$me ="jQuery('#myPlayerID').changeMovie({videoURL:'".$videoy->id."',ratio:'4/3',autoPlay:true, mute:false, startAt:10, opacity:1, loop:false,  addRaster:false, quality:'hd720'});";
		}else{
		$me="showmessage(".$videoy->id.");jQuery('#myPlayerID').playerDestroy()";
		}
		echo '<div id="'.$videoy->id.'" class=" col-xs-12 col-sm-4 col-md-3 ">
					<div  class="thumbnail">
                    
				      <div class="fiximage"   style="background-image:url('.$videoy->thumbnail->hqDefault.');"></div>
				      <div class="caption">
				        <h4>'.truncate($videoy->title,26).'</h4>
				        <p>'.truncate($videoy->description,25).'...</p>
				        
				        <p><a href="#" onclick="'.$me.' return false;" class="btn btn-primary" role="button">Play</a> <a href="" class="btn btn-info" role="button">Add List</a></p>
				      </div>
                       <div class="sticyimage youtube-con"></div>
				    </div>
 		 	</div>

            ';

	}


	
		foreach ($videos['vimeo'] as $videom) {
		

		echo '<div id="'.$videom->id.'" class=" col-xs-12 col-sm-4 col-md-3 ">
					<div class="thumbnail">
				   <div class="fiximage"   style="background-image:url('.$videom->thumbnails->thumbnail[2]->_content.');"></div>
				      <div class="caption">
				        <h4>'.truncate($videom->title,26).'</h4>
				        <p>'.truncate($videom->description,25).'...</p>
				        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
				      </div>
                       <div class="sticyimage vimeo-con"></div>
				    </div>
 		 	</div>';

	}


        foreach ($videos['dailymotion'] as $videom) {
        

        echo '<div id="'.$videom->id.'" class=" col-xs-12 col-sm-4 col-md-3 ">
                    <div class="thumbnail">
                   <div class="fiximage"   style="background-image:url('.$videom->thumbnail_large_url.')"></div>
                      <div class="caption">
                        <h4>'.truncate($videom->title,26).'</h4>
                        <p>'.truncate($videom->description,25).'...</p>
                        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                      </div>
                     <div class="sticyimage daily-con"></div>
           
                    </div>
                     </div>';

    }
	
	
	

	echo '</div>';
}


?>
