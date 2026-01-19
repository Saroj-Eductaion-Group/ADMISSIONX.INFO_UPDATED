<hr>
<div class="row margin-bottom10">
    <div class="col-md-8">
        <h3 class="text-uppercase text-primary">List of "{{strtoupper($counselingCoursesDetail->title)}}" Job Careers</h3>
    </div>
    <div class="col-md-4">
        <a href="javascript:void(0);" class="btn btn-block btn-sm btn-primary" id="addNewCoursesJobCareerRow"><i class="fa fa-plus"></i> Add Job Careers</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Job Profiles</th>
                    <th>Avg Salery</th>
                    <th>Top Company</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="tableCoursesJobCareerSection">
                @foreach($counselingCoursesJobCareerObj as $item)
                    <tr>
                        <td>
                            <input type="text" class="form-control" value="{{$item->courseName}}" name="courseName[]" placeholder="Course Name">
                        </td>
                        <td>
                            <input type="text" class="form-control" value="{{$item->jobProfiles}}" name="jobProfiles[]" placeholder="Job Profiles">
                        </td>
                        <td>
                            <input type="text" class="form-control" value="{{$item->avgSalery}}" name="avgSalery[]" placeholder="Avg Salery">
                        </td>
                        <td>
                            <input type="text" class="form-control" value="{{$item->topCompany}}" name="topCompany[]" placeholder="Top Company">
                        </td>
                        <td>
                            <a class="btn btn-outline btn-danger btn-xs removeCoursesJobCareer"><i class="fa fa-remove"></i> Remove</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<hr>
