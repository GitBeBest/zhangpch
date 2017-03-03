<xml>
    <ToUserName><![CDATA[{{ $message->FromUserName }}]]></ToUserName>
    <FromUserName><![CDATA[{{ $message->ToUserName }}]]></FromUserName>
    <CreateTime>{{ time() }}</CreateTime>
    <MsgType><![CDATA[music]]></MsgType>
    <Music>
        <Title><![CDATA[{{ $message->title }}]]></Title>
        <Description><![CDATA[{{ $message->description }}]]></Description>
        <MusicUrl><![CDATA[{{ $message->music_url }}]]></MusicUrl>
        <HQMusicUrl><![CDATA[{{ $message->hq_music_url }}]]></HQMusicUrl>
        <ThumbMediaId><![CDATA[{{ $message->media_id }}]]></ThumbMediaId>
    </Music>
</xml>