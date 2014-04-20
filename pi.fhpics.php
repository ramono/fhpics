<?php 

class Plugin_fhpics extends Plugin 
{
	
	var $meta = array(
		'name' 		 => 'FHPics',
		'version'	 => '1',
		'author'	 => 'Ramon Lapenta',
		'author_url' => 'http://ramonlapenta.com'
	);

	public function photos() 
	{
		$consumer_key = $this->fetchParam('consumer_key', null);
		$feature = $this->fetchParam('feature', 'user');
		$user = $this->fetchParam('user', null);

		$count = $this->fetchParam('count', 5, 'is_numeric');
		$image_size = $this->fetchParam('image_size', 3, 'is_numeric');
		$sort = $this->fetchParam('sort', 'created_at');
		$only = $this->fetchParam('only', null);
		$exclude = $this->fetchParam('exclude', null);

        $params = "photos?consumer_key=$consumer_key&feature=$feature&username=$user&sort=$sort&rpp=$count&image_size=$image_size";
	    if(isset($only)) 
	    {
	        $params .= '&only='.urlencode($only);
	    }
	    if(isset($exclude)) 
	    {
	        $params .= '&exclude='.urlencode($exclude);
	    }

        if ($response = $this->fhp_curl($params)) 
        {
            return object_to_array($response);
        }

        return false;		
	}

	public function photo() 
	{
		$consumer_key = $this->fetchParam('consumer_key', null);
		$id = $this->fetchParam('id', null);
		$image_size = $this->fetchParam('image_size', 4, 'is_numeric');

		$comments = $this->fetchParam('comments', null);

	    $params = "photos/$id?consumer_key=$consumer_key&image_size=$image_size";
	    if(isset($comments)) 
	    {
	        $params .= '&comments='.urlencode($comments);
	    }

        if ($response = $this->fhp_curl($params)) 
        {
        	$photo = object_to_array($response);
            return $photo['photo'];
        }

        return false;		
	}



	// Request query
    function fhp_curl($params) 
    {        
	    $host = 'https://api.500px.com/v1/';

        $request = curl_init($host.$params);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);

        $contents = curl_exec($request);
        
        if ($contents) 
        {
            return json_decode($contents);
        } 
        else 
        {
        	echo "500px requires the CURL library to be installed.";
        }
    }


}

# Convert results
function object_to_array($d) 
{
    if (is_object($d)) 
    {
        $d = get_object_vars($d);
    }
    if (is_array($d)) 
    {
        return array_map(__FUNCTION__, $d);
    }
    else 
    {
        return $d;
    }
}
