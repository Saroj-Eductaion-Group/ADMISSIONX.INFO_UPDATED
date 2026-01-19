https://www.admissionx.com/
https://www.admissionx.com/buy-machinery/
https://www.admissionx.com/rent-machinery/
https://www.admissionx.com/auction-machinery/
https://www.admissionx.com/seller-listing/
https://www.admissionx.com/dealer-listing/
https://www.admissionx.com/news/
https://www.admissionx.com/about-us/
https://www.admissionx.com/seller-register/
https://www.admissionx.com/dealer-register/
https://www.admissionx.com/trader-register/
https://www.admissionx.com/buyer-register/
https://www.admissionx.com/user-register/
https://www.admissionx.com/search/
https://www.admissionx.com/contact-us/
https://www.admissionx.com/privacy-policy/
https://www.admissionx.com/policies/
https://www.admissionx.com/terms-of-use/
https://www.admissionx.com/terms-and-conditions/
https://www.admissionx.com/sitemap/
https://www.admissionx.com/404/
https://www.admissionx.com/register/
https://www.admissionx.com/login/
https://www.admissionx.com/all-category-list/
https://www.admissionx.com/exhibition-list/
https://www.admissionx.com/auction-list/


@foreach ($exhibitionList as $post)
https://www.admissionx.com/exhibition-details/{{ $post->exhibitionSlug }}/
@endforeach

@foreach ($auctionList as $post)
https://www.admissionx.com/auction-details/{{ $post->auctionSlug }}/
@endforeach

