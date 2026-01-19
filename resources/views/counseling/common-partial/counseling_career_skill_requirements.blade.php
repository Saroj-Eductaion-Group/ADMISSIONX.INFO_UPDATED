<div class="row margin-bottom10">
    <div class="col-md-8">
        <h3 class="text-uppercase text-success">List of required skills</h3>
    </div>
    <div class="col-md-4">
        <a href="javascript:void(0);" class="btn btn-block btn-sm btn-success" id="addNewCounslingSkillRow"><i class="fa fa-plus"></i> Add Skill</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Skill</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="tableCounslingSkillSection">
                @if(isset($counselingCareerSkillRequirementObj))
                @foreach($counselingCareerSkillRequirementObj as $item)
                    <tr>
                        <td width="95%">
                            <input type="text" class="form-control" value="{{$item->title}}" name="skillTitle[]" placeholder="Skill">
                        </td>
                        <td>
                            <a class="btn btn-outline btn-danger btn-xs removeCounslingSkill"><i class="fa fa-remove"></i> Remove</a>
                        </td>
                    </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
<hr>
