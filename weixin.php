<?php

define("TOKEN", "ydssnjtv");
$wechatObj = new wechatCallbackapiTest();
$wechatObj->responseMsg();
$wechatObj->valid(); 

class wechatCallbackapiTest
{
    public function valid()
    {
        $echoStr = $_GET["echostr"];
        //valid signature , option
        if($this->checkSignature()){
            ob_clean();
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
                    case "text": $resultStr = $this->handleText($postObj);
                        break;
                    case "event": $resultStr = $this->handleEvent($postObj);
                        break;
                    default: $resultStr = "Unknow msg type: ".$RX_TYPE;
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
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $keyword = trim($postObj->Content);
        $time = time();
		
		  if($keyword == "1")
			{
				$textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
						<ArticleCount>1</ArticleCount>
						<Articles>
						<item>
						<Title><![CDATA[排班表]]></Title>
						<Description><![CDATA[请点击图片]]></Description>
						<PicUrl><![CDATA[http://ydssnjtv.carp.mopaasapp.com/images/banbiao.jpg]]></PicUrl>
						<Url><![CDATA[http://ydssnjtv.carp.mopaasapp.com/banbiao.html]]></Url>
						</item>
						</Articles>
                        <FuncFlag>0</FuncFlag>
                        </xml>";
				$msgType = "news";
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType);
                echo $resultStr;
				exit;
			}
			//如果对方输入“1”则返回班表页面；
			
			
			if($keyword == "2")
			{
				$textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
						<ArticleCount>1</ArticleCount>
						<Articles>
						<item>
						<Title><![CDATA[新版日历]]></Title>
						<Description><![CDATA[请点击图片]]></Description>
						<PicUrl><![CDATA[http://ydssnjtv.carp.mopaasapp.com/images/mengmeng_new.jpg]]></PicUrl>
						<Url><![CDATA[http://ydssnjtv.carp.mopaasapp.com/mengmeng_new.html]]></Url>
						</item>
						</Articles>
                        <FuncFlag>0</FuncFlag>
                        </xml>";
				$msgType = "news";
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType);
                echo $resultStr;
				exit;
			}
			//如果对方输入“2”则返回日历页面；
			
			if($keyword <> null)
            {
                $textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                        <FuncFlag>0</FuncFlag>
                        </xml>";
				$msgType = "text";
                $contentStr = "输入“1”--查询班表"."\n"."输入“2”--显示日历";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
				exit;
            }
			//如果对方输入其他文本则返回日历页面；	
        }

    public function handleEvent($postobj)
    {
        $contentStr = "";
        switch ($postobj->Event)
        {
            case "subscribe": $contentStr = "感谢您关注Ydss的微信号"."\n"."目前平台功能如下："."\n"."【1】 查班表和值班量"."\n"."【2】 日历"."\n"."【3】 更多内容，敬请期待...";
                break;
			default : $contentStr = "Unknow Event: ".$postobj->Event;
                break;
        }
        $resultStr = $this->responseText($postobj, $contentStr);
        return $resultStr;
    }
    
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


    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];    
                
        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
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