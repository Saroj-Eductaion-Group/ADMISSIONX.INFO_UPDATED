<div class="row margin-bottom10">
    <div class="col-md-8">
        <h3 class="text-uppercase text-warning">List of job roles & saleries</h3>
    </div>
    <div class="col-md-4">
        <a href="javascript:void(0);" class="btn btn-block btn-sm btn-warning" id="addNewCounslingJobRoleSaleryRow"><i class="fa fa-plus"></i> Add Job Role & Salery</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Avg Salery</th>
                    <th>Top Company</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="tableCounslingJobRoleSalerySection">
                @if(isset($counselingCareerJobRoleSaleryObj))
                @foreach($counselingCareerJobRoleSaleryObj as $item)
                    <tr>
                        <td>
                            <input type="text" class="form-control" value="{{$item->title}}" name="jobTitle[]" placeholder="Job Title">
                        </td>
                        <td>
                            <input type="text" class="form-control" value="{{$item->avgSalery}}" name="jobAvgSalery[]" placeholder="Avg Salery">
                        </td>
                        <td>
                            <input type="text" class="form-control" value="{{$item->topCompany}}" name="jobTopCompany[]" placeholder="Top Company">
                        </td>
                        <td>
                            <a class="btn btn-outline btn-danger btn-xs removeCounslingJobRoleSalery"><i class="fa fa-remove"></i> Remove</a>
                        </td>
                    </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
<hr>
