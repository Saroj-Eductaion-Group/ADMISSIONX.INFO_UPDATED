<div class="row margin-bottom10">
    <div class="col-md-8">
        <h3 class="text-uppercase text-info">List of where to study</h3>
    </div>
    <div class="col-md-4">
        <a href="javascript:void(0);" class="btn btn-block btn-sm btn-info" id="addNewCounslingWhereToStudyRow"><i class="fa fa-plus"></i> Add Where To Study</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Institute Name</th>
                    <th>Institute Url</th>
                    <th>City</th>
                    <th>Programme Fees</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="tableCounslingWhereToStudySection">
                @if(isset($counselingCareerWhereToStudyObj))
                @foreach($counselingCareerWhereToStudyObj as $item)
                    <tr>
                        <td>
                            <input type="text" class="form-control" value="{{$item->instituteName}}" name="studyInstituteName[]" placeholder="Institute Name">
                        </td>
                        <td>
                            <input type="url" class="form-control" value="{{$item->instituteUrl}}" name="studyInstituteUrl[]" placeholder="Institute Url">
                        </td>
                        <td>
                            <input type="text" class="form-control" value="{{$item->city}}" name="studyCity[]" placeholder="Institute Place">
                        </td>
                        <td>
                            <input type="text" class="form-control" value="{{$item->programmeFees}}" name="studyProgrammeFees[]" placeholder="Programme Fees">
                        </td>
                        <td>
                            <a class="btn btn-outline btn-danger btn-xs removeCounslingWhereToStudy"><i class="fa fa-remove"></i> Remove</a>
                        </td>
                    </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
<hr>