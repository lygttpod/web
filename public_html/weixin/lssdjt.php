<html>
<head>
<meta  name="viewport"  content="width=device-width,minimum-scale=1,user-scalable=no,maximum-scale=1,initial-scale=1">
</head>
<body>
<?php
/**
* Created by PhpStorm.
 * User: spenly
 * Date: 14-8-22
 * Time: 下午3:06
 * 爬虫程序 -- 原型
 *
 * 从给定的url获取html内容
 *
 * @param string $url
 * @return string
 */
 
 
 function _getUrlContent($url) {
    $handle = fopen($url, "r");
    if ($handle) {
        $content = stream_get_contents($handle, 1024 * 1024);
        return $content;
    } else {
        return false;
    }
}

           $url="http://www.lssdjt.com/";
			$html=_getUrlContent($url);
			$dom = new DOMDocument();
			//从一个字符串加载HTML
			@$dom->loadHTML($html);
			//使该HTML规范化
			$dom->normalize();
			//用DOMXpath加载DOM，用于查询
			$xpath = new DOMXPath($dom);
			#获取head
			$obj_head=$xpath->query("//div[@class='box']/div[@class='hd']");
			echo $obj_head->item(0)->nodeValue,'<br>';
			#获取item
			$obj = $xpath->query("//div[@class='box']//li[@class='gong']");
			$json_array=array();
			for ($i = 0; $i < $obj->length; $i++) {
				$item = $obj->item($i);
				$strs=explode(' ',strval($item->nodeValue));
				echo  $strs[0],'<br>',$strs[1],'<br>';
			}
			
  
?>

</body>

</html>