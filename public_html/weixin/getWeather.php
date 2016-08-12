<?php
   class myWeather{
   
   
   
    public function weather($c_name){
        // include("weather_cityId.php");
        // $c_name=$weather_cityId[$n];
        if(!empty($c_name)){
		//http://m.weather.com.cn/atad/101230201.html国家气象局天气预报接口////不稳定，经常死掉
		//百度天气接口   http://api.map.baidu.com/telematics/v3/weather?location=%E5%AE%9D%E4%B8%B0&output=json&ak=RUD7mk38fQdG0ZjcLCyigc2u
            //$json=file_get_contents("http://m.weather.com.cn/atad/".$c_name.".html");
			$json=file_get_contents("http://api.map.baidu.com/telematics/v3/weather?location=".$c_name."&output=json&ak=RUD7mk38fQdG0ZjcLCyigc2u");
            return json_decode($json);
        } else {
            return null;
        }
    }
	 public function responseWeather($postObj,$data)
    {   
				  
				  $title = $data->results[0]->currentCity."天气预报"."    ".$data->date;
				  $day1 = $data->results[0]->weather_data[0]->date."\n".$data->results[0]->weather_data[0]->weather."    ".$data->results[0]->weather_data[0]->wind."    ".$data->results[0]->weather_data[0]->temperature;
				  $day2 = $data->results[0]->weather_data[1]->date."\n".$data->results[0]->weather_data[1]->weather."    ".$data->results[0]->weather_data[1]->wind."    ".$data->results[0]->weather_data[1]->temperature;
				  $day3 = $data->results[0]->weather_data[2]->date."\n".$data->results[0]->weather_data[2]->weather."    ".$data->results[0]->weather_data[2]->wind."    ".$data->results[0]->weather_data[2]->temperature;
				  $day4 = $data->results[0]->weather_data[3]->date."\n".$data->results[0]->weather_data[3]->weather."    ".$data->results[0]->weather_data[3]->wind."    ".$data->results[0]->weather_data[3]->temperature;
				  $url1 = $data->results[0]->weather_data[0]->dayPictureUrl;
				  $url2 = $data->results[0]->weather_data[1]->dayPictureUrl;
				  $url3 = $data->results[0]->weather_data[2]->dayPictureUrl;
				  $url4 = $data->results[0]->weather_data[3]->dayPictureUrl;
       $picTpl = "
					<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[news]]></MsgType>
					<ArticleCount>5</ArticleCount>
					<Articles>
					<item>
					<Title><![CDATA[  $title]]></Title>
					<Description><![CDATA[]]></Description>
					<PicUrl><![CDATA[]]></PicUrl>
					<Url><![CDATA[]]></Url>
					</item>
					<item>
					<Title><![CDATA[$day1]]></Title>
					<Description><![CDATA[描述2]]></Description>
					<PicUrl><![CDATA[$url1]]></PicUrl>
					<Url><![CDATA[]]></Url>
					</item>
					<item>
					<Title><![CDATA[$day2]]></Title>
					<Description><![CDATA[描述2]]></Description>
					<PicUrl><![CDATA[$url2]]></PicUrl>
					<Url><![CDATA[]]></Url>
					</item>
					<item>
					<Title><![CDATA[$day3]]></Title>
					<Description><![CDATA[描述3]]></Description>
					<PicUrl><![CDATA[$url3]]></PicUrl>
					<Url><![CDATA[]]></Url>
					</item>
					<item>
					<Title><![CDATA[$day4]]></Title>
					<Description><![CDATA[描述3]]></Description>
					<PicUrl><![CDATA[$url4]]></PicUrl>
					<Url><![CDATA[]]></Url>
					</Articles>
					</xml> ";

          $resultStr = sprintf($picTpl,$postObj->FromUserName,$postObj->ToUserName,time());
          return $resultStr;
    }
	   
	}
?>