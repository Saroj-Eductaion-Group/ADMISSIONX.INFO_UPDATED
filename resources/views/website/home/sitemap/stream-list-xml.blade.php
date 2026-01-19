<urlset 
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
    xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" 
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd" 
    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    {{--*/
    $lastmodDate= date('c');
    /*--}}
    @foreach ($functionalareaList as $post)
        {{--*/
            $TimeStr= date('Y-m-d\TH:i:s');
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        <url>
            <loc>https://www.admissionx.com/stream/{{ $post->pageslug }}/degree</loc>
            <lastmod>{{ $endDateFromFormDate }}</lastmod>
            <priority>0.80</priority>
        </url>
    @endforeach
</urlset>