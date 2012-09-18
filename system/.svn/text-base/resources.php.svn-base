<?php

require_once 'routes.php';

function submit_to($application,$controller,$method){

	$router = new Router();
	$url = $router->getCurrentURL();
	$url_submit = $url."".$application."/".$controller."/".$method;
	print($url_submit);

}

function load_snippet($snippet){
    
    $url = dirname(__FILE__).'/snippets/'.$snippet.'.php';
    require_once $url;
    
    
}

function load_open_layers(){
    
    js_vendors('openlayers','openlayers.js');
    
    
}

function js_vendors($vendor,$scriptname){
    
    
    print('<script type="text/javascript" src="'.getResource().VENDORS.$vendor.'/'.$scriptname.'"></script>');
    
    
}

// Short method to have links
function lnk($rt,$description){
    
    $vars = get_class_vars(Routes);
    
    foreach ($vars as $key => $value) {
        
        $package = Routes::${$key};
        
        if($package['id']==$rt){
         
            $route = $package['route'];
            lnk_param($route['application'], $route['module'], $route['method'],$description);
            
        }
        
    }
    
}

function lnk_param($application,$controller,$method,$description,$params=""){

	$url_submit = "";
	$router = new Router();
	$url = $router->getCurrentURL();
	if(!empty($params)){
	$url_submit = $url."".$application."/".$controller."/".$method."/".$params;
	}else{
	
		$url_submit = $url."".$application."/".$controller."/".$method;
	}
	
	print('<a href="'.$url_submit.'">'.$description.'</a>');
	
}
function getResource(){

	$resource = BASE_PATH.'/'.WORKING_FOLDER;


	return $resource;

}

function image($image){


	print('<img class="spacer" src="'.getResource().STYLE.$image.'"'.'alt="'.$image.'">');


}

function imaget($image){


	return '<img src="'.getResource().STYLE.$image.'"'.'alt="'.$image.'">';


}

function image_url($image){
    
    return getResource().STYLE.$image;
}


function image_tag($image,$id="",$title=""){


        if(empty($id)){
            
            return '<img src="'.getResource().STYLE.$image.'"'.'alt="'.$image.'">';
        }else{
            
            return '<img src="'.getResource().STYLE.$image.'"'.'alt="'.$image.'" id="'.$id.'" title="'.$title.'">';
        }
    
	


}

function image_from_location($image,$id=""){

	print('<img src="'.getResource().UPLOAD_LOCATION.$image.'"'.'alt="'.$image.'" id="'.$id.'">');

}

function get_image_location($image){
    
    return getResource().UPLOAD_LOCATION.$image;
}

function get_image_url_location($image){

	print getResource().UPLOAD_LOCATION.$image;

}

function get_image_url($image){

	return getResource().UPLOAD_LOCATION.$image;

}

function action_to($module,$action){

	print("$module/$action");

}

function link_to($link,$description){


	print('<a href="'.getResource().$link.'">'.$description.'</a>');


}

function back_to($link,$description){


	print('<a class="back" href="'.getResource().$link.'">'.$description.'</a>');


}




function link_to_parameter($link,$description,$param){


	print('<a href="'.getResource().$link.'/'.$param.'">'.$description.'</a>');

}

function image_link($link,$image,$params='',$tooltip=''){


	if(empty($params)){
		
		
		print('<a href="'.getResource().$link.'">'.image_tag($image).'</a>');
		
	}else{

		print('<a href="'.getResource().$link.'/'.$params.'" title="'.$tooltip.'">'.image_tag($image).'</a>');
	}

}








function image_tolink($link,$image,$descripcion=""){


	print('<a href="'.getResource().$link.'">'.image($image)."".$descripcion.'</a>');


}

function link_css($stylesheet=""){

	print('<link rel="stylesheet" href="'.getResource().''.DEFAULT_CSS.'">');

	if(!empty($stylesheet)){
		print('<link rel="stylesheet" href="'.getResource().''.CSS_FOLDER.$stylesheet.'">');
	}


}

function lnk_css($stylesheet=""){

	print('<link rel="stylesheet" href="'.getResource().''.CSS_SYSTEM_FOLDER.'style.css">');
        print('<link rel="shortcut icon" type="image/x-icon" href="'.getResource().''.CSS_SYSTEM_FOLDER.'favicon.ico">');
        

	if(!empty($stylesheet)){
		print('<link rel="stylesheet" href="'.getResource().''.CSS_SYSTEM_FOLDER.$stylesheet.'">');
	}


}


function css_jquery($stylesheet=""){
   
	if(!empty($stylesheet)){
                
		print('<link rel="stylesheet" href="'.getResource().''.CSS_JQUERY_FOLDER.$stylesheet.'">');
	}else{
            $stylesheet='jquery.ui.all.css';
            print('<link rel="stylesheet" href="'.getResource().''.CSS_JQUERY_FOLDER.$stylesheet.'">');
        }
    
}

function link_javascript($javascript=""){


	if(!empty($javascript)){

		print('<script type="text/javascript" src="'.getResource().JAVASCRIPT_FOLDER.$javascript.'"></script>');
	}else{

		print('<script type="text/javascript" src="'.getResource().JAVASCRIPT.'"></script>');

	}


}

