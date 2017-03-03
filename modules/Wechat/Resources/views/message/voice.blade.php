<xml>
    <ToUserName><![CDATA[{{ $message->ToUserName }}]]></ToUserName>
    <FromUserName><![CDATA[{{ $message->FromUserName }}]]></FromUserName>
    <CreateTime>{{ time() }}</CreateTime>
    <MsgType><![CDATA[voice]]></MsgType>
    <Voice>
        <MediaId><![CDATA[{{$message->media_id}}]]></MediaId>
    </Voice>
</xml>