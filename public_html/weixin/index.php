<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "Allen");
$wechatObj = new wechatCallbackapiTest();
//$wechatObj->responseMsg();
$wechatObj->valid();

class wechatCallbackapiTest
{

	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }

   

    public function responseMsg()
    {
	
        //get post data, May be due to the different environments
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

          //extract post data
        if (!empty($postStr)){
                
                  $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $RX_TYPE = trim($postObj->MsgType);

                switch($RX_TYPE)
                {
                    case "text":
                        $resultStr = $this->handleText($postObj);
                        break;
                    case "event":
                        $resultStr = $this->handleEvent($postObj);
                        break;
                    default:
                        $resultStr = "Unknow msg type: ".$RX_TYPE;
                        break;
                }
                echo $resultStr;
        }else {
            echo "";
            exit;
        }
    }

    public function handleText($postObj)
    {
	
	    include("allResponse.php");
	    $allResponse = new allResponse();
  
        $keyword = trim($postObj->Content);
                 
       if(!empty( $keyword ))
        {
            $msgType = "news";

            $str = mb_substr($keyword,-2,2,"UTF-8");
            $str_key = mb_substr($keyword,0,-2,"UTF-8");
			////有道翻译格式
			 $fanyi = mb_substr($keyword,0,2,"UTF-8");
			 $fanyiWord = mb_substr($keyword,2,mb_strlen($keyword,'UTF-8'),"UTF-8");
			 
			 if ($keyword=='1'){
			  $contentStr = "回复【城市+天气】，如【上海天气】，查询指定城市天气！";
			  $resultStr =  $allResponse->responseText($postObj,$contentStr);
			 }
			 else if ($keyword=='2'){
			  $contentStr = "回复【笑话】，即可查看随机笑话！";
			  $resultStr =  $allResponse->responseText($postObj,$contentStr);
			 }
			  else if ($keyword=='3'){
			  $contentStr = "回复【翻译+内容】，如【翻译i love you】！";
			  $resultStr =  $allResponse->responseText($postObj,$contentStr);
			 }
			  else if ($keyword=='4'){
			  $contentStr = "回复【快递】，即可进行快递查询！";
			  $resultStr =  $allResponse->responseText($postObj,$contentStr);
			 }
			  else if ($keyword=='5'){
			  $contentStr = "回复【火车】，即可进行火车票查询！";
			  $resultStr =  $allResponse->responseText($postObj,$contentStr);
			  }
			  else if ($keyword=='6'){
			  $contentStr = "回复【今天】，即可查看历史上的今天！";
			  $resultStr =  $allResponse->responseText($postObj,$contentStr);
			 }
			 else if ($keyword=='0'){
			 $resultStr = $allResponse->responseNews($postObj);
			 }
			////////查询天气预报
            else if($str == '天气' &&!empty($str_key)){
			include("getWeather.php");
	        $myWeather = new myWeather();
                $data = $myWeather->weather($str_key);
				if(empty($data->results)){
                    $contentStr = "抱歉，没有查到\"".$str_key."\"的天气信息！";
					$resultStr =  $allResponse->responseText($postObj,$contentStr);
                } else
				{
				   $resultStr =  $myWeather->responseWeather($postObj,$data); 
             } 
			 }
			 else if($str == '笑话'){
			  $url = "http://apix.sinaapp.com/joke/?appkey=trialuser";
			  //$url = "http://api100.duapp.com/joke/?appkey=trialuser";
             $output = file_get_contents($url);
               $contentStr = json_decode($output, true);
			  // $contentStr = "http://api100.duapp.com/joke/?appkey=trialuser";
			  $resultStr =  $allResponse->responseText($postObj,$contentStr);
			 }
			 else if($fanyi =='翻译'&&!empty($fanyiWord)){
                 include("getyoudaoDic.php");
	             $youdao = new youdao();			 
			
			     $transStr = $youdao->youdaoDic($fanyiWord);
			     $resultStr =  $allResponse->responseText($postObj,$transStr);
			 		 
			 echo $resultStr;
			 }
			 else if($str =='火车'){
			 $resultStr = $allResponse->responseLink($postObj);
			 }
			 else if($str =='快递'){
			 $resultStr = $allResponse->responseLink($postObj);
			 }
			 else if($str =='今天'){

			 $todayURL = "http://liyagang.com/weixin/lssdjt.php";
			
			 $resultStr = $allResponse->responseLSSDJT($postObj,$todayURL);
			 }
			else {
			  $resultStr = $allResponse->responseNews($postObj);	
              
			}
           
            echo $resultStr;
        }else{
            echo "Input something...";
        }
    }
	



    public function handleEvent($object)
    {
        $contentStr = "";
        switch ($object->Event)
        {
            case "subscribe":
                $resultStr = $allResponse->responseNews($object);
                break;
            default :
                $contentStr = "Unknow Event: ".$object->Event;
                break;
        }
       
		
        return $resultStr;
    }
    
  

	private function checkSignature()
	{
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
   
	

}

?>