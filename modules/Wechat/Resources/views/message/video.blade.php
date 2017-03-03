<xml>
    <ToUserName><![CDATA[{{ $message->ToUserName }}]]></ToUserName>
    <FromUserName><![CDATA[{{ $message->FromUserName }}]]></FromUserName>
    <CreateTime>{{ time() }}</CreateTime>
    <MsgType><![CDATA[video]]></MsgType>
    <Video>
        <MediaId><![CDATA[{{ $message->media_id }}]]></MediaId>
        <Title><![CDATA[{{ $message->title }}]]></Title>
        <Description><![CDATA[{{ $message->description }}]]></Description>
    </Video>
</xml>