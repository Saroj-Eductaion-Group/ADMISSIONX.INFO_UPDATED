<div class="row margin-bottom10">
    <div class="col-md-8">
        <h3 class="text-uppercase text-danger">List of {{strtoupper($counselingBoard->name)}} important dates</h3>
    </div>
    <div class="col-md-4">
        <a href="javascript:void(0);" class="btn btn-block btn-sm btn-danger" id="addNewCounslingImportantDatesRow"><i class="fa fa-plus"></i> Add Important Dates</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Dates</th>
                    <th>Details</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="tableCounslingImportantDatesSection">
                @foreach($counselingBoardImpDateObj as $item)
                    <tr>
                        <td>
                            <input type="text" class="form-control" value="{{$item->dates}}" name="importantDates[]" placeholder="Dates">
                        </td>
                        <td>
                            <textarea class="form-control description" id="importantDescription"  placeholder="Enter description." name="importantDescription[]">@if($item->description) {{ $item->description or ''}} @endif</textarea>
                        </td>
                        <td>
                            <a class="btn btn-outline btn-danger btn-xs removeCounslingImportantDates"><i class="fa fa-remove"></i> Remove</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<hr>
