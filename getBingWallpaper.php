<?php
	    $day = $_GET["day"];    //通过day参数获取调用时间
	    $url = 'http://cn.bing.com/HPImageArchive.aspx?idx='.$day.'&n=1';
	    $str=file_get_contents($url);

    	if(preg_match("/<url>(.+?)<\/url>/ies",$str,$matches)){ //正则获取url
    	   // var_dump($matches);exit;
    		$imgurl='http://cn.bing.com'.$matches[1];
    	}
    	
    	if($imgurl){                                           //替换图片url中的图片大小参数
    	    $imgurl= preg_replace('#1920#','768',$imgurl);
    	    $imgurl= preg_replace('#1080#','1280',$imgurl);
    		header('Content-Type: image/JPEG');
    		@ob_end_clean();
    		@readfile($imgurl);
    		@flush(); @ob_flush();
    		exit();
    	}else{
    		exit('error');
    	}
?>