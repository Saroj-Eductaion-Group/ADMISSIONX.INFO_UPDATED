<div class="profile-edit tab-pane fade in active margin-top30 white-popup">
    <div class="detail-page-signup">
        <!-- START ADDRESS FORM FOR REGISTER -->
        <div>
            <form method="POST" action="/college-placement-partial" data-parsley-validate  enctype="multipart/form-data">
                <input type="hidden" name="collegeScholarshipId" value="{{ $collegePlacementDataObj->collegeScholarshipId }}">
                <input type="hidden" name="slugUrl" value="{{ $collegePlacementDataObj->slug }}">
                <div class="row padding-top5 padding-bottom5">
                    <div class="col-md-12">
                        <label>Placement Information </label>
                        <textarea class="form-control summernote" placeholder="Please enter placement info here" name="placementinfo" rows="8" data-parsley-error-message = "Please enter the placement description" data-parsley-trigger="change">{{ $collegePlacementDataObj->placementinfo }}</textarea>
                    </div>
                </div>
                <div class="row padding-top5 padding-bottom5">
                    <div class="col-md-6">
                        <label>Number Of Recruiting Companies</label>
                        <input type="text" class="form-control" name="numberofrecruitingcompany" placeholder="Please enter number of recruiting companies here" data-parsley-type="number" required="" data-parsley-error-message="Please enter number of recruiting companies here" data-parsley-trigger="change" value="{{ $collegePlacementDataObj->numberofrecruitingcompany }}">
                    </div>
                    <div class="col-md-6">
                        <label>Number Of Placements & Year</label>
                        <input type="text" class="form-control" name="numberofplacementlastyear" placeholder="Please enter number of placements & year" required="" data-parsley-error-message="Please enter number of placements & Year here" data-parsley-trigger="change" value="{{ $collegePlacementDataObj->numberofplacementlastyear }}">
                    </div>
                </div>
                <div class="row padding-top5 padding-bottom5">
                    <div class="col-md-4">
                        <label>CTC Highest </label>
                        <input type="text" class="form-control" name="ctchighest" placeholder="Please enter CTC highest here" data-parsley-pattern="^[0-9a-zA-Z\s .,]*$" required="" data-parsley-error-message="Please enter CTC highest here" data-parsley-trigger="change" value="{{ $collegePlacementDataObj->ctchighest }}">
                    </div>
                    <div class="col-md-4">
                        <label>CTC Lowest </label>
                        <input type="text" class="form-control" name="ctclowest" placeholder="Please enter CTC lowest here" data-parsley-pattern="^[0-9a-zA-Z\s .,]*$" required="" data-parsley-error-message="Please enter CTC lowest here" data-parsley-trigger="change" value="{{ $collegePlacementDataObj->ctclowest }}">
                    </div>
                    <div class="col-md-4">
                        <label>CTC Average </label>
                        <input type="text" class="form-control" name="ctcaverage" placeholder="Please enter CTC average here" data-parsley-pattern="^[0-9a-zA-Z\s .,]*$" required="" data-parsley-error-message="Please enter CTC average here" data-parsley-trigger="change" value="{{ $collegePlacementDataObj->ctcaverage }}">
                    </div>
                </div>
                <hr>
                <div class="row padding-top5 padding-bottom5">
                    <div class="col-md-12 col-lg-12 text-right">
                        <button class="btn-u" type="submit">Update</button>
                    </div>
                </div>
            </form>         
        </div>
    </div>
</div>
{!! Html::script('assets/js/parsley.min.js') !!}

<script type="text/javascript">
  $('form').parsley();
</script>