<?php 

	Class VideoCore{


	
		public $keywords;
		public $searchsites=array('youtube','vimeo','dailymotion');
		public $reklam;
	


		public function __construct() { 

		




		} 


		public function set_keyword($keywords){


			$this->keywords= $this->_cleankeywords($keywords);
			

			 return $this;


		}
		public function set_reklam($reklam){

			


			$this->reklam= $this->_cleankeywords($reklam);
			

			 return $this;


		}
		public function get_keyword(){

			return  $this->keywords;
			 
			

		}



		public function _cleankeywords($keywords){

				 
				return urlencode(strip_tags(trim($keywords)));


		}

		public  function set_sites($sites){



			 $this->searchsites=$sites;

			 return $this;

		}


		public function search_videos(){
			 	$me = !empty($this->reklam) ? $this->reklam : '*';
			    $this->keywords = $this->keywords=='' ? $me  : $this->keywords;
		    	
			   foreach ($this->searchsites  as $site) {
			   	 $func = 'search_'.$site;
			   	  $sitedata = $this->{$func}();
				  if($site != NULL){
				  	
					$video[$site] =$sitedata;
					
				  }
			   }
			   
			  	


			  	//$this->bas($video);
			  return $video;




		}

		

		public function search_youtube(){

			

			$url ='https://gdata.youtube.com/feeds/api/videos?q='.$this->keywords.'&orderby=relevance&start-index=1&max-results=20&v=2&alt=jsonc';
			
		
		
			$useragent = "Opera/9.80 (J2ME/MIDP; Opera Mini/4.2.14912/870; U; id) Presto/2.4.15";

			$curl = curl_init();
			curl_setopt ($curl, CURLOPT_USERAGENT, $useragent);
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_HEADER, 0);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_TIMEOUT, 10);
			//curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			$return = curl_exec ($curl);
			curl_close($curl);
			
			$response = json_decode($return);
			
				return  isset($response->data->items) ? $response->data->items : NULL ;
		}




		public function search_vimeo(){

			require_once('vimeo/vimeo.php');
 
			$key = "0b8e248dbb828205d522a321e52d642a1b83fc9b";
			$secret = "bfba17404444f0ce9962c0b0a349ac55b5ce43bd";
			$limit = 20; 


			$vimeo = new phpVimeo($key, $secret);
			$response = $vimeo->call('vimeo.videos.search', array('full_response'=>'1','per_page' => $limit, 'query' => $this->keywords, 'sort' => 'relevant'));

		


		 return  isset($response->videos->video) ? $response->videos->video : NULL ;


			
		}
			public function search_dailymotion(){

			

			$url ='https://api.dailymotion.com/videos?fields=description,thumbnail_large_url,embed_url%2Cid%2Cposter_360x480_url%2Crecorded_from.thumbnail_60_url%2Cstream_h264_hd1080_url%2Ctitle%2Curl&search='.$this->keywords.'&page=50&limit=20';
			
		
		
			$useragent = "Opera/9.80 (J2ME/MIDP; Opera Mini/4.2.14912/870; U; id) Presto/2.4.15";

			$curl = curl_init();
			curl_setopt ($curl, CURLOPT_USERAGENT, $useragent);
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_HEADER, 0);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_TIMEOUT, 10);
			//curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			$return = curl_exec ($curl);
			curl_close($curl);
			
			$response = json_decode($return);
			
				return  isset($response->list) ? $response->list : NULL ;
		}


		
       //  http://alkislarlayasiyorum.com/etiket/akdeniz/video/encokizlenen/yil/2

		//Application ID: ea0dc803ca4d4f9185f459692420fb6d

		//Application password: b264e80202b44f47a9360e293b0eeba4

		public function bas($me){

			echo '<pre>';
			var_dump($me);
			echo '</pre>';


		}





	}












?>