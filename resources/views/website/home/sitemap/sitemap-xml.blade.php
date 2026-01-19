<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    {{--*/
    $lastmodDate= date('c');
    /*--}}
    <url>
      <loc>https://www.admissionx.com/</loc>
      <lastmod>{{$lastmodDate}}</lastmod>
      <priority>1.00</priority>
    </url>
    <url>
      <loc>https://www.admissionx.com/buy-machinery/</loc>
      <lastmod>{{$lastmodDate}}</lastmod>
      <priority>0.80</priority>
    </url>
    <url>
      <loc>https://www.admissionx.com/rent-machinery/</loc>
      <lastmod>{{$lastmodDate}}</lastmod>
      <priority>0.80</priority>
    </url>
    <url>
      <loc>https://www.admissionx.com/auction-machinery/</loc>
      <lastmod>{{$lastmodDate}}</lastmod>
      <priority>0.80</priority>
    </url>
    <url>
      <loc>https://www.admissionx.com/seller-listing/</loc>
      <lastmod>{{$lastmodDate}}</lastmod>
      <priority>0.80</priority>
    </url>
    <url>
      <loc>https://www.admissionx.com/dealer-listing/</loc>
      <lastmod>{{$lastmodDate}}</lastmod>
      <priority>0.80</priority>
    </url>
    <url>
      <loc>https://www.admissionx.com/news/</loc>
      <lastmod>{{$lastmodDate}}</lastmod>
      <priority>0.80</priority>
    </url>
    <url>
      <loc>https://www.admissionx.com/about-us/</loc>
      <lastmod>{{$lastmodDate}}</lastmod>
      <priority>0.80</priority>
    </url>
    <url>
      <loc>https://www.admissionx.com/exhibition-list/</loc>
      <lastmod>{{$lastmodDate}}</lastmod>
      <priority>0.80</priority>
    </url>
    <url>
      <loc>https://www.admissionx.com/auction-list/</loc>
      <lastmod>{{$lastmodDate}}</lastmod>
      <priority>0.80</priority>
    </url>
    <url>
      <loc>https://www.admissionx.com/all-category-list/</loc>
      <lastmod>{{$lastmodDate}}</lastmod>
      <priority>0.80</priority>
    </url>
    <url>
      <loc>https://www.admissionx.com/seller-register/</loc>
      <lastmod>{{$lastmodDate}}</lastmod>
      <priority>0.80</priority>
    </url>
    <url>
      <loc>https://www.admissionx.com/dealer-register/</loc>
      <lastmod>{{$lastmodDate}}</lastmod>
      <priority>0.80</priority>
    </url>
    <url>
      <loc>https://www.admissionx.com/trader-register/</loc>
      <lastmod>{{$lastmodDate}}</lastmod>
      <priority>0.80</priority>
    </url>
    <url>
      <loc>https://www.admissionx.com/buyer-register/</loc>
      <lastmod>{{$lastmodDate}}</lastmod>
      <priority>0.80</priority>
    </url>
    <url>
      <loc>https://www.admissionx.com/user-register/</loc>
      <lastmod>{{$lastmodDate}}</lastmod>
      <priority>0.80</priority>
    </url>
    
    <url>
      <loc>https://www.admissionx.com/search/</loc>
      <lastmod>{{$lastmodDate}}</lastmod>
      <priority>0.80</priority>
    </url>

    <url>
      <loc>https://www.admissionx.com/contact-us/</loc>
      <lastmod>{{$lastmodDate}}</lastmod>
      <priority>0.80</priority>
    </url>
    <url>
      <loc>https://www.admissionx.com/privacy-policy/</loc>
      <lastmod>{{$lastmodDate}}</lastmod>
      <priority>0.80</priority>
    </url>
    <url>
      <loc>https://www.admissionx.com/policies/</loc>
      <lastmod>{{$lastmodDate}}</lastmod>
      <priority>0.80</priority>
    </url>
    <url>
      <loc>https://www.admissionx.com/terms-of-use/</loc>
      <lastmod>{{$lastmodDate}}</lastmod>
      <priority>0.80</priority>
    </url>
    <url>
      <loc>https://www.admissionx.com/terms-and-conditions/</loc>
      <lastmod>{{$lastmodDate}}</lastmod>
      <priority>0.80</priority>
    </url>
    <url>
      <loc>https://www.admissionx.com/sitemap/</loc>
      <lastmod>{{$lastmodDate}}</lastmod>
      <priority>0.80</priority>
    </url>
    <url>
      <loc>https://www.admissionx.com/404/</loc>
      <lastmod>{{$lastmodDate}}</lastmod>
      <priority>0.80</priority>
    </url>
    <url>
      <loc>https://www.admissionx.com/register/</loc>
      <lastmod>{{$lastmodDate}}</lastmod>
      <priority>0.80</priority>
    </url>
    <url>
      <loc>https://www.admissionx.com/login/</loc>
      <lastmod>{{$lastmodDate}}</lastmod>
      <priority>0.64</priority>
    </url>

    @foreach ($exhibitionList as $post)
        {{--*/
            $TimeStr= date('Y-m-d\TH:i:s', strtotime($post->updated_at));
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        <url>
            <loc>https://www.admissionx.com/exhibition-details/{{ $post->exhibitionSlug }}/</loc>
            <lastmod>{{ $endDateFromFormDate }}</lastmod>
            <priority>0.80</priority>
        </url>
    @endforeach

    @foreach ($auctionList as $post)
        {{--*/
            $TimeStr= date('Y-m-d\TH:i:s', strtotime($post->updated_at));
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        <url>
            <loc>https://www.admissionx.com/auction-details/{{ $post->auctionSlug }}/</loc>
            <lastmod>{{ $endDateFromFormDate }}</lastmod>
            <priority>0.80</priority>
        </url>
    @endforeach


    @foreach ($classForSale as $post)
        {{--*/
            $classCount = ceil($post->classCount/21);
            $TimeStr= date('Y-m-d\TH:i:s', strtotime($post->updated_at));
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        @if($classCount > 0)
            @for( $count = 0; $count <= $classCount; $count++)
                @if( $count > 0)
                    <url>
                        <loc>https://www.admissionx.com/{{ $post->classesSlug }}-for-sale{!! ($count > 1)? '?page='.$count.'' : '' !!}/</loc>
                        <lastmod>{{ $endDateFromFormDate }}</lastmod>
                        <priority>0.80</priority>
                    </url>
                @endif
            @endfor
        @else
            <url>
                <loc>https://www.admissionx.com/{{ $post->classesSlug }}-for-sale/</loc>
                <lastmod>{{ $endDateFromFormDate }}</lastmod>
                <priority>0.80</priority>
            </url>
        @endif
    @endforeach

    @foreach ($classForRent as $post)
        {{--*/
            $classCount = ceil($post->classCount/21);
            $TimeStr= date('Y-m-d\TH:i:s', strtotime($post->updated_at));
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        @if($classCount > 0)
            @for( $count = 0; $count <= $classCount; $count++)
                @if( $count > 0)
                    <url>
                        <loc>https://www.admissionx.com/{{ $post->classesSlug }}-for-rent{!! ($count > 1)? '?page='.$count.'' : '' !!}/</loc>
                        <lastmod>{{ $endDateFromFormDate }}</lastmod>
                        <priority>0.80</priority>
                    </url>
                @endif
            @endfor
        @else
            <url>
                <loc>https://www.admissionx.com/{{ $post->classesSlug }}-for-rent/</loc>
                <lastmod>{{ $endDateFromFormDate }}</lastmod>
                <priority>0.80</priority>
            </url>
        @endif
    @endforeach

    @foreach ($classForAuction as $post)
        {{--*/
            $classCount = ceil($post->classCount/21);
            $TimeStr= date('Y-m-d\TH:i:s', strtotime($post->updated_at));
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        @if($classCount > 0)
            @for( $count = 0; $count <= $classCount; $count++)
                @if( $count > 0)
                    <url>
                        <loc>https://www.admissionx.com/{{ $post->classesSlug }}-for-auction{!! ($count > 1)? '?page='.$count.'' : '' !!}/</loc>
                        <lastmod>{{ $endDateFromFormDate }}</lastmod>
                        <priority>0.80</priority>
                    </url>
                @endif
            @endfor
        @else
            <url>
                <loc>https://www.admissionx.com/{{ $post->classesSlug }}-for-auction/</loc>
                <lastmod>{{ $endDateFromFormDate }}</lastmod>
                <priority>0.80</priority>
            </url>
        @endif
    @endforeach


    @foreach ($categoriesForSale as $post)
        {{--*/
            $categoryCount = ceil($post->categoryCount/21);
            $TimeStr= date('Y-m-d\TH:i:s', strtotime($post->updated_at));
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        @if($categoryCount > 0)
            @for( $count = 0; $count <= $categoryCount; $count++)
                @if( $count > 0)
                    <url>
                        <loc>https://www.admissionx.com/{{ $post->categoriesSlug }}-for-sale{!! ($count > 1)? '?page='.$count.'' : '' !!}/</loc>
                        <lastmod>{{ $endDateFromFormDate }}</lastmod>
                        <priority>0.80</priority>
                    </url>
                @endif
            @endfor
        @else
            <url>
                <loc>https://www.admissionx.com/{{ $post->categoriesSlug }}-for-sale/</loc>
                <lastmod>{{ $endDateFromFormDate }}</lastmod>
                <priority>0.80</priority>
            </url>
        @endif
    @endforeach

    @foreach ($categoriesForRent as $post)
        {{--*/
            $categoryCount = ceil($post->categoryCount/21);
            $TimeStr= date('Y-m-d\TH:i:s', strtotime($post->updated_at));
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        @if($categoryCount > 0)
            @for( $count = 0; $count <= $categoryCount; $count++)
                @if( $count > 0)
                    <url>
                        <loc>https://www.admissionx.com/{{ $post->categoriesSlug }}-for-rent{!! ($count > 1)? '?page='.$count.'' : '' !!}/</loc>
                        <lastmod>{{ $endDateFromFormDate }}</lastmod>
                        <priority>0.80</priority>
                    </url>
                @endif
            @endfor
        @else
            <url>
                <loc>https://www.admissionx.com/{{ $post->categoriesSlug }}-for-rent/</loc>
                <lastmod>{{ $endDateFromFormDate }}</lastmod>
                <priority>0.80</priority>
            </url>
        @endif
    @endforeach

    @foreach ($categoriesForAuction as $post)
        {{--*/
            $categoryCount = ceil($post->categoryCount/21);
            $TimeStr= date('Y-m-d\TH:i:s', strtotime($post->updated_at));
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        @if($categoryCount > 0)
            @for( $count = 0; $count <= $categoryCount; $count++)
                @if( $count > 0)
                    <url>
                        <loc>https://www.admissionx.com/{{ $post->categoriesSlug }}-for-auction{!! ($count > 1)? '?page='.$count.'' : '' !!}/</loc>
                        <lastmod>{{ $endDateFromFormDate }}</lastmod>
                        <priority>0.80</priority>
                    </url>
                @endif
            @endfor
        @else
            <url>
                <loc>https://www.admissionx.com/{{ $post->categoriesSlug }}-for-auction/</loc>
                <lastmod>{{ $endDateFromFormDate }}</lastmod>
                <priority>0.80</priority>
            </url>
        @endif
    @endforeach


    @foreach ($childCategoryForSale as $post)
        {{--*/
            $childCategoryCount = ceil($post->childCategoryCount/21);
            $TimeStr= date('Y-m-d\TH:i:s', strtotime($post->updated_at));
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        @if($childCategoryCount > 0)
            @for( $count = 0; $count <= $childCategoryCount; $count++)
                @if( $count > 0)
                    <url>
                        <loc>https://www.admissionx.com/{{ $post->child_categoriesSlug }}-for-sale{!! ($count > 1)? '?page='.$count.'' : '' !!}/</loc>
                        <lastmod>{{ $endDateFromFormDate }}</lastmod>
                        <priority>0.80</priority>
                    </url>
                @endif
            @endfor
        @else
            <url>
                <loc>https://www.admissionx.com/{{ $post->child_categoriesSlug }}-for-sale/</loc>
                <lastmod>{{ $endDateFromFormDate }}</lastmod>
                <priority>0.80</priority>
            </url>
        @endif
    @endforeach

    @foreach ($childCategoryForRent as $post)
        {{--*/
            $childCategoryCount = ceil($post->childCategoryCount/21);
            $TimeStr= date('Y-m-d\TH:i:s', strtotime($post->updated_at));
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        @if($childCategoryCount > 0)
            @for( $count = 0; $count <= $childCategoryCount; $count++)
                @if( $count > 0)
                    <url>
                        <loc>https://www.admissionx.com/{{ $post->child_categoriesSlug }}-for-rent{!! ($count > 1)? '?page='.$count.'' : '' !!}/</loc>
                        <lastmod>{{ $endDateFromFormDate }}</lastmod>
                        <priority>0.80</priority>
                    </url>
                @endif
            @endfor
        @else
            <url>
                <loc>https://www.admissionx.com/{{ $post->child_categoriesSlug }}-for-rent/</loc>
                <lastmod>{{ $endDateFromFormDate }}</lastmod>
                <priority>0.80</priority>
            </url>
        @endif
    @endforeach

    @foreach ($childCategoryForAuction as $post)
        {{--*/
            $childCategoryCount = ceil($post->childCategoryCount/21);
            $TimeStr= date('Y-m-d\TH:i:s', strtotime($post->updated_at));
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        @if($childCategoryCount > 0)
            @for( $count = 0; $count <= $childCategoryCount; $count++)
                @if( $count > 0)
                    <url>
                        <loc>https://www.admissionx.com/{{ $post->child_categoriesSlug }}-for-auction{!! ($count > 1)? '?page='.$count.'' : '' !!}/</loc>
                        <lastmod>{{ $endDateFromFormDate }}</lastmod>
                        <priority>0.80</priority>
                    </url>
                @endif
            @endfor
        @else
            <url>
                <loc>https://www.admissionx.com/{{ $post->child_categoriesSlug }}-for-auction/</loc>
                <lastmod>{{ $endDateFromFormDate }}</lastmod>
                <priority>0.80</priority>
            </url>
        @endif
    @endforeach

    @foreach ($makesForSale as $post)
        {{--*/
            $makeCount = ceil($post->makeCount/21);
            $TimeStr= date('Y-m-d\TH:i:s', strtotime($post->updated_at));
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        @if($makeCount > 0)
            @for( $count = 0; $count <= $makeCount; $count++)
                @if( $count > 0)
                    <url>
                        <loc>https://www.admissionx.com/{{ $post->makesSlug }}-for-sale{!! ($count > 1)? '?page='.$count.'' : '' !!}/</loc>
                        <lastmod>{{ $endDateFromFormDate }}</lastmod>
                        <priority>0.80</priority>
                    </url>
                @endif
            @endfor
        @else
            <url>
                <loc>https://www.admissionx.com/{{ $post->makesSlug }}-for-sale/</loc>
                <lastmod>{{ $endDateFromFormDate }}</lastmod>
                <priority>0.80</priority>
            </url>
        @endif
    @endforeach

    @foreach ($makesForRent as $post)
        {{--*/
            $makeCount = ceil($post->makeCount/21);
            $TimeStr= date('Y-m-d\TH:i:s', strtotime($post->updated_at));
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        @if($makeCount > 0)
            @for( $count = 0; $count <= $makeCount; $count++)
                @if( $count > 0)
                    <url>
                        <loc>https://www.admissionx.com/{{ $post->makesSlug }}-for-rent{!! ($count > 1)? '?page='.$count.'' : '' !!}/</loc>
                        <lastmod>{{ $endDateFromFormDate }}</lastmod>
                        <priority>0.80</priority>
                    </url>
                @endif
            @endfor
        @else
            <url>
                <loc>https://www.admissionx.com/{{ $post->makesSlug }}-for-rent/</loc>
                <lastmod>{{ $endDateFromFormDate }}</lastmod>
                <priority>0.80</priority>
            </url>
        @endif
    @endforeach

    @foreach ($makesForAuction as $post)
        {{--*/
            $makeCount = ceil($post->makeCount/21);
            $TimeStr= date('Y-m-d\TH:i:s', strtotime($post->updated_at));
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        @if($makeCount > 0)
            @for( $count = 0; $count <= $makeCount; $count++)
                @if( $count > 0)
                    <url>
                        <loc>https://www.admissionx.com/{{ $post->makesSlug }}-for-auction{!! ($count > 1)? '?page='.$count.'' : '' !!}/</loc>
                        <lastmod>{{ $endDateFromFormDate }}</lastmod>
                        <priority>0.80</priority>
                    </url>
                @endif
            @endfor
        @else
            <url>
                <loc>https://www.admissionx.com/{{ $post->makesSlug }}-for-auction/</loc>
                <lastmod>{{ $endDateFromFormDate }}</lastmod>
                <priority>0.80</priority>
            </url>
        @endif
    @endforeach

    @foreach ($modelForSale as $post)
        {{--*/
            $modelCount = ceil($post->modelCount/21);
            $TimeStr= date('Y-m-d\TH:i:s', strtotime($post->updated_at));
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        @if($modelCount > 0)
            @for( $count = 0; $count <= $modelCount; $count++)
                @if( $count > 0)
                    <url>
                        <loc>https://www.admissionx.com/{{ $post->make_modelsSlug }}-for-sale{!! ($count > 1)? '?page='.$count.'' : '' !!}/</loc>
                        <lastmod>{{ $endDateFromFormDate }}</lastmod>
                        <priority>0.80</priority>
                    </url>
                @endif
            @endfor
        @else
            <url>
                <loc>https://www.admissionx.com/{{ $post->make_modelsSlug }}-for-sale/</loc>
                <lastmod>{{ $endDateFromFormDate }}</lastmod>
                <priority>0.80</priority>
            </url>
        @endif
    @endforeach

    @foreach ($modelForRent as $post)
        {{--*/
            $modelCount = ceil($post->modelCount/21);
            $TimeStr= date('Y-m-d\TH:i:s', strtotime($post->updated_at));
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        @if($modelCount > 0)
            @for( $count = 0; $count <= $modelCount; $count++)
                @if( $count > 0)
                    <url>
                        <loc>https://www.admissionx.com/{{ $post->make_modelsSlug }}-for-rent{!! ($count > 1)? '?page='.$count.'' : '' !!}/</loc>
                        <lastmod>{{ $endDateFromFormDate }}</lastmod>
                        <priority>0.80</priority>
                    </url>
                @endif
            @endfor
        @else
            <url>
                <loc>https://www.admissionx.com/{{ $post->make_modelsSlug }}-for-rent/</loc>
                <lastmod>{{ $endDateFromFormDate }}</lastmod>
                <priority>0.80</priority>
            </url>
        @endif
    @endforeach

    @foreach ($modelForAuction as $post)
        {{--*/
            $modelCount = ceil($post->modelCount/21);
            $TimeStr= date('Y-m-d\TH:i:s', strtotime($post->updated_at));
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        @if($modelCount > 0)
            @for( $count = 0; $count <= $modelCount; $count++)
                @if( $count > 0)
                    <url>
                        <loc>https://www.admissionx.com/{{ $post->make_modelsSlug }}-for-auction{!! ($count > 1)? '?page='.$count.'' : '' !!}/</loc>
                        <lastmod>{{ $endDateFromFormDate }}</lastmod>
                        <priority>0.80</priority>
                    </url>
                @endif
            @endfor
        @else
            <url>
                <loc>https://www.admissionx.com/{{ $post->make_modelsSlug }}-for-auction/</loc>
                <lastmod>{{ $endDateFromFormDate }}</lastmod>
                <priority>0.80</priority>
            </url>
        @endif
    @endforeach

    @foreach ($subModelForSale as $post)
        {{--*/
            $subModelCount = ceil($post->subModelCount/21);
            $TimeStr= date('Y-m-d\TH:i:s', strtotime($post->updated_at));
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        @if($subModelCount > 0)
            @for( $count = 0; $count <= $subModelCount; $count++)
                @if( $count > 0)
                    <url>
                        <loc>https://www.admissionx.com/{{ $post->make_sub_modelsSlug }}-for-sale{!! ($count > 1)? '?page='.$count.'' : '' !!}/</loc>
                        <lastmod>{{ $endDateFromFormDate }}</lastmod>
                        <priority>0.80</priority>
                    </url>
                @endif
            @endfor
        @else
            <url>
                <loc>https://www.admissionx.com/{{ $post->make_sub_modelsSlug }}-for-sale/</loc>
                <lastmod>{{ $endDateFromFormDate }}</lastmod>
                <priority>0.80</priority>
            </url>
        @endif
    @endforeach

    @foreach ($subModelForRent as $post)
        {{--*/
            $subModelCount = ceil($post->subModelCount/21);
            $TimeStr= date('Y-m-d\TH:i:s', strtotime($post->updated_at));
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        @if($subModelCount > 0)
            @for( $count = 0; $count <= $subModelCount; $count++)
                @if( $count > 0)
                    <url>
                        <loc>https://www.admissionx.com/{{ $post->make_sub_modelsSlug }}-for-rent{!! ($count > 1)? '?page='.$count.'' : '' !!}/</loc>
                        <lastmod>{{ $endDateFromFormDate }}</lastmod>
                        <priority>0.80</priority>
                    </url>
                @endif
            @endfor
        @else
            <url>
                <loc>https://www.admissionx.com/{{ $post->make_sub_modelsSlug }}-for-rent/</loc>
                <lastmod>{{ $endDateFromFormDate }}</lastmod>
                <priority>0.80</priority>
            </url>
        @endif
    @endforeach

    @foreach ($subModelForAuction as $post)
        {{--*/
            $subModelCount = ceil($post->subModelCount/21);
            $TimeStr= date('Y-m-d\TH:i:s', strtotime($post->updated_at));
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        @if($subModelCount > 0)
            @for( $count = 0; $count <= $subModelCount; $count++)
                @if( $count > 0)
                    <url>
                        <loc>https://www.admissionx.com/{{ $post->make_sub_modelsSlug }}-for-auction{!! ($count > 1)? '?page='.$count.'' : '' !!}/</loc>
                        <lastmod>{{ $endDateFromFormDate }}</lastmod>
                        <priority>0.80</priority>
                    </url>
                @endif
            @endfor
        @else
            <url>
                <loc>https://www.admissionx.com/{{ $post->make_sub_modelsSlug }}-for-auction/</loc>
                <lastmod>{{ $endDateFromFormDate }}</lastmod>
                <priority>0.80</priority>
            </url>
        @endif
    @endforeach

    @foreach ($countryForSale as $post)
        {{--*/
            $countryCount = ceil($post->countryCount/21);
            $TimeStr= date('Y-m-d\TH:i:s', strtotime($post->updated_at));
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        @if($countryCount > 0)
            @for( $count = 0; $count <= $countryCount; $count++)
                @if( $count > 0)
                    <url>
                        <loc>https://www.admissionx.com/{{ $post->countrySlug }}-for-sale{!! ($count > 1)? '?page='.$count.'' : '' !!}/</loc>
                        <lastmod>{{ $endDateFromFormDate }}</lastmod>
                        <priority>0.80</priority>
                    </url>
                @endif
            @endfor
        @else
            <url>
                <loc>https://www.admissionx.com/{{ $post->countrySlug }}-for-sale/</loc>
                <lastmod>{{ $endDateFromFormDate }}</lastmod>
                <priority>0.80</priority>
            </url>
        @endif
    @endforeach

    @foreach ($countryForRent as $post)
        {{--*/
            $countryCount = ceil($post->countryCount/21);
            $TimeStr= date('Y-m-d\TH:i:s', strtotime($post->updated_at));
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        @if($countryCount > 0)
            @for( $count = 0; $count <= $countryCount; $count++)
                @if( $count > 0)
                    <url>
                        <loc>https://www.admissionx.com/{{ $post->countrySlug }}-for-rent{!! ($count > 1)? '?page='.$count.'' : '' !!}/</loc>
                        <lastmod>{{ $endDateFromFormDate }}</lastmod>
                        <priority>0.80</priority>
                    </url>
                @endif
            @endfor
        @else
            <url>
                <loc>https://www.admissionx.com/{{ $post->countrySlug }}-for-rent/</loc>
                <lastmod>{{ $endDateFromFormDate }}</lastmod>
                <priority>0.80</priority>
            </url>
        @endif
    @endforeach

    @foreach ($countryForAuction as $post)
        {{--*/
            $countryCount = ceil($post->countryCount/21);
            $TimeStr= date('Y-m-d\TH:i:s', strtotime($post->updated_at));
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        @if($countryCount > 0)
            @for( $count = 0; $count <= $countryCount; $count++)
                @if( $count > 0)
                    <url>
                        <loc>https://www.admissionx.com/{{ $post->countrySlug }}-for-auction{!! ($count > 1)? '?page='.$count.'' : '' !!}/</loc>
                        <lastmod>{{ $endDateFromFormDate }}</lastmod>
                        <priority>0.80</priority>
                    </url>
                @endif
            @endfor
        @else
            <url>
                <loc>https://www.admissionx.com/{{ $post->countrySlug }}-for-auction/</loc>
                <lastmod>{{ $endDateFromFormDate }}</lastmod>
                <priority>0.80</priority>
            </url>
        @endif
    @endforeach

    @foreach ($productObj as $product)
        {{--*/
            $TimeStr= date('Y-m-d\TH:i:s', strtotime($product->updated_at));
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        
        <url>
            <loc>https://www.admissionx.com/product/{{strtolower($product->child_categoriesSlug)}}/{{ strtolower($product->productSlugUrl) }}/</loc>
            <lastmod>{{ $endDateFromFormDate }}</lastmod>
            <priority>0.80</priority>
        </url>
    @endforeach

    @foreach ($getBlogsObj as $blog)
        {{--*/
            $TimeStr= date('Y-m-d\TH:i:s', strtotime($blog->createdDate));
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        
        <url>
            <loc>https://www.admissionx.com/blog/{{strtolower($blog->slug)}}/</loc>
            <lastmod>{{ $endDateFromFormDate }}</lastmod>
            <priority>0.80</priority>
        </url>
    @endforeach

    @foreach ($getCategoryBlogsObj as $categoryBlog)
        {{--*/
            $newstypeCount = ceil($categoryBlog->newstypeCount/10);
            $TimeStr= date('Y-m-d\TH:i:s', strtotime($categoryBlog->createdDate));
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        @if($newstypeCount > 0)
            @for( $count = 0; $count <= $newstypeCount; $count++)
                @if( $count > 0)
                    <url>
                        <loc>https://www.admissionx.com/news/categories/{{ $categoryBlog->newsslug }}{!! ($count > 1)? '?page='.$count.'' : '' !!}/</loc>
                        <lastmod>{{ $endDateFromFormDate }}</lastmod>
                        <priority>0.80</priority>
                    </url>
                @endif
            @endfor
        @else
            <url>
                <loc>https://www.admissionx.com/news/categories/{{ $categoryBlog->newsslug }}/</loc>
                <lastmod>{{ $endDateFromFormDate }}</lastmod>
                <priority>0.80</priority>
            </url>
        @endif
    @endforeach

    @foreach ($getAllTagBlogsObj as $tagBlog)
        {{--*/
            $allTagBlogCount = ceil($tagBlog->allTagBlogCount/10);
            $TimeStr= date('Y-m-d\TH:i:s', strtotime($tagBlog->updated_at));
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        @if($allTagBlogCount > 0)
            @for( $count = 0; $count <= $allTagBlogCount; $count++)
                @if( $count > 0)
                    <url>
                        <loc>https://www.admissionx.com/news/tags/{{ $tagBlog->slug }}{!! ($count > 1)? '?page='.$count.'' : '' !!}/</loc>
                        <lastmod>{{ $endDateFromFormDate }}</lastmod>
                        <priority>0.80</priority>
                    </url>
                @endif
            @endfor
        @else
            <url>
                <loc>https://www.admissionx.com/news/tags/{{ $tagBlog->slug }}/</loc>
                <lastmod>{{ $endDateFromFormDate }}</lastmod>
                <priority>0.80</priority>
            </url>
        @endif
    @endforeach

    @foreach ($getTraderProductObj as $traderProduct)
        {{--*/
            $allTraderProductCount = ceil($traderProduct->allTraderProductCount/20);
            $TimeStr= date('Y-m-d\TH:i:s');
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        @if($allTraderProductCount > 0)
            @for( $count = 0; $count <= $allTraderProductCount; $count++)
                @if( $count > 0)
                    <url>
                        <loc>https://www.admissionx.com/seller-profile/{{ $traderProduct->companySlug }}{!! ($count > 1)? '?page='.$count.'' : '' !!}/</loc>
                        <lastmod>{{ $endDateFromFormDate }}</lastmod>
                        <priority>0.80</priority>
                    </url>
                @endif
            @endfor
        @else
            <url>
                <loc>https://www.admissionx.com/seller-profile/{{ $traderProduct->companySlug }}/</loc>
                <lastmod>{{ $endDateFromFormDate }}</lastmod>
                <priority>0.80</priority>
            </url>
        @endif
    @endforeach

    @foreach ($getDealerProductObj as $dealerProduct)
        {{--*/
            $allDealerProductCount = ceil($dealerProduct->allDealerProductCount/20);
            $TimeStr= date('Y-m-d\TH:i:s');
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        @if($allDealerProductCount > 0)
            @for( $count = 0; $count <= $allDealerProductCount; $count++)
                @if( $count > 0)
                    <url>
                        <loc>https://www.admissionx.com/dealer-profile/{{ $dealerProduct->companySlug }}{!! ($count > 1)? '?page='.$count.'' : '' !!}/</loc>
                        <lastmod>{{ $endDateFromFormDate }}</lastmod>
                        <priority>0.80</priority>
                    </url>
                @endif
            @endfor
        @else
            <url>
                <loc>https://www.admissionx.com/dealer-profile/{{ $dealerProduct->companySlug }}/</loc>
                <lastmod>{{ $endDateFromFormDate }}</lastmod>
                <priority>0.80</priority>
            </url>
        @endif
    @endforeach

    

    @foreach ($searchProductObj as $packageProduct)
        {{--*/
            $productCount = ceil($packageProduct->productCount/18);
            $TimeStr= date('Y-m-d\TH:i:s');
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        @if($productCount > 0)
            @for( $count = 0; $count <= $productCount; $count++)
                @if( $count > 0)
                    <url>
                        <loc>https://www.admissionx.com/search?packages={{ $packageProduct->package_id }}{!! ($count > 1)? '&amp;page='.$count.'' : '' !!}/</loc>
                        <lastmod>{{ $endDateFromFormDate }}</lastmod>
                        <priority>0.80</priority>
                    </url>
                @endif
            @endfor
        @else
            <url>
                <loc>https://www.admissionx.com/search?packages={{$packageProduct->package_id}}/</loc>
                <lastmod>{{ $endDateFromFormDate }}</lastmod>
                <priority>0.80</priority>
            </url>
        @endif
    @endforeach


    @foreach ($buyRentProductObj as $buyrent)
        {{--*/
            $productCount = ceil($buyrent->productCount/18);
            $TimeStr= date('Y-m-d\TH:i:s');
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        @if($productCount > 0)
            @for( $count = 0; $count <= $productCount; $count++)
                @if($buyrent->productType == 1)
                    @if( $count > 0)
                        <url>
                            <loc>https://www.admissionx.com/buy-machinery{!! ($count > 1)? '?page='.$count.'' : '' !!}/</loc>
                            <lastmod>{{ $endDateFromFormDate }}</lastmod>
                            <priority>0.80</priority>
                        </url>
                    @endif
                @elseif($buyrent->productType == 2)
                    @if( $count > 0)
                        <url>
                            <loc>https://www.admissionx.com/rent-machinery{!! ($count > 1)? '?page='.$count.'' : '' !!}/</loc>
                            <lastmod>{{ $endDateFromFormDate }}</lastmod>
                            <priority>0.80</priority>
                        </url>
                    @endif
                @elseif($buyrent->productType == 4)
                    @if( $count > 0)
                        <url>
                            <loc>https://www.admissionx.com/auction-machinery{!! ($count > 1)? '?page='.$count.'' : '' !!}/</loc>
                            <lastmod>{{ $endDateFromFormDate }}</lastmod>
                            <priority>0.80</priority>
                        </url>
                    @endif
                @else
                    @if( $count > 0)
                        <url>
                            <loc>https://www.admissionx.com/search/?productType={{$buyrent->productType}}{!! ($count > 1)? '&amp;page='.$count.'' : '' !!}/</loc>
                            <lastmod>{{ $endDateFromFormDate }}</lastmod>
                            <priority>0.80</priority>
                        </url>
                    @endif
                @endif
            @endfor
        @endif
    @endforeach

    {{--*/ 
        $allProduct = sizeof($productObj);
        $searchCount = ceil($allProduct/18);
        $TimeStr= date('Y-m-d\TH:i:s');
        $TimeZoneNameFrom="Asia/Kolkata";
        $TimeZoneNameTo="Asia/Kolkata";
        $lastmodeDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");

        $allTrader = sizeof($getTraderProductObj);
        $traderCount = ceil($allTrader/10);

        $allDealer = sizeof($getDealerProductObj);
        $dealerCount = ceil($allDealer/10);
    /*--}}
        
    @if($searchCount > 0)
        @for( $counts = 0; $counts <= $searchCount; $counts++)
            @if( $counts > 0)
                <url>
                    <loc>https://www.admissionx.com/search{!! ($counts > 1)? '?page='.$counts.'' : '' !!}/</loc>
                    <lastmod>{{ $lastmodeDate }}</lastmod>
                    <priority>0.80</priority>
                </url>
            @endif
        @endfor
    @endif

    @if($traderCount > 0)
        @for( $countTrader = 0; $countTrader <= $traderCount; $countTrader++)
            @if( $countTrader > 0)
                <url>
                    <loc>https://www.admissionx.com/seller-listing{!! ($countTrader > 1)? '?page='.$countTrader.'' : '' !!}/</loc>
                    <lastmod>{{ $lastmodeDate }}</lastmod>
                    <priority>0.80</priority>
                </url>
            @endif
        @endfor
    @endif

    @if($dealerCount > 0)
        @for( $countDealer = 0; $countDealer <= $dealerCount; $countDealer++)
            @if( $countDealer > 0)
                <url>
                    <loc>https://www.admissionx.com/dealer-listing{!! ($countDealer > 1)? '?page='.$countDealer.'' : '' !!}/</loc>
                    <lastmod>{{ $lastmodeDate }}</lastmod>
                    <priority>0.80</priority>
                </url>
            @endif
        @endfor
    @endif

    @foreach ($cityForSale as $post)
        {{--*/
            $cityCount = ceil($post->cityCount/21);
            $TimeStr= date('Y-m-d\TH:i:s', strtotime($post->updated_at));
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        @if($cityCount > 0)
            @for( $count = 0; $count <= $cityCount; $count++)
                @if( $count > 0)
                    <url>
                        <loc>https://www.admissionx.com/{{ $post->citySlug }}-for-sale{!! ($count > 1)? '?page='.$count.'' : '' !!}/</loc>
                        <lastmod>{{ $endDateFromFormDate }}</lastmod>
                        <priority>0.80</priority>
                    </url>
                @endif
            @endfor
        @else
            <url>
                <loc>https://www.admissionx.com/{{ $post->citySlug }}-for-sale/</loc>
                <lastmod>{{ $endDateFromFormDate }}</lastmod>
                <priority>0.80</priority>
            </url>
        @endif
    @endforeach

    @foreach ($cityForRent as $post)
        {{--*/
            $cityCount = ceil($post->cityCount/21);
            $TimeStr= date('Y-m-d\TH:i:s', strtotime($post->updated_at));
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        @if($cityCount > 0)
            @for( $count = 0; $count <= $cityCount; $count++)
                @if( $count > 0)
                    <url>
                        <loc>https://www.admissionx.com/{{ $post->citySlug }}-for-rent{!! ($count > 1)? '?page='.$count.'' : '' !!}/</loc>
                        <lastmod>{{ $endDateFromFormDate }}</lastmod>
                        <priority>0.80</priority>
                    </url>
                @endif
            @endfor
        @else
            <url>
                <loc>https://www.admissionx.com/{{ $post->citySlug }}-for-rent/</loc>
                <lastmod>{{ $endDateFromFormDate }}</lastmod>
                <priority>0.80</priority>
            </url>
        @endif
    @endforeach

    @foreach ($cityForAuction as $post)
        {{--*/
            $cityCount = ceil($post->cityCount/21);
            $TimeStr= date('Y-m-d\TH:i:s', strtotime($post->updated_at));
            $TimeZoneNameFrom="Asia/Kolkata";
            $TimeZoneNameTo="Asia/Kolkata";
            $endDateFromFormDate = date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("c");
        /*--}}
        @if($cityCount > 0)
            @for( $count = 0; $count <= $cityCount; $count++)
                @if( $count > 0)
                    <url>
                        <loc>https://www.admissionx.com/{{ $post->citySlug }}-for-auction{!! ($count > 1)? '?page='.$count.'' : '' !!}/</loc>
                        <lastmod>{{ $endDateFromFormDate }}</lastmod>
                        <priority>0.80</priority>
                    </url>
                @endif
            @endfor
        @else
            <url>
                <loc>https://www.admissionx.com/{{ $post->citySlug }}-for-auction/</loc>
                <lastmod>{{ $endDateFromFormDate }}</lastmod>
                <priority>0.80</priority>
            </url>
        @endif
    @endforeach

</urlset>