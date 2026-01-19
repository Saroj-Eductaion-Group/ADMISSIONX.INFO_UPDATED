<urlset 
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
    xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" 
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd" 
    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    {{--*/
    $lastmodDate= date('c');
    /*--}}
    @foreach ($getNewsObj as $news)
        {{--*/
            $TimeStr= date('Y-m-d\TH:i:s', strtotime($news->createdDate));
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        
        <url>
            <loc>https://www.admissionx.com/news/{{strtolower($news->slug)}}</loc>
            <lastmod>{{ $endDateFromFormDate }}</lastmod>
            <priority>0.80</priority>
        </url>
    @endforeach

    @foreach ($getCategoryNewsObj as $categoryNews)
        {{--*/
            $TimeStr= date('Y-m-d\TH:i:s', strtotime($categoryNews->updated_at));
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        <url>
            <loc>https://www.admissionx.com/news/categories/{{ $categoryNews->slug }}</loc>
            <lastmod>{{ $endDateFromFormDate }}</lastmod>
            <priority>0.80</priority>
        </url>
    @endforeach

    @foreach ($getAllTagNewsObj as $tagNews)
        {{--*/
            $TimeStr= date('Y-m-d\TH:i:s', strtotime($tagNews->updated_at));
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        <url>
            <loc>https://www.admissionx.com/news/tags/{{ $tagNews->slug }}</loc>
            <lastmod>{{ $endDateFromFormDate }}</lastmod>
            <priority>0.80</priority>
        </url>
    @endforeach
</urlset>