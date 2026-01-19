<urlset 
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
    xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" 
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd" 
    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    {{--*/
    $lastmodDate= date('c');
    /*--}}
    @foreach ($stateListObj as $post)
        {{--*/
            $TimeStr= date('Y-m-d\TH:i:s', strtotime($post->updated_at));
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        <url>
            <loc>https://www.admissionx.com/{{ $post->pageslug }}/{{ $post->countrySlug }}/college-list</loc>
            <lastmod>{{ $endDateFromFormDate }}</lastmod>
            <priority>1.00</priority>
        </url>
    @endforeach
</urlset>