    <?php
     // 作用取得客户端的ip、浏览器、本地真实IP
     // 地理位置信息通过网站接口
     class get_gust_info { 
      
      ////获得访客浏览器类型
      function GetBrowser(){
       if(!empty($_SERVER['HTTP_USER_AGENT'])){
        $br = $_SERVER['HTTP_USER_AGENT'];
        if (preg_match('/MSIE/i',$br)) {
                   $br = 'MSIE';
        }elseif(preg_match('/Firefox/i',$br)) {
         $br = 'Firefox';
        }elseif (preg_match('/Chrome/i',$br)) {
         $br = 'Chrome';
           }elseif (preg_match('/Safari/i',$br)) {
         $br = 'Safari';
        }elseif (preg_match('/Opera/i',$br)) {
            $br = 'Opera';
        }else {
            $br = 'Other';
        }
        return $br;
       }else{return "获取浏览器信息失败！";} 
      }
      
      ////获得访客浏览器语言
      function GetLang(){
       if(!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
        $lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        $lang = substr($lang,0,5);
        if(preg_match("/zh-cn/i",$lang)){
         $lang = "简体中文";
        }elseif(preg_match("/zh/i",$lang)){
         $lang = "繁体中文";
        }else{
            $lang = "English";
        }
        return $lang;
        
       }else{return "获取浏览器语言失败！";}
      }
      
       ////获取访客操作系统
      function GetOs(){
       if(!empty($_SERVER['HTTP_USER_AGENT'])){
        $OS = $_SERVER['HTTP_USER_AGENT'];
          if (preg_match('/win/i',$OS)) {
         $OS = 'Windows';
        }elseif (preg_match('/mac/i',$OS)) {
         $OS = 'MAC';
        }elseif (preg_match('/linux/i',$OS)) {
         $OS = 'Linux';
        }elseif (preg_match('/unix/i',$OS)) {
         $OS = 'Unix';
        }elseif (preg_match('/bsd/i',$OS)) {
         $OS = 'BSD';
        }else {
         $OS = 'Other';
        }
        return $OS;  
       }else{return "获取访客操作系统信息失败！";}   
      }
      
      ////获得访客真实ip
      function Getip(){
       if(!empty($_SERVER["HTTP_CLIENT_IP"])){   
          $ip = $_SERVER["HTTP_CLIENT_IP"];
       }
       if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){ //获取代理ip
        $ips = explode(',',$_SERVER['HTTP_X_FORWARDED_FOR']);
       }
       if($ip){
          $ips = array_unshift($ips,$ip); 
       }
       
       $count = count($ips);
       for($i=0;$i<$count;$i++){   
         if(!preg_match("/^(10|172\.16|192\.168)\./i",$ips[$i])){//排除局域网ip
          $ip = $ips[$i];
          break;    
          }  
       }  
    	
    	return empty($_SERVER['REMOTE_ADDR']) ? $ip : $_SERVER['REMOTE_ADDR']; 
      }
}

$gifo = new get_gust_info();
echo "<br/>浏览器类型：".$gifo->GetBrowser();
echo "<br/>浏览器语言：".$gifo->GetLang();
echo "<br/>操作系统：".$gifo->GetOs();
?>