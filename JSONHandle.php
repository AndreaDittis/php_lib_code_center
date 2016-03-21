<?php

//PHP数组(包含中文，多维数组)转换为正确的json值
function json_handle_encode($array){
	if(version_compare(PHP_VERSION, '5.4.0') >= 0) {
		return json_encode($array, JSON_UNESCAPED_UNICODE);
	}else{
		$urlencode_array = foreach_all_urlencode($array);
		return urldecode(json_encode($urlencode_array));
	}	
}

function foreach_all_urlencode($array){
	foreach($array as $key=>$val){
		if(!is_array($val)){
			$array[$key] = urlencode($val);
		}else{
			$array[$key] = foreach_all_urlencode($val);
		}
	}
	
	return $array;
}


$array = array(
	array('id'=>1, 'name'=>'张三', 'pwd'=>'abc'),
	array('id'=>2, 'name'=>'李四', 'pwd'=>'efg'),
	array('id'=>3, 'name'=>'cc', 'pwd'=>'xx', 'more'=>array('a'=>'小说','b'=>'文章')),
	array('id'=>4, 'name'=>'dd', 'pwd'=>'fee'),
	'more'=>array('a'=>'天气','b'=>'美丽')
);

echo json_handle_encode($array);