<div class="school-info section">
    <div class="section-title">
        <h3>College Scholarship</h3>
    </div>
    <div class="section-content">
        @if( sizeof($collegeScholarshipsObj) > 0 )
            @foreach( $collegeScholarshipsObj as $key => $item )
            <div class="rating_reviews_info padding-top20 padding-bottom20 padding-left20 padding-right20">
                <div class="row margin-top10">
                    <div class="col-md-10">
                        <h2><label>Title :</label>{{$item->title}}</h2>
                        <p>{!! $item->description !!}</p>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="col-md-12">
                <div class="headline text-center">
                    <h4>College hasn't added their scholarship.</h4>
                </div>
            </div>
        @endif
    </div>
</div>