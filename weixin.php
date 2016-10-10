<?php
define("TOKEN", "ydssnjtv");
$wechatObj = new wechatCallbackapiTest();

if (isset($_GET['echostr'])) {
    $wechatObj->valid();
}else{
    $wechatObj->responseMsg();
}
/*  来的消息含echostr字符串，就去valid函数进行身份验证，否则就用responsMsg函数进行消息回复 */

class wechatCallbackapiTest
{
    public function valid()
    {
        $echoStr = $_GET["echostr"];
        if($this->checkSignature()){
            header('content-type:text');
            echo $echoStr;
            exit;
        }
    }

    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }

    public function responseMsg()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        //接受用户端发送过来的xml数据
        if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = trim($postObj->Content);
            $time = time();
            //通过simplexml进行xml解析
	        
			$receive_msgtype = $postObj->MsgType;
			if ($receive_msgtype == "event")
			{
				$receive_event = $postobj->event;
				if ($receive_event == 'Subcribe')
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
                $contentStr = "欢迎订阅Ydss的公众号，由于微信取消了自定义菜单，请输入任意字符以获取文本操作菜单";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
				exit;
				}
			exit;
			}
		    //如果是新用户订阅消息，则返回欢迎和菜单消息
			
		
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
                $contentStr = "输入“1”--查询班表，输入“2”--显示日历";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
				exit;
            }
			//如果对方输入其他文本则返回日历页面；
        }
    }
}

?>