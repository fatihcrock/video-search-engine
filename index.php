<?php 
ob_start();
header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once 'videocore.php';
$video= new VideoCore();
$sites= $video->searchsites;
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>video</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/costum.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="background/css/YTPlayer.css" media="all" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Lekton' rel='stylesheet' type='text/css'>
    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
   
	 <script src="js/jquery.hotkeys.js"></script>
    <script type="text/javascript" src="background/inc/jquery.mb.YTPlayer.js"></script>
    <!-- Javascript -->
   <script type='text/javascript' src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.7.1/modernizr.min.js"></script>
 
 
   
</head>

<body class="imagebla">
	

    <!-- Navigation -->
    <nav class="navbar  navbar-fixed-top" role="navigation">
        
        <div class="container-fluid">
        		 <div class="row">
        		 	<div class="col-sm-3"><span id="videoTitle"></span></div>    
        		 	 
        		 	<!--search basla  -->
				        <div class="col-xs-12 col-sm-6 ">
				            <div class="input-group">
				                <div class="input-group-btn search-panel">
				                    <button type="button" class="btn  btn-primary dropdown-toggle" data-toggle="dropdown">
				                        <span id="search_concept">Source</span> <span class="caret"></span>
				                    </button>
				                    <ul class="dropdown-menu" role="menu">

				                    	<?php
				                    	   
				                    		foreach ($sites as $site) {
				                    			echo '<li><a href="#'.$site.'">'.$site.'</a></li>';
				                    		}


				                    	 ?>
				                     
				                    
				                    </ul>
				                </div>
				                <input type="hidden" name="search_param" value="all" id="search_param">         
				                <input type="text" id="keywords" value="<?php echo isset($searchkeywords) ? $searchkeywords :'';?>" class="form-control" name="x" placeholder="Search Video...">
				                <span class="input-group-btn">
				                   
				                    <button class="btn  btn-primary" type="button" onchange="search();" onclick="search();"><span class="glyphicon glyphicon-search"></span></button>
				                     <button class="btn  btn-primary" onclick="jQuery('#myPlayerID').playPrev()"><span class="glyphicon glyphicon-backward"></button>
                        			 <button  class="btn  btn-primary" onclick="jQuery('#myPlayerID').playNext()"><span class="glyphicon glyphicon-forward"></span></button>
                        			 <button class="btn  btn-primary" type="button"><span class="glyphicon glyphicon-fullscreen"></span></button>
				               		<button class="btn  btn-primary" type="button"><span class="glyphicon glyphicon-th"></span></button>
				               		<button class="btn  btn-primary" type="button"><span class="glyphicon glyphicon-th-large"></span></button>
				               		<button class="btn  btn-primary" type="button"><span class="glyphicon glyphicon-th-list"></span></button>
				               		<button class="btn  btn-primary" onclick="jQuery('#videos').toggle();" type="button"><span class="glyphicon glyphicon-film"></span></button>
				          
				               
				                </span>
          			    </div>
          			
          			    <!-- search bitti -->
          			     </div>
          			     
          			     
          			      <div class="col-sm-3">
				                   
				               
				                
				          </div>  



          
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

 
       <div id="myprettytitle" class="row-fluid clearfix ">
       	   
       	  
       
   
        
       </div>
       
       
       
     
       <div class="list hide">
       <div class="row-fluid clearfix ">
       	   
        <span class="video-title colors hidden-sm hidden-xs">dasdad</span>
   
        
       </div>
       <div class="row-fluid clearfix ">
       	   
        <span class="video-title colors hidden-sm hidden-xs">dsadasdas</span>
   
        
       </div>
       <div class="row-fluid clearfix ">
       	   
        <span class="video-title colors hidden-sm hidden-xs">asdsadasd</span>
   
        
       </div>
       </div>
      
       
       
       
       
       
       
       
       
       
       
       
       
       
       <div class="clearfix" style="height:20px;"></div>
 
       <div class="row-fluid">
       	   <img style="load" src="css/img/loading.gif" id="loading-indicator" style="display:none;" />
       
       	  	<div id="videos"></div>
        
       	
        
       </div>
        
       
       
        

  
       


    
<a class="player" id="myPlayerID" ></a>




</body>
 <script type="text/javascript">


    
            $(document).ready(function(e){

              $(document).on('keydown', null, 'right', function(){
              	
              	  jQuery("#myPlayerID").playPrev();
              	
              });
              $(document).on('keydown', null, 'return', function(){
              	
              	
              	 jQuery("#myPlayerID").playpauseYTP();
             
              	
              });
               $(document).on('keydown', null, '1', function(){
              	
              	
              	 jQuery("#myPlayerID").seekToYTP(0,true);
             
              	
              });
              $(document).on('keydown', null, 'left', function(){
              	
              	jQuery("#myPlayerID").playNext();
              	
              });


    $('.search-panel .dropdown-menu').find('a').click(function(e) {
        e.preventDefault();
        var param = $(this).attr("href").replace("#","");
        var concept = $(this).text();
        $('.search-panel span#search_concept').text(concept);
        $('.input-group #search_param').val(param);


    });
  

    $('#keywords').on('change',function(){

        var  keywords = $('#keywords').val();
        if(keywords!=''){
                search();

        }else{
            $('#videos').html('');


        }

    });

	 

//global ajax looding gif
 $(document).ajaxSend(function(event, request, settings) {
  $('#loading-indicator').show();
});
$(document).ajaxComplete(function(event, request, settings) {
  $('#loading-indicator').hide();
}); 
  

var videos = [

       {videoURL:"c8dSiyWIfEo"},
       {videoURL: "gZn6wdxX0u8"},
       {videoURL: "Y-AsetXNqDk"},
       {videoURL: "BcRNoNFpCS0"},
     
       
               ];

        jQuery("#myPlayerID").YTPlaylist(videos, false, function(video){
        	
        	
        	
            if(video.videoData){
                jQuery("#videoID").html(video.videoData.id);
                
                 $("#myprettytitle").hide().html(' <span class="video-title hidden-sm hidden-xs">'+video.videoData.title+'</span>').fadeIn();
                
                jQuery("#videoDuration").html(jQuery.mbYTPlayer.formatTime(video.videoData.duration));
                jQuery("#viewCount").html(video.videoData.viewCount);
            }
        });
        
        
        
        
        

        
        
        
        
        


});

function showmessage (id) {


  
}



  
function search(){


     var  keywords = $('#keywords').val();
     var  search_param=$('#search_param').val();

        $.ajax({
                          url: "videolist.php",
                          type: 'POST',
                          async: false,
                          data:'keywords='+encodeURIComponent(keywords),
                            }).done(function(data) {
                          $('#videos').html(data);
                            });

    }


$("body").on("mouseenter", ".thumbnail", function(){
     $(this).find('.caption').fadeIn(250); 
     
}).on("mouseleave", ".thumbnail", function(){
    $(this).find('.caption').fadeOut(250); 
});


    </script>
 
</html>
