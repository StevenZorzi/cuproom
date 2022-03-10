<?php
use App\Lib\Language;
use App\Lib\Image;
use App\Lib\Document;
use App\User;
use App\Models\Products\Variant;


//USERS

function isSuperAdmin($role){
	return $role == "superadmin";
}
function isAdmin($role){
	return $role == "admin";
}
function isUser($role){
	return $role == "user";
}

function getUser($user_id)
{
    $user = User::where('id', $user_id)->first();

    if($user)
    	return $user;
    else
    	return "";
}

function slug_gen($str){
	$clean = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $str);
	$clean = preg_replace("/[^a-zA-Z0-9_|+ -]/", '', $clean);
	$clean = strtolower(trim($clean, '-'));
	$clean = preg_replace("/[_|+ -]+/", '-', $clean);

	return $clean;
}

function frontUrl($module_id, $lang, $slug = ''){
	$slug = $slug == '' ? '' : '/'.$slug; 
	$url = url($lang."/".config('paths.front_path'))."/".trans('settings.module-'.$module_id.'-slug',array(), $lang).$slug;
	return $url;
}

function select_languages($language, $code){
	$language = "<div class='col-xs-6'><span style='padding-top:2px; display:inline-block'>".$language['native']."</span></div><div class='col-xs-5 text-left'> &nbsp; <img class='pull-right' src='".asset('img/flags/'.$code.".png")."' height='17'></img></div><div class='clearfix'></div>";
	return $language;
}

function select_products($product){
	$option = "<div class='col-xs-6'><span style='padding-top:12px; display:inline-block'>".$product->getMainText()->name."</span></div><div class='col-xs-5 text-left'> &nbsp; <img class='pull-right' src='".asset($product->preview())."' height='40'></img></div><div class='clearfix'></div>";
	return $option;
}

/*function checkSlugUrl_categories($categories, $parentId){

	foreach($categories as $category){
			$parent = $category->parent();
        	
        	foreach($category->data as $cat_trans){
        		$url = route('check-slug', ['table' => 'categories', 'ref' => $cat_trans->id]);
        		//echo "url['check_slug_".$cat_trans->id."'] = '$url';\n";
        	}

		if($category->getChilds()->count()){
			
			checkSlugUrl_categories($category->getChilds(), $category->id);
		}
    }
}*/

function print_categories($categories, $parentId){

	foreach($categories as $category){
			$parent = $category->parent();
        ?>
	        <option value="<?=$category->id?>"><?=$category->getMainName()?> <?php if(!is_null($parent->parent_id)){ ?>( &rarr; <?=$parent->getMainName()?>)<?php } ?></option>
		<?php
		if($category->getChilds()->count()){
			
			print_categories($category->getChilds(), $category->id);
		}
    }
}

function print_cat_tree($categories, $parentId, $checked){

	echo "<ul>";
	foreach($categories as $category){
        ?>
		    <li id="<?=$category->id?>" <?php if(in_array($category->id, $checked)){ ?> data-checkstate="checked" <?php } ?>><?=$category->getMainName()?>
		<?php
		if($category->getChilds()->count()){
			
			print_cat_tree($category->getChilds(), $category->id, $checked);
		}
    }
    echo "</li></ul>";
}


function sizes(){
	$sizes = Variant::where('type','size')->orderBy('ordering', 'asc')->with('data')->get();
	return $sizes;
}

function colors(){
	$colors = Variant::where('type','color')->orderBy('ordering', 'asc')->with('data')->get();
	return $colors;
}

function img_path($obj, $img, $thumb = 0){
	
	if($thumb == 1){$thumb = "thumb-";}
	elseif($thumb == 2){$thumb = "small-";}
	else{$thumb = "";}
	
	$table = $obj->getTable();

	return asset(config('paths.'.$obj->getTable().'_img').$obj->id.'/'.$thumb.$img->filename);
}
function otherLang(){
	if(config('app.locale') == 'it')
		return 'en';
	else
		return 'it';
}
