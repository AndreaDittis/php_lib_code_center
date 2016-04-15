<?php 
//排列顺序从左至右依次为：六位数字地址码，八位数字出生日期码，三位数字顺序码和一位数字校验码。

class IdCard{
	public $id_card = "";
	public $city_num = "";
	public $years = "";
	public $month = "";
	public $day = "";
	public $chekc_code = "";
	
	public function __construct($id_card){
		$this->id_card = strval($id_card);
	}

	public function rdget_id_card(){
		
	}
	
	public function verify_id_card(){
		if(empty($this->id_card)){
			return "id_car is empty";
		}
		
		if(strlen($this->id_card)!=18){
			return "id_card length is wrong";
		}
		
		$id_card = $this->id_card;
		$check_indexs = array(7,9,10,5,8,4,2,1,6,3,7,9,10,5,8,4,2);
		//0－1－2－3－4－5－6－7－8－9－10 对应1－0－X －9－8－7－6－5－4－3－2
		$remainder = array(1, 0, 'X', 9, 8, 7, 6, 5, 4, 3, 2);
		$tmp_total = 0;
		
		foreach($check_indexs as $i=>$check_index){
			$tmp_total += $check_index*$id_card[$i];	
		}

		$remaind_index = $tmp_total%11;
		$real_id_card = substr($id_card, 0, -1)."$remainder[$remaind_index]";
		if($id_card[17] != $remainder[$remaind_index]){
			return "$this->id_card last check_code is wrong,real_idcard is $real_id_card";
		}

		return $this->id_card." is ok!!!";
	}
	
	public function get_idcard_info(){
		
	}
}

$test_id_card = "120113198105113214";
$id_card_obj = new IdCard($test_id_card);
echo $id_card_obj->verify_id_card();
?>