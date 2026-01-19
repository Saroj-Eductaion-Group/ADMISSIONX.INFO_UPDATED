<style type="text/css">
.rating_reviews_block{text-align: center;margin-top: 20px;margin-bottom: 20px;border: 1px solid #e4e4e4;border-radius: 10px;box-shadow: 2px 1px 2px 0px #eaeaea;background: #fbfbfb;padding: 20px 0px;}
.rating_reviews_block img{margin-bottom: 0px !important;}
.rating_reviews_block h3{font-size: 25px;padding-top: 10px;margin: 0px;font-family: 'Open Sans';font-weight: 600;letter-spacing: 2px;}
.rating_reviews_block h5{font-size: 15px;padding-top: 10px;margin: 0px;font-family: 'Open Sans', sans-serif;font-weight: 200;letter-spacing: 1px;}
.rating_reviews_info{background-color: #fbfbfb; border: 1px solid #e4e4e4;border-radius: 10px;box-shadow: 2px 1px 2px 0px #eaeaea; margin: 20px 0;}
.rating_reviews_info h2{font-size: 22px;color: #f34a4e;font-weight: 600;letter-spacing: 2px;margin: 0px;padding: 0;font-family: 'Open Sans';}
.rating_reviews_info h3{color: #000;font-size: 16px;font-weight: 400;margin: 0;}
.rating_reviews_info p{color: #333;font-weight: 400;text-align: justify;font-family: 'Open Sans';}
</style>
<div class="profile-edit tab-pane fade in active tag-box tag-box-v7">
	<div class="detail-page-signup">
        <div class="row padding-top5 padding-bottom5">
            <div class="col-md-12">
                <div class="headline"><h2>Rating & Reviews</h2></div>
            </div>
        </div>
        <div class="row bg-color-green1">
            <div class="col-md-8">
                <h4 class="h4">Based On 66 Student Ratings Claim This College</h4>
            </div>
            <div class="col-md-4">
            	<h4 class="h4 text-right">9/10</h4>
            </div>
        </div>

        <div class="row">
        	<div class="col-md-4">
        		<div class="rating_reviews_block">
        			<img class="img-circle" src="https://picsum.photos/60/60?random=1">
        			<h3>9.3/10</h3>
        			<h5>Academic</h5>
        		</div>
        	</div>
        	<div class="col-md-4">
        		<div class="rating_reviews_block">
        			<img class="img-circle" src="https://picsum.photos/60/60?random=2">
        			<h3>9.3/10</h3>
        			<h5>Accommodation</h5>
        		</div>
        	</div>
        	<div class="col-md-4">
        		<div class="rating_reviews_block">
        			<img class="img-circle" src="https://picsum.photos/60/60?random=3">
        			<h3>9.3/10</h3>
        			<h5>Faculty</h5>
        		</div>
        	</div>
        </div>
        <div class="row margin-top10">
        	<div class="col-md-4">
        		<div class="rating_reviews_block">
        			<img class="img-circle" src="https://picsum.photos/60/60?random=4">
        			<h3>9.3/10</h3>
        			<h5>Infrastructure</h5>
        		</div>
        	</div>
        	<div class="col-md-4">
        		<div class="rating_reviews_block">
        			<img class="img-circle" src="https://picsum.photos/60/60?random=5">
        			<h3>9.3/10</h3>
        			<h5>Placement</h5>
        		</div>
        	</div>
        	<div class="col-md-4">
        		<div class="rating_reviews_block">
        			<img class="img-circle" src="https://picsum.photos/60/60?random=6">
        			<h3>9.3/10</h3>
        			<h5>Social</h5>
        		</div>
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