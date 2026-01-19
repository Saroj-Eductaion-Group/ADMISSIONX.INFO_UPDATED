<style type="text/css">
.rating_reviews_info{background-color: #fbfbfb; border: 1px solid #e4e4e4;border-radius: 10px;box-shadow: 2px 1px 2px 0px #eaeaea; margin: 20px 0;}
.rating_reviews_info h2{font-size: 22px;color: #f34a4e;font-weight: 600;letter-spacing: 2px;margin: 0px;padding: 0;font-family: 'Open Sans';}
.rating_reviews_info h3{color: #000;font-size: 16px;font-weight: 400;margin: 0;}
.rating_reviews_info p{color: #333;font-weight: 400;text-align: justify;font-family: 'Open Sans';}
</style>
<div class="profile-edit tab-pane fade in active tag-box tag-box-v7">
	<div class="detail-page-signup">
        <div class="row padding-top5 padding-bottom5">
            <div class="col-md-12">
                <div class="headline"><h2>Scholarship Reviews</h2></div>
            </div>
        </div>
        @for($counter = 1; $counter <=15; $counter++)
        <div class="rating_reviews_info padding-top20 padding-bottom20 padding-left20 padding-right20">
            <div class="row margin-top10">
                <div class="col-md-2 text-center"><img class="img-circle" src="https://picsum.photos/80/80?random=6{{$counter}}"></div>
                <div class="col-md-8">
                    <h2>Best College Of India</h2>
                    <h3>Test User</h3>
                    <p>Good thing was one will get every kind of facility in the college. There is a huge auditorium where one will get to see the movie and cricket match . Bad thing was, the procedure of taking courses and registration for the new semester is quit lengthy</p>
                </div>
                <div class="col-md-2">
                    <h1 class="text-right h3 margin-top0">9/10</h1>
                </div>
            </div>
        </div>
        @endfor
    </div>
</div>