@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('AskQuestion'); /*--}}
{{--*/ $validateUserRoleAnswer = $fetchDataServiceController->validateUserRoleCall('AskQuestionAnswer'); /*--}}
{{--*/ $validateUserRoleComment = $fetchDataServiceController->validateUserRoleCall('AskQuestionAnswerComment'); /*--}}
@if(Auth::check())
    @if(Auth::user()->userrole_id == 4)
        @if((isset($validateUserRoleAnswer)) && (sizeof($validateUserRoleAnswer) > 0) && ($validateUserRoleAnswer[0]->create == '1'))
            {{--*/ $answerBlockStatus = "show"; /*--}}
        @else
            {{--*/ $answerBlockStatus = "hide"; /*--}}
        @endif
        @if((isset($validateUserRoleComment)) && (sizeof($validateUserRoleComment) > 0) && ($validateUserRoleComment[0]->create == '1'))
            {{--*/ $commentBlockStatus = "show"; /*--}}
        @else
            {{--*/ $commentBlockStatus = "hide"; /*--}}
        @endif
    @else
        {{--*/ 
            $answerBlockStatus = "show"; 
            $commentBlockStatus = "show";
        /*--}} 
    @endif
@endif
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Ask Question Details {{ $askquestion->id }}
        @if(Auth::check())
            @if(Auth::user()->userrole_id == 4)
                @if((isset($validateUserRoleAskQuestion)) && (sizeof($validateUserRoleAskQuestion) > 0) && ($validateUserRoleAskQuestion[0]->create == '1'))
                <a href="{{ url($fetchDataServiceController->routeCall().'/ask-question/create') }}" class="btn btn-primary pull-right btn-sm">Add New Ask Question</a>
                @endif
            @else
                <a href="{{ url($fetchDataServiceController->routeCall().'/ask-question/create') }}" class="btn btn-primary pull-right btn-sm">Add New Ask Question</a>
            @endif
        @endif
        </h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
                @if(Session::has('flash_message'))
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="alert {{ Session::get('alert_class') }}  alert-dismissible fade in text-center" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>{{ Session::get('flash_message') }}</strong>
                            </div>
                        </div>
                    </div>
                @endif
               <a href="{{ url($fetchDataServiceController->routeCall().'/ask-question') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                @if(Auth::check())
                    @if(Auth::user()->userrole_id == 4)
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
                        <a href="{{ url($fetchDataServiceController->routeCall().'/ask-question/' . $askquestion->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit askquestion"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        @endif
                        @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->delete == '1'))
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => [$fetchDataServiceController->routeCall().'/ask-question', $askquestion->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete askquestion',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        @endif
                    @else
                       <a href="{{ url($fetchDataServiceController->routeCall().'/ask-question/' . $askquestion->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit askquestion"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => [$fetchDataServiceController->routeCall().'/ask-question', $askquestion->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete askquestion',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                    @endif
                @endif
               <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $askquestion->id }}</td> 
                        </tr>
                        <tr>
                            <th>Question</th>
                            <td>{!! $askquestion->question !!} </td>
                        </tr>
                        <tr>
                            <th>Question Date</th>
                            <td>{!! date('F d, Y', strtotime($askquestion->questionDate)) !!} </td>
                        </tr>
                        <tr>
                            <th>Tags</th>
                            <td>
                                @if($askquestion->askQuestionTagIds) 
                                    @foreach( $tags as $key1 => $item1 )
                                        <span class="badge badge-info">{{ $item1->name }} </span>
                                    @endforeach
                                @else 
                                    <span class="badge badge-warning">Not Updated yet</span>
                                @endif 
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if( $askquestion->status == '1' )
                                    <span class="label label-success">Active</span>
                                @else
                                    <span class="label label-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Total Answer</th>
                            <td>
                                <span class="badge badge-warning">{{$askquestion->totalAnswerCount}}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Total Comments</th>
                            <td>
                                <span class="badge badge-info">{{$askquestion->totalCommentsCount}}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Analytics</th>
                            <td>
                                <span class="label label-warning"><i class="fa fa-thumbs-up"></i> {{$askquestion->likes}}</span>
                                <span class="label label-info"><i class="fa fa-eye"></i> {{$askquestion->views}}</span>
                                <span class="label label-success"><i class="fa fa-share-alt "></i> {{$askquestion->share}}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Question Added By</th>
                            <td>
                                @if($askquestion->userID)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/users', $askquestion->userID) }}" @endif>{{ $askquestion->firstname }} {{ $askquestion->lastname}} (ID:- {{ $askquestion->userID}}) |  Date & Time:-  {{ $askquestion->questionDate}} </a></a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($askquestion->eUserId)
                                <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/users', $askquestion->eUserId) }}" @endif>{{ $askquestion->employeeFirstname }} {{ $askquestion->employeeMiddlename}} {{ $askquestion->employeeLastname}} (ID:- {{ $askquestion->eUserId}}) | Date & Time:-  {{ $askquestion->updated_at}} </a></a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>                        
                </table>
                @foreach($askQuestionAnswersObj as $key1 => $item1)
                <div class="row">
                    <div class="col-lg-12 margin-top20">
                        <div class="panel panel-warning">
                            <div class="panel-heading">
                                <i class="fa fa-book"></i> Answer {{$key1+1}}  
                                <span class="pull-right">
                                    <label>Date : {{ date('d F Y h:s a', strtotime($item1->answerDate)) }}</label> 
                                    @if(Auth::check())
                                        @if(Auth::user()->userrole_id == 4)
                                            @if((isset($validateUserRoleAnswer)) && (sizeof($validateUserRoleAnswer) > 0) && ($validateUserRoleAnswer[0]->edit == '1'))
                                                <a href="javascript:void(0);" class="answerBlock_{{$item1->id}} answerEdit" answerId="{{$item1->id}}"><button type="submit" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</button></a>
                                            @endif
                                            @if((isset($validateUserRoleAnswer)) && (sizeof($validateUserRoleAnswer) > 0) && ($validateUserRoleAnswer[0]->delete == '1'))
                                                <a href="/delete-ask/question-answer/{{$askquestion->id}}/{{$item1->id}}"><button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</button></a> 
                                            @endif
                                        @else
                                            <a href="javascript:void(0);" class="answerBlock_{{$item1->id}} answerEdit" answerId="{{$item1->id}}"><button type="submit" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</button></a> 
                                            <a href="/delete-ask/question-answer/{{$askquestion->id}}/{{$item1->id}}"><button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</button></a> 
                                        @endif
                                    @endif
                                </span>
                                <div class="checkbox checkbox-primary">
                                    <input class="isApprovedAnswer" type="checkbox" id="{{ $item1->id }}" name="isApprovedAnswer" @if( $item1->status == 1) checked="" @endif>
                                    <label>
                                        @if($item1->status == 1)
                                            <span class="label label-success isApprovedAnswerEnabled{{ $item1->id }}">Approved</span>
                                        @else
                                            <span class="label label-danger isApprovedAnswerDisabled{{ $item1->id }}">Disapproved</span>
                                        @endif
                                        <span class="label label-success hide isApprovedAnswerEnabled1{{ $item1->id }}">Approved</span>
                                        <span class="label label-danger hide isApprovedAnswerDisabled1{{ $item1->id }}">Disapproved</span>
                                    </label>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="displayanswer_{{$item1->id}}">Answer :- {!! $item1->answer !!}</label>
                                        <div class="answerEditBlock_{{$item1->id}} hide"> 
                                            <form class="margin-top20" method="post" action="/administrator/update/ask-question-answer/{{$askquestion->id}}/{{$item1->id}}" data-parsley-validate="">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label>Answer</label>
                                                        <textarea class="form-control summernote answer" id="answer"  placeholder="Enter description." name="answer">{!! $item1->answer !!}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group text-center">
                                                    <button type="submit" class="btn btn-warning fontMontserrat fontsize-15 pt-2 pb-2 submitBtn" data-loading-text="Please wait...">Update Answer</button>
                                                </div>
                                            </form>
                                        </div>
                                        <br>
                                        @foreach($item1->askQuestionAnswerCommentsObj as $key2 => $item2)
                                        <div class="row">
                                            <div class="col-lg-12 margin-top10">
                                                <div class="panel panel-info">
                                                    <div class="panel-heading">
                                                        <i class="fa fa-comments"></i> Comments {{$key2+1}} 
                                                        <span class="pull-right">
                                                            <label>Date : {{ date('d F Y h:s a', strtotime($item2->answerDate)) }}</label>
                                                            @if(Auth::check())
                                                                @if(Auth::user()->userrole_id == 4)
                                                                    @if((isset($validateUserRoleComment)) && (sizeof($validateUserRoleComment) > 0) && ($validateUserRoleComment[0]->edit == '1'))
                                                                        <a href="javascript:void(0);" class="answerCommentBlock_{{$item1->id}}_{{$item2->id}} answerCommentEdit" answerId="{{$item1->id}}" commentId="{{$item2->id}}"><button type="submit" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> Edit</button></a>
                                                                    @endif
                                                                    @if((isset($validateUserRoleComment)) && (sizeof($validateUserRoleComment) > 0) && ($validateUserRoleComment[0]->delete == '1'))
                                                                        <a href="/delete-ask/question-answer-comments/{{$askquestion->id}}/{{$item1->id}}/{{$item2->id}}"><button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</button></a>
                                                                    @endif
                                                                @else
                                                                    <a href="javascript:void(0);" class="answerCommentBlock_{{$item1->id}}_{{$item2->id}} answerCommentEdit" answerId="{{$item1->id}}" commentId="{{$item2->id}}"><button type="submit" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> Edit</button></a> 
                                                                    <a href="/delete-ask/question-answer-comments/{{$askquestion->id}}/{{$item1->id}}/{{$item2->id}}"><button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</button></a> 
                                                                @endif
                                                            @endif
                                                             
                                                        </span>
                                                        <div class="checkbox checkbox-primary">
                                                            <input class="isApprovedComment" type="checkbox" id="{{ $item2->id }}" name="isApprovedComment" @if( $item2->status == 1) checked="" @endif>
                                                            <label>
                                                                @if($item2->status == 1)
                                                                    <span class="label label-success isApprovedCommentEnabled{{ $item2->id }}">Approved</span>
                                                                @else
                                                                    <span class="label label-danger isApprovedCommentDisabled{{ $item2->id }}">Disapproved</span>
                                                                @endif
                                                                <span class="label label-success hide isApprovedCommentEnabled1{{ $item2->id }}">Approved</span>
                                                                <span class="label label-danger hide isApprovedCommentDisabled1{{ $item2->id }}">Disapproved</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label class="displayanswercomment__{{$item1->id}}_{{$item2->id}}">Comments :- {!! $item2->replyanswer !!}</label>
                                                                <div class="answerCommentEditBlock__{{$item1->id}}_{{$item2->id}} hide"> 
                                                                    <form class="margin-top20" method="post" action="/administrator/update/ask-question-answer-comment/{{$askquestion->id}}/{{$item1->id}}/{{$item2->id}}" data-parsley-validate="">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <label>Comment</label>
                                                                                <textarea class="form-control summernote replyanswer" id="replyanswer"  placeholder="Enter description." name="replyanswer">{!! $item2->replyanswer !!}</textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group text-center">
                                                                            <button type="submit" class="btn btn-warning fontMontserrat fontsize-15 pt-2 pb-2 submitBtn" data-loading-text="Please wait...">Update Comment</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="{{$commentBlockStatus}}">
                                <form class="margin-top20" method="post" action="/add/ask-question-answer-comment/{{$askquestion->id}}/{{$item1->id}}" data-parsley-validate="">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Add Comments  </label>
                                            <textarea class="form-control replyanswer" id="replyanswer" placeholder="Enter description." name="replyanswer"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 text-center">
                                        <div class="form-group margin-top20">
                                            <button type="submit" class="btn btn-info fontMontserrat fontsize-15 pt-2 pb-2 submitBtn" data-loading-text="Please wait...">Submit Comment</button>
                                        </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="row {{$answerBlockStatus}}">
                    <div class="col-md-12"> 
                        <form class="margin-top20" method="post" action="/add/ask-question-answer/{{$askquestion->id}}" data-parsley-validate="">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Add New Answer  </label>
                                    <textarea class="form-control summernote answer" id="answer"  placeholder="Enter description." name="answer"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12 text-center">
                                <div class="form-group margin-top20">
                                    <button type="submit" class="btn btn-warning fontMontserrat fontsize-15 pt-2 pb-2 submitBtn" data-loading-text="Please wait...">Submit Answer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
    jQuery('.answerEdit').click(function(e){
        var answerId = $(this).attr("answerId");
        var answerBlock = '.answerEditBlock_'+$(this).attr("answerId");
        $(answerBlock).removeClass('hide');
        var answerBlockHide = '.displayanswer_'+$(this).attr("answerId");
        $(answerBlockHide).addClass('hide');
    });

    jQuery('.answerCommentEdit').click(function(e){
        var answerId = $(this).attr("answerId");
        var commentId = $(this).attr("commentId");
        var answerCommentBlock = '.answerCommentEditBlock__'+answerId+'_'+commentId;
        $(answerCommentBlock).removeClass('hide');
        var answerCommentBlockHide = '.displayanswercomment__'+answerId+'_'+commentId;
        $(answerCommentBlockHide).addClass('hide');
    });
</script>

<script type="text/javascript">
$(document).ready(function(){
    $('.isApprovedAnswer').on('click', function(){
        var id              = $(this).attr('id');
        var currentStatus   = 0;
        if($(this).prop("checked") == true){
            currentStatus   = 1;
        }

        if (currentStatus == 1) {
            $('.isApprovedAnswerEnabled'+id).addClass('hide');
            $('.isApprovedAnswerDisabled'+id).addClass('hide');
            $('.isApprovedAnswerEnabled1'+id).removeClass('hide');
            $('.isApprovedAnswerDisabled1'+id).addClass('hide');
        }else if(currentStatus == 0){
            $('.isApprovedAnswerEnabled'+id).addClass('hide');
            $('.isApprovedAnswerDisabled'+id).addClass('hide');
            $('.isApprovedAnswerDisabled1'+id).removeClass('hide');
            $('.isApprovedAnswerEnabled1'+id).addClass('hide');
        }

        $.ajax({
            type: "POST",
            url: "{{ URL::to('administrator/annwer/status') }}",
            data: {id: id,currentStatus:currentStatus},
            success: function(data){
                if(data.code == 200){
                    toastr.success("Answer status updated successfully.");
                }
            }
        });
    });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
    $('.isApprovedComment').on('click', function(){
        var id              = $(this).attr('id');
        var currentStatus   = 0;
        if($(this).prop("checked") == true){
            currentStatus   = 1;
        }

        if (currentStatus == 1) {
            $('.isApprovedCommentEnabled'+id).addClass('hide');
            $('.isApprovedCommentDisabled'+id).addClass('hide');
            $('.isApprovedCommentEnabled1'+id).removeClass('hide');
            $('.isApprovedCommentDisabled1'+id).addClass('hide');
        }else if(currentStatus == 0){
            $('.isApprovedCommentEnabled'+id).addClass('hide');
            $('.isApprovedCommentDisabled'+id).addClass('hide');
            $('.isApprovedCommentDisabled1'+id).removeClass('hide');
            $('.isApprovedCommentEnabled1'+id).addClass('hide');
        }

        $.ajax({
            type: "POST",
            url: "{{ URL::to('administrator/comment/status') }}",
            data: {id: id,currentStatus:currentStatus},
            success: function(data){
                if(data.code == 200){
                    toastr.success("Comment status updated successfully.");
                }
            }
        });
    });
});
</script>
@endsection
