<?php
  class allResponse {
  
    public function responseText($object, $content, $flag=0)
    {
        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[text]]></MsgType>
                    <Content><![CDATA[%s]]></Content>
                    <FuncFlag>%d</FuncFlag>
                    </xml>";
        $resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content, $flag);
        return $resultStr;
    }
	//////////////////////////快递查询火车票查询
	 public function responseLink($postObj)
    {
       $picTpl = "
					<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[news]]></MsgType>
					<ArticleCount>3</ArticleCount>
					<Articles>
					<item>
					<Title><![CDATA[ 欢迎使用便捷查询功能]]></Title>
					<Description><![CDATA[]]></Description>
					<PicUrl><![CDATA[http://a0.att.hudong.com/65/77/300000927174128808773357983_950.jpg]]></PicUrl>
					<Url><![CDATA[$url]]></Url>
					</item>
					<item>
					<Title><![CDATA[  点击进行快递查询----->]]></Title>
					<Description><![CDATA[]]></Description>
					<PicUrl><![CDATA[http://cn.gcimg.net/gcproduct/day_20130315/649e8344a727cec40fa42904f45da776.jpg]]></PicUrl>
					<Url><![CDATA[http://m.kuaidi100.com/index_all.html?type=&postid=#inputl]]></Url>
					</item>
					<item>
					<Title><![CDATA[  点击进行火车票查询----->]]></Title>
					<Description><![CDATA[]]></Description>
					<PicUrl><![CDATA[http://www.taopic.com/uploads/allimg/120119/1942-12011ZZ25229.jpg]]></PicUrl>
					<Url><![CDATA[http://m.chepiao100.com/yupiao.html]]></Url>
					</item>
					</Articles>
					</xml> ";

          $resultStr = sprintf($picTpl,$postObj->FromUserName,$postObj->ToUserName,time());
          return $resultStr;
    }
	//////////////////历史上的今天
	 public function responseLSSDJT($postObj,$url)
    {
       $picTpl = "
					<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[news]]></MsgType>
					<ArticleCount>1</ArticleCount>
					<Articles>
					<item>
					<Title><![CDATA[]]></Title>
					<Description><![CDATA[点击查看历史上的今天]]></Description>
					<PicUrl><![CDATA[http://stuweb.zjhzyg.net/2006/_private/0801/080144/images/918_main_13.gif]]></PicUrl>
					<Url><![CDATA[$url]]></Url>
					</item>
					</Articles>
					</xml> ";

          $resultStr = sprintf($picTpl,$postObj->FromUserName,$postObj->ToUserName,time());
          return $resultStr;
    }
	
	//////////////////////关注以后返回和输入其他信息时候显示//////////////
	    public function responseNews($postObj)
    {
	$gongmeng = "【1】 查天气                        【2】  看笑话\n【3】 翻译                            【4】  快递查询\n【5】  火车票查询               【6】  历史上的今天\n\n请输入【】内的功能号进行相关操作！";
       $picTpl = "
					<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[news]]></MsgType>
					<ArticleCount>3</ArticleCount>
					<Articles>
					<item>
					<Title><![CDATA[  欢迎使用【生活小助手】目前平台功能如下:]]></Title>
					<Description><![CDATA[这是描述]]></Description>
					<PicUrl><![CDATA[http://a.hiphotos.baidu.com/image/pic/item/95eef01f3a292df528de5462be315c6034a873ac.jpg]]></PicUrl>
					<Url><![CDATA[]]></Url>
					</item>
					<item>
					<Title><![CDATA[$gongmeng]]></Title>
					<Description><![CDATA[描述2]]></Description>
					<PicUrl><![CDATA[]]></PicUrl>
					<Url><![CDATA[]]></Url>
					</item>
					<item>
					<Title><![CDATA[更多精彩内容，敬请期待。。。]]></Title>
					<Description><![CDATA[]]></Description>
					<PicUrl><![CDATA[]]></PicUrl>
					<Url><![CDATA[]]></Url>
					</item>
					</Articles>
					</xml> ";

          $resultStr = sprintf($picTpl,$postObj->FromUserName,$postObj->ToUserName,time());
          return $resultStr;
    }
  
  
  }
?>