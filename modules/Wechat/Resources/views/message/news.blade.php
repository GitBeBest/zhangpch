<xml>
    <ToUserName><![CDATA[{{ $message->FromUserName }}]]></ToUserName>
    <FromUserName><![CDATA[{{ $message->ToUserName }}]]></FromUserName>
    <CreateTime>{{ time() }}</CreateTime>
    <MsgType><![CDATA[news]]></MsgType>
    <ArticleCount>{{ $message->count }}</ArticleCount>
    <Articles>
        @foreach($message->list as $item)
            <item>
                <Title><![CDATA[{{ $item->title }}]]></Title>
                <Description><![CDATA[{{ $item->description }}]]></Description>
                <PicUrl><![CDATA[ {{ $item->picUrl }}]]></PicUrl>
                <Url><![CDATA[{{ $item->url }}]]></Url>
            </item>
        @endforeach
    </Articles>
</xml>