<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
    <title>Blog của tôi</title>
    <link>{{ url('/') }}</link>
    <description>Các bài viết mới nhất từ blog cá nhân</description>
    <language>vi</language>
    <pubDate>{{ now()->toRssString() }}</pubDate>
    <lastBuildDate>{{ now()->toRssString() }}</lastBuildDate>
    <atom:link href="{{ url('/feed') }}" rel="self" type="application/rss+xml" />

    @foreach($posts as $post)
    <item>
        <title>{{ $post->title }}</title>
        <link>{{ route('post.detail', $post->slug) }}</link>
        <description><![CDATA[{{ Str::limit(strip_tags($post->body), 200) }}]]></description>
        <pubDate>{{ $post->published_at->toRssString() }}</pubDate>
        <lastBuildDate>{{ $post->updated_at->toRssString() }}</lastBuildDate>
        <author>{{ $post->user->email }}</author>
        <guid isPermaLink="false">tag:blog-cua-toi,{{ $post->published_at->format('Y-m-d') }}:post-{{ $post->id }}</guid>
    </item>
    @endforeach
</channel>
</rss>