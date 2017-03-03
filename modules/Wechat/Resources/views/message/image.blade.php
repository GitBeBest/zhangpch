<xml>
    <ToUserName><![CDATA[{{ $message->FromUserName }}]]></ToUserName>
    <FromUserName><![CDATA[{{ $message->ToUserName }}]]></FromUserName>
    <CreateTime>{{ time() }}</CreateTime>
    <MsgType><![CDATA[image]]></MsgType>
    <Image>
        <MediaId><![CDATA[{{ $message->media_id }}]]></MediaId>
    </Image>
</xml>