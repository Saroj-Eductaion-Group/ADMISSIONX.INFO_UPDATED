<style type="text/css">
.rating_reviews_info{background-color: #fbfbfb; border: 1px solid #e4e4e4;border-radius: 10px;box-shadow: 2px 1px 2px 0px #eaeaea; margin: 20px 0;}
.rating_reviews_info h2{font-size: 22px;color: #f34a4e;font-weight: 600;letter-spacing: 2px;margin: 0px;padding: 0;font-family: 'Open Sans';}
.rating_reviews_info h3{color: #000;font-size: 16px;font-weight: 400;margin: 0;}
.rating_reviews_info p{font-size: 14px; color: #333;font-weight: 400;text-align: justify;font-family: 'Open Sans';}
</style>
<div class="profile-edit tab-pane fade in active tag-box tag-box-v7">
	<div class="detail-page-signup">
        <div class="row padding-top5 padding-bottom5">
            <div class="col-md-12">
                <div class="headline"><h2>Faculty Details</h2></div>
            </div>
        </div>
        @foreach($getFacultyObj as $key => $item)
        <div class="rating_reviews_info padding-top10 padding-bottom10 padding-left20 padding-right20">
            <div class="row margin-top10">
                <div class="col-md-2 text-center">
                    @if(!empty($item->imagename))
                        <img class="img-circle" src="{{ asset('gallery/'.$slugUrl.'/'.$item->imagename) }}" width="80" height="80">
                    @else
                        <img class="img-circle" src="https://picsum.photos/80/80?random=6{{ $key }}">
                    @endif
                </div>
                <div class="col-md-7">
                    <h2>{{ $item->suffix}} {{ $item->name }}</h2>
                    <h3 class="text-capitalize">{{ $item->description }}</h3>
                </div>
                <div class="col-md-3">
                    @if(!empty($item->phone))
                        <p><a class="color-dark word-break-text" href="tel:{{ $item->phone }}"><i class="fa fa-phone"></i> {{ $item->phone }}</a></p>
                    @endif
                    @if(!empty($item->email))
                        <p><a class="color-dark word-break-text" href="mailto:{{ $item->email }}"><i class="fa fa-envelope"></i> {{ $item->email }}</a></p>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>