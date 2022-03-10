<?php
//per stampa valori vuoti o uguali a zero
function noValue($value)
{
	if($value == "")
		return "-";
	elseif($value == "0")
		return "";
	else
		return $value;

}

//localizzare data
function dataLocal($value)
{
	if(Auth::User()){
	    $me = \Auth::User();
	    //se esiste il settaggio del fuso orario
	    if($me->timezone){
		    $tz = $me->timezone;
		    return $value->addHours($tz);
		}else
			return $value;
	}
	return $value;
}

//crea oggetto data Carbon
function objectDate($dateDB){
	if($dateDB != ""){
		if ($dateDB instanceof Carbon) {
            return $dateDB;
        }
		return Carbon\Carbon::createFromFormat('Y-m-d', $dateDB);
	}
	else
		return "";
}
//crea oggetto datatime Carbon
function objectDateTime($timestampDB){
	if($timestampDB != ""){
		if ($timestampDB instanceof Carbon) {
            return $timestampDB;
        }
		return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $timestampDB);
	}
	else
		return "";
}

//converte la data nel formato desiderato controllando che non sia nullo
function printDate($dateDB, $format){
	return ($dateDB == "" || $dateDB == "0000-00-00") ? "-" : objectDate($dateDB)->formatLocalized($format);
}
//converte il timestamps nel formato desiderato controllando che non sia nullo
function printDateTime($dateDB, $format){
	return ($dateDB == "" || $dateDB == "0000-00-00 00:00:00") ? "-" : dataLocal(objectDateTime($dateDB))->formatLocalized($format);
}
function printTemp($timestampDB){
	Carbon\Carbon::setLocale(\App::getLocale());
	return objectDateTime($timestampDB)->diffForHumans();
}
function printTemp48($timestampDB, $format){
	$diff = Carbon::now()->diffInHours(objectDateTime($timestampDB));
	if($diff<=48)
		return printTemp($timestampDB);
	else
		return printDateTime($timestampDB, $format);
	/*printTemp($timestampDB);*/
}

function dataDb($dateDB){
	return printDate($dateDB, "");
}

function timestampDb(){
	return printDateTime($dateDB, "");
}

//impostare preselezione select
function editInputOldSel($field, $dbvalue, $value){
	if(old($field, $dbvalue) == $value) 
		echo 'selected';
}

function getFileName($nome){
	$nome = ucfirst(str_replace("_", " ", (str_replace("-", " ", substr($nome,0,strpos($nome,'.'))))));
	$nome = strlen($nome) >= 25 ? substr($nome,0,22)."..." : $nome;
	return $nome;
}

function getThumb($doc, $prev_path, $type){
	$ext = substr($doc->filename, strpos($doc->filename,'.')+1, strlen($doc->filename));
	$array = ['ext' => $ext];
	$validator = Validator::make($array, ['ext' => 'in:png,gif,jpeg,jpg,bmp']);

    if ($validator->fails()) {
		return url(Config::get('path.default').$ext.".png");
	}
	return url(Config::get('path.'.$type). $prev_path .'/'. $doc->filename);
}

function select_if($searchValue, $array){
	if($array){
		if(array_search($searchValue, $array) !== false)
			echo "selected";
	}
}

function extend_itEs($it_es){
	$stringa = "";
		
	if($it_es == "it")
		$stringa .= "Italia";
	elseif($it_es == "es")
		$stringa .= "Estero";
		
	return $stringa;
}