@foreach ($classForSale as $post)
{{--*/
$classCount = ceil($post->classCount/21);
/*--}}
@if($classCount > 0)
@for( $count = 0; $count <= $classCount; $count++)
@if( $count > 0)
https://www.admissionx.com/{{ $post->classesSlug }}-for-sale{!! ($count > 1)? '?page='.$count.'' : '' !!}/
@endif
@endfor
@else
https://www.admissionx.com/{{ $post->classesSlug }}-for-sale/
@endif
@endforeach

@foreach ($classForRent as $post)
{{--*/
$classCount = ceil($post->classCount/21);
/*--}}
@if($classCount > 0)
@for( $count = 0; $count <= $classCount; $count++)
@if( $count > 0)
https://www.admissionx.com/{{ $post->classesSlug }}-for-rent{!! ($count > 1)? '?page='.$count.'' : '' !!}/
@endif
@endfor
@else
https://www.admissionx.com/{{ $post->classesSlug }}-for-rent/
@endif
@endforeach

@foreach ($classForAuction as $post)
{{--*/
$classCount = ceil($post->classCount/21);
/*--}}
@if($classCount > 0)
@for( $count = 0; $count <= $classCount; $count++)
@if( $count > 0)
https://www.admissionx.com/{{ $post->classesSlug }}-for-auction{!! ($count > 1)? '?page='.$count.'' : '' !!}/
@endif
@endfor
@else
https://www.admissionx.com/{{ $post->classesSlug }}-for-auction/
@endif
@endforeach


@foreach ($categoriesForSale as $post)
{{--*/
$categoryCount = ceil($post->categoryCount/21);
/*--}}
@if($categoryCount > 0)
@for( $count = 0; $count <= $categoryCount; $count++)
@if( $count > 0)
https://www.admissionx.com/{{ $post->categoriesSlug }}-for-sale{!! ($count > 1)? '?page='.$count.'' : '' !!}/
@endif
@endfor
@else
https://www.admissionx.com/{{ $post->categoriesSlug }}-for-sale/
@endif
@endforeach

@foreach ($categoriesForRent as $post)
{{--*/
$categoryCount = ceil($post->categoryCount/21);
/*--}}
@if($categoryCount > 0)
@for( $count = 0; $count <= $categoryCount; $count++)
@if( $count > 0)
https://www.admissionx.com/{{ $post->categoriesSlug }}-for-rent{!! ($count > 1)? '?page='.$count.'' : '' !!}/
@endif
@endfor
@else
https://www.admissionx.com/{{ $post->categoriesSlug }}-for-rent/
@endif
@endforeach

@foreach ($categoriesForAuction as $post)
{{--*/
$categoryCount = ceil($post->categoryCount/21);
/*--}}
@if($categoryCount > 0)
@for( $count = 0; $count <= $categoryCount; $count++)
@if( $count > 0)
https://www.admissionx.com/{{ $post->categoriesSlug }}-for-auction{!! ($count > 1)? '?page='.$count.'' : '' !!}/
@endif
@endfor
@else
https://www.admissionx.com/{{ $post->categoriesSlug }}-for-auction/
@endif
@endforeach


@foreach ($childCategoryForSale as $post)
{{--*/
$childCategoryCount = ceil($post->childCategoryCount/21);
/*--}}
@if($childCategoryCount > 0)
@for( $count = 0; $count <= $childCategoryCount; $count++)
@if( $count > 0)
https://www.admissionx.com/{{ $post->child_categoriesSlug }}-for-sale{!! ($count > 1)? '?page='.$count.'' : '' !!}/
@endif
@endfor
@else
https://www.admissionx.com/{{ $post->child_categoriesSlug }}-for-sale/
@endif
@endforeach

@foreach ($childCategoryForRent as $post)
{{--*/
$childCategoryCount = ceil($post->childCategoryCount/21);
/*--}}
@if($childCategoryCount > 0)
@for( $count = 0; $count <= $childCategoryCount; $count++)
@if( $count > 0)
https://www.admissionx.com/{{ $post->child_categoriesSlug }}-for-rent{!! ($count > 1)? '?page='.$count.'' : '' !!}/
@endif
@endfor
@else
https://www.admissionx.com/{{ $post->child_categoriesSlug }}-for-rent/
@endif
@endforeach

@foreach ($childCategoryForAuction as $post)
{{--*/
$childCategoryCount = ceil($post->childCategoryCount/21);
/*--}}
@if($childCategoryCount > 0)
@for( $count = 0; $count <= $childCategoryCount; $count++)
@if( $count > 0)
https://www.admissionx.com/{{ $post->child_categoriesSlug }}-for-auction{!! ($count > 1)? '?page='.$count.'' : '' !!}/
@endif
@endfor
@else
https://www.admissionx.com/{{ $post->child_categoriesSlug }}-for-auction/
@endif
@endforeach

@foreach ($makesForSale as $post)
{{--*/
$makeCount = ceil($post->makeCount/21);
/*--}}
@if($makeCount > 0)
@for( $count = 0; $count <= $makeCount; $count++)
@if( $count > 0)
https://www.admissionx.com/{{ $post->makesSlug }}-for-sale{!! ($count > 1)? '?page='.$count.'' : '' !!}/
@endif
@endfor
@else
https://www.admissionx.com/{{ $post->makesSlug }}-for-sale/
@endif
@endforeach

@foreach ($makesForRent as $post)
{{--*/
$makeCount = ceil($post->makeCount/21);
/*--}}
@if($makeCount > 0)
@for( $count = 0; $count <= $makeCount; $count++)
@if( $count > 0)
https://www.admissionx.com/{{ $post->makesSlug }}-for-rent{!! ($count > 1)? '?page='.$count.'' : '' !!}/
@endif
@endfor
@else
https://www.admissionx.com/{{ $post->makesSlug }}-for-rent/
@endif
@endforeach

@foreach ($makesForAuction as $post)
{{--*/
$makeCount = ceil($post->makeCount/21);
/*--}}
@if($makeCount > 0)
@for( $count = 0; $count <= $makeCount; $count++)
@if( $count > 0)
https://www.admissionx.com/{{ $post->makesSlug }}-for-auction{!! ($count > 1)? '?page='.$count.'' : '' !!}/
@endif
@endfor
@else
https://www.admissionx.com/{{ $post->makesSlug }}-for-auction/
@endif
@endforeach

@foreach ($modelForSale as $post)
{{--*/
$modelCount = ceil($post->modelCount/21);
/*--}}
@if($modelCount > 0)
@for( $count = 0; $count <= $modelCount; $count++)
@if( $count > 0)
https://www.admissionx.com/{{ $post->make_modelsSlug }}-for-sale{!! ($count > 1)? '?page='.$count.'' : '' !!}/
@endif
@endfor
@else
https://www.admissionx.com/{{ $post->make_modelsSlug }}-for-sale/
@endif
@endforeach

@foreach ($modelForRent as $post)
{{--*/
$modelCount = ceil($post->modelCount/21);
/*--}}
@if($modelCount > 0)
@for( $count = 0; $count <= $modelCount; $count++)
@if( $count > 0)
https://www.admissionx.com/{{ $post->make_modelsSlug }}-for-rent{!! ($count > 1)? '?page='.$count.'' : '' !!}/
@endif
@endfor
@else
https://www.admissionx.com/{{ $post->make_modelsSlug }}-for-rent/
@endif
@endforeach

@foreach ($modelForAuction as $post)
{{--*/
$modelCount = ceil($post->modelCount/21);
/*--}}
@if($modelCount > 0)
@for( $count = 0; $count <= $modelCount; $count++)
@if( $count > 0)
https://www.admissionx.com/{{ $post->make_modelsSlug }}-for-auction{!! ($count > 1)? '?page='.$count.'' : '' !!}/
@endif
@endfor
@else
https://www.admissionx.com/{{ $post->make_modelsSlug }}-for-auction/
@endif
@endforeach

@foreach ($subModelForSale as $post)
{{--*/
$subModelCount = ceil($post->subModelCount/21);
/*--}}
@if($subModelCount > 0)
@for( $count = 0; $count <= $subModelCount; $count++)
@if( $count > 0)
https://www.admissionx.com/{{ $post->make_sub_modelsSlug }}-for-sale{!! ($count > 1)? '?page='.$count.'' : '' !!}/
@endif
@endfor
@else
https://www.admissionx.com/{{ $post->make_sub_modelsSlug }}-for-sale/
@endif
@endforeach

@foreach ($subModelForRent as $post)
{{--*/
$subModelCount = ceil($post->subModelCount/21);
/*--}}
@if($subModelCount > 0)
@for( $count = 0; $count <= $subModelCount; $count++)
@if( $count > 0)
https://www.admissionx.com/{{ $post->make_sub_modelsSlug }}-for-rent{!! ($count > 1)? '?page='.$count.'' : '' !!}/
@endif
@endfor
@else
https://www.admissionx.com/{{ $post->make_sub_modelsSlug }}-for-rent/
@endif
@endforeach

@foreach ($subModelForAuction as $post)
{{--*/
$subModelCount = ceil($post->subModelCount/21);
/*--}}
@if($subModelCount > 0)
@for( $count = 0; $count <= $subModelCount; $count++)
@if( $count > 0)
https://www.admissionx.com/{{ $post->make_sub_modelsSlug }}-for-auction{!! ($count > 1)? '?page='.$count.'' : '' !!}/
@endif
@endfor
@else
https://www.admissionx.com/{{ $post->make_sub_modelsSlug }}-for-auction/
@endif
@endforeach

@foreach ($countryForSale as $post)
{{--*/
$countryCount = ceil($post->countryCount/21);
/*--}}
@if($countryCount > 0)
@for( $count = 0; $count <= $countryCount; $count++)
@if( $count > 0)
https://www.admissionx.com/{{ $post->countrySlug }}-for-sale{!! ($count > 1)? '?page='.$count.'' : '' !!}/
@endif
@endfor
@else
https://www.admissionx.com/{{ $post->countrySlug }}-for-sale/
@endif
@endforeach

@foreach ($countryForRent as $post)
{{--*/
$countryCount = ceil($post->countryCount/21);
/*--}}
@if($countryCount > 0)
@for( $count = 0; $count <= $countryCount; $count++)
@if( $count > 0)
https://www.admissionx.com/{{ $post->countrySlug }}-for-rent{!! ($count > 1)? '?page='.$count.'' : '' !!}/
@endif
@endfor
@else
https://www.admissionx.com/{{ $post->countrySlug }}-for-rent/
@endif
@endforeach

@foreach ($countryForAuction as $post)
{{--*/
$countryCount = ceil($post->countryCount/21);
/*--}}
@if($countryCount > 0)
@for( $count = 0; $count <= $countryCount; $count++)
@if( $count > 0)
https://www.admissionx.com/{{ $post->countrySlug }}-for-auction{!! ($count > 1)? '?page='.$count.'' : '' !!}/
@endif
@endfor
@else
https://www.admissionx.com/{{ $post->countrySlug }}-for-auction/
@endif
@endforeach

@foreach ($productObj as $product)
{{--*/
$TimeStr= date('Y-m-d\TH:i:s', strtotime($product->updated_at));
/*--}}
https://www.admissionx.com/product/{{strtolower($product->child_categoriesSlug)}}/{{ strtolower($product->productSlugUrl) }}/
@endforeach

@foreach ($getBlogsObj as $blog)
{{--*/
$TimeStr= date('Y-m-d\TH:i:s', strtotime($blog->createdDate));
/*--}}
https://www.admissionx.com/blog/{{strtolower($blog->slug)}}/
@endforeach

@foreach ($getCategoryBlogsObj as $categoryBlog)
{{--*/
$newstypeCount = ceil($categoryBlog->newstypeCount/10);
/*--}}
@if($newstypeCount > 0)
@for( $count = 0; $count <= $newstypeCount; $count++)
@if( $count > 0)
https://www.admissionx.com/news/categories/{{ $categoryBlog->newsslug }}{!! ($count > 1)? '?page='.$count.'' : '' !!}/
@endif
@endfor
@else
https://www.admissionx.com/news/categories/{{ $categoryBlog->newsslug }}/
@endif
@endforeach

@foreach ($getAllTagBlogsObj as $tagBlog)
{{--*/
$allTagBlogCount = ceil($tagBlog->allTagBlogCount/10);
/*--}}
@if($allTagBlogCount > 0)
@for( $count = 0; $count <= $allTagBlogCount; $count++)
@if( $count > 0)
https://www.admissionx.com/news/tags/{{ $tagBlog->slug }}{!! ($count > 1)? '?page='.$count.'' : '' !!}/
@endif
@endfor
@else
https://www.admissionx.com/news/tags/{{ $tagBlog->slug }}/
@endif
@endforeach

@foreach ($getTraderProductObj as $traderProduct)
{{--*/
$allTraderProductCount = ceil($traderProduct->allTraderProductCount/20);
/*--}}
@if($allTraderProductCount > 0)
@for( $count = 0; $count <= $allTraderProductCount; $count++)
@if( $count > 0)
https://www.admissionx.com/seller-profile/{{ $traderProduct->companySlug }}{!! ($count > 1)? '?page='.$count.'' : '' !!}/
@endif
@endfor
@else
https://www.admissionx.com/seller-profile/{{ $traderProduct->companySlug }}/
@endif
@endforeach

@foreach ($getDealerProductObj as $dealerProduct)
{{--*/
$allDealerProductCount = ceil($dealerProduct->allDealerProductCount/20);
/*--}}
@if($allDealerProductCount > 0)
@for( $count = 0; $count <= $allDealerProductCount; $count++)
@if( $count > 0)
https://www.admissionx.com/dealer-profile/{{ $dealerProduct->companySlug }}{!! ($count > 1)? '?page='.$count.'' : '' !!}/
@endif
@endfor
@else
https://www.admissionx.com/dealer-profile/{{ $dealerProduct->companySlug }}/
@endif
@endforeach

@foreach ($searchProductObj as $packageProduct)
{{--*/
$productCount = ceil($packageProduct->productCount/18);

/*--}}
@if($productCount > 0)
@for( $count = 0; $count <= $productCount; $count++)
@if( $count > 0)
https://www.admissionx.com/search?packages={{ $packageProduct->package_id }}{!! ($count > 1)? '&page='.$count.'' : '' !!}/
@endif
@endfor
@else
https://www.admissionx.com/search?packages={{$packageProduct->package_id}}/
@endif
@endforeach


@foreach ($buyRentProductObj as $buyrent)
{{--*/
$productCount = ceil($buyrent->productCount/18);

/*--}}
@if($productCount > 0)
@for( $count = 0; $count <= $productCount; $count++)
@if($buyrent->productType == 1)
@if( $count > 0)
https://www.admissionx.com/buy-machinery{!! ($count > 1)? '?page='.$count.'' : '' !!}/
@endif
@elseif($buyrent->productType == 2)
@if( $count > 0)
https://www.admissionx.com/rent-machinery{!! ($count > 1)? '?page='.$count.'' : '' !!}/
@endif
@elseif($buyrent->productType == 4)
@if( $count > 0)
https://www.admissionx.com/auction-machinery{!! ($count > 1)? '?page='.$count.'' : '' !!}/
@endif
@else
@if( $count > 0)
https://www.admissionx.com/search/?productType={{$buyrent->productType}}{!! ($count > 1)? '&page='.$count.'' : '' !!}/
@endif
@endif
@endfor
@endif
@endforeach

{{--*/ 
$allProduct = sizeof($productObj);
$searchCount = ceil($allProduct/18);

$allTrader = sizeof($getTraderProductObj);
$traderCount = ceil($allTrader/10);

$allDealer = sizeof($getDealerProductObj);
$dealerCount = ceil($allDealer/10);
/*--}}

@if($searchCount > 0)
@for( $counts = 0; $counts <= $searchCount; $counts++)
@if( $counts > 0)
https://www.admissionx.com/search{!! ($counts > 1)? '?page='.$counts.'' : '' !!}/
@endif
@endfor
@endif

@if($traderCount > 0)
@for( $countTrader = 0; $countTrader <= $traderCount; $countTrader++)
@if( $countTrader > 0)
https://www.admissionx.com/seller-listing{!! ($countTrader > 1)? '?page='.$countTrader.'' : '' !!}/
@endif
@endfor
@endif

@if($dealerCount > 0)
@for( $countDealer = 0; $countDealer <= $dealerCount; $countDealer++)
@if( $countDealer > 0)
https://www.admissionx.com/dealer-listing{!! ($countDealer > 1)? '?page='.$countDealer.'' : '' !!}/
@endif
@endfor
@endif


@foreach ($cityForSale as $post)
{{--*/
$cityCount = ceil($post->cityCount/21);
/*--}}
@if($cityCount > 0)
@for( $count = 0; $count <= $cityCount; $count++)
@if( $count > 0)
https://www.admissionx.com/{{ $post->citySlug }}-for-sale{!! ($count > 1)? '?page='.$count.'' : '' !!}/
@endif
@endfor
@else
https://www.admissionx.com/{{ $post->citySlug }}-for-sale/
@endif
@endforeach

@foreach ($cityForRent as $post)
{{--*/
$cityCount = ceil($post->cityCount/21);
/*--}}
@if($cityCount > 0)
@for( $count = 0; $count <= $cityCount; $count++)
@if( $count > 0)
https://www.admissionx.com/{{ $post->citySlug }}-for-rent{!! ($count > 1)? '?page='.$count.'' : '' !!}/
@endif
@endfor
@else
https://www.admissionx.com/{{ $post->citySlug }}-for-rent/
@endif
@endforeach

@foreach ($cityForAuction as $post)
{{--*/
$cityCount = ceil($post->cityCount/21);
/*--}}
@if($cityCount > 0)
@for( $count = 0; $count <= $cityCount; $count++)
@if( $count > 0)
https://www.admissionx.com/{{ $post->citySlug }}-for-auction{!! ($count > 1)? '?page='.$count.'' : '' !!}/
@endif
@endfor
@else
https://www.admissionx.com/{{ $post->citySlug }}-for-auction/
@endif
@endforeach
