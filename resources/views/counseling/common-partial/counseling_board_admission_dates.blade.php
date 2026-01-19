<div class="row margin-bottom10">
    <div class="col-md-8">
        <h3 class="text-uppercase text-primary">List of {{strtoupper($counselingBoard->name)}} Admission Dates</h3>
    </div>
    <div class="col-md-4">
        <a href="javascript:void(0);" class="btn btn-block btn-sm btn-primary" id="addNewCounslingAdmissionDatesRow"><i class="fa fa-plus"></i> Add Admission Dates</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Class</th>
                    <th>Dates</th>
                    <th>Subjects</th>
                    <th>Fees</th>
                    <th>Place</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="tableCounslingAdmissionDatesSection">
                @foreach($counselingBoardAdmissionDateObj as $item)
                    <tr>
                        <td>
                            <input type="text" class="form-control" value="{{$item->class}}" name="admissionClass[]" placeholder="Class Name">
                        </td>
                        <td>
                            <input type="text" class="form-control" value="{{$item->dates}}" name="admissionDates[]" placeholder="Admission Dates">
                        </td>
                        <td>
                            <input type="text" class="form-control" value="{{$item->subjects}}" name="admissionSubjects[]" placeholder="Subjects">
                        </td>
                        <td>
                            <input type="text" class="form-control" value="{{$item->fees}}" name="admissionFees[]" placeholder="Fees Amount">
                        </td>
                        <td>
                            <input type="text" class="form-control" value="{{$item->place}}" name="admissionPlace[]" placeholder="Place">
                        </td>
                        <td>
                            <a class="btn btn-outline btn-danger btn-xs removeCounslingAdmissionDates"><i class="fa fa-remove"></i> Remove</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<hr>
