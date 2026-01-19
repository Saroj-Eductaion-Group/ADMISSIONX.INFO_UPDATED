<div class="row margin-bottom10">
    <div class="col-md-8">
        <h3 class="text-uppercase text-success">List of {{strtoupper($counselingBoard->name)}} Examination Dates</h3>
    </div>
    <div class="col-md-4">
        <a href="javascript:void(0);" class="btn btn-block btn-sm btn-success" id="addNewCounslingExaminationDatesRow"><i class="fa fa-plus"></i> Add Examination Dates</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Exam Class</th>
                    <th>Exam Dates</th>
                    <th>Exam Subject</th>
                    <th>Exam Setting</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="tableCounslingExaminationDatesSection">
                @foreach($counselingBoardExamDateObj as $item)
                    <tr>
                        <td>
                            <input type="text" class="form-control" value="{{$item->class}}" name="examclass[]" placeholder="Exam Class">
                        </td>
                        <td>
                            <input type="text" class="form-control" value="{{$item->dates}}" name="examdates[]" placeholder="Exam Dates">
                        </td>
                        <td>
                            <input type="text" class="form-control" value="{{$item->subject}}" name="examsubject[]" placeholder="Exam Subject">
                        </td>
                        <td>
                            <input type="text" class="form-control" value="{{$item->setting}}" name="examsetting[]" placeholder="Exam Setting">
                        </td>
                        <td>
                            <a class="btn btn-outline btn-danger btn-xs removeCounslingExaminationDates"><i class="fa fa-remove"></i> Remove</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<hr>
