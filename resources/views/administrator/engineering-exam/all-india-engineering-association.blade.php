@extends('administrator/admin-layouts.master')
@section('styles')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                     <h5>Here are the details</h5>              
                </div>

                <div class="ibox-content">
                    <div class="row">
                        
                        <div class="col-md-12 text-right">   
                            <!-- <a href="javascript:void(0);" class="btn btn-info exportToExcel hide">Export</a>   -->   
                            <a href="javascript:void(0);" class="btn btn-danger resetfilter hide">Reset Filter</a>     
                            <a href="javascript:void(0);" class="btn btn-primary filterout">Filter</a>
                        </div>
                    </div>
                    <div class="slideDown" style="visibility:hidden">
                         <div class="hr-line-dashed"></div>    
                        <form action="/administrator/all-india-engineer-association" method="GET" class="form-horizontal" data-parsley-validate>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h4 for="usr">Student Name<span class="pull-right"><a href="javascript:void(0);" id="refresh1" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <input type="text" class="form-control studentname" name="student" placeholder="Enter student name here" data-parsley-error-message="Please enter student name" data-parsley-trigger="change"  value="{{ Request::get('student') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <h4 for="usr">Email Address<span class="pull-right"><a href="javascript:void(0);" id="refresh2" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <input type="text" class="form-control userEmailAddress" name="email" placeholder="Enter user email address here" data-parsley-error-message="Please enter valid email address" data-parsley-trigger="change" data-parsley-type="email" value="{{ Request::get('email') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <h4 for="usr">Phone Number<span class="pull-right"><a href="javascript:void(0);" id="refresh3" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <input type="text" class="form-control phoneNumber" name="phone" data-parsley-error-message="Please enter valid phone number" data-parsley-trigger="change" data-parsley-type="number" placeholder="Enter enter phone number here"  value="{{ Request::get('phone') }}">
                                        </div>        
                                        <div class="col-md-3">
                                            <h4 for="usr">City Name<span class="pull-right"><a href="javascript:void(0);" id="refresh4" class="hide"><i class="fa fa-remove"></i></a></span></h4>
                                            <select name="city" class="form-control chosen-select cityName">
                                                <option selected="" disabled="">City</option>
                                                @if( $getAllCityObj )
                                                    @foreach($getAllCityObj as $item)
                                                        <option value="{{ $item->name }}" @if(Request::get('city') == $item->name) selected="" @endif>{{ $item->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div> 
                                    </div>  
                                    <hr>    
                                    <div class="row">                              
                                        <div class="col-md-12 text-right">      
                                            <a href="{{ URL::to('/administrator/all-india-engineer-association') }}" class="btn btn-default btn-sm">Close</a>
                                            <button class="btn btn-primary btn-sm">Search</button>                                            
                                        </div>  
                                    </div>
                                    
                                </div>  
                            </div>
                        </form>
                    </div>  
                    <div class="hr-line-dashed"></div>
                    <div class=""> <!-- table-responsive -->
                        <label class="pull-right hide returnHide">Total Result :- <span class="" id="returnCountResult"></span></label>
                        @if( $engineeringexam == '0' )
                            <input type="text" class="result-zero hide" value="{{ $engineeringexam }}">
                            <h2 class="message-no-match center-block">No Result Found!</h2>
                        @else
                        <table class="table table-bordered" >
                            <thead class="thead">
                                <tr>
                                    <th>ID</th>
                                    <th>Application ID</th>
                                    <th>Student Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Category</th>
                                    <th>Gender</th>
                                    <th>Nationality</th>
                                    <th>Center Choice</th>
                                    <th>Apply Date</th>
                                    <th>Amount</th>
                                    <th>Payment Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                            @foreach($engineeringexam as $item)
                                <tr class="gradeX">
                                    <td><a href="{{ url('administrator/engineering-exam', $item->id) }}">{{ $item->id }}</a></td>
                                    <td><a href="{{ url('administrator/engineering-exam', $item->id) }}">{{ $item->applicationId }}</a></td>
                                    <td><a href="{{ url('administrator/engineering-exam', $item->id) }}">{{ $item->title }} {{ $item->firstname }} {{ $item->middlename }} {{ $item->lastname }}</a></td>
                                    <td>{{ $item->email }} </td>
                                    <td>{{ $item->phone }} </td>
                                    <td>{{ $item->category }} </td>
                                    <td>{{ $item->gender }} </td>
                                    <td>{{ $item->nationality }} </td>
                                    <td>
                                        <b>First :-</b> @if( !empty($item->choice1st) ) {{ $item->choice1st }} @endif <br>
                                        <b>Second :-</b> @if( !empty($item->choice2nd) ) {{ $item->choice2nd }} @endif <br>
                                        <b>Third:-</b> @if( !empty($item->choice3rd) ) {{ $item->choice3rd }} @endif
                                    </td>
                                    <td>{{ $item->date }} </td>
                                    <td>{{ $item->amount }} </td>
                                    <td>{{ $item->paymentstatusName }} </td>
                                    <td>
                                        <a href="{{ url('administrator/engineering-exam/' . $item->id ) }}">
                                            <button type="submit" class="btn btn-primary btn-xs">View</button>
                                        </a>
                                    </td>   
                                </tr>
                            @endforeach
                           </tbody>
                        </table>
                        <div class="row indexPagination">
                            <div class="col-md-12">
                                <div class="pull-right custom-pagination">{!! $engineeringexam->appends(\Input::except('page'))->render() !!}</div>
                            </div>
                        </div>
                        @endif
                        <input type="text" class="totalReturnRow hide" value="">
                        <input type="text" class="prevTotalReturnRow hide" value="">
                        <input type="text" class="nextTotalReturnRow hide" value="">

                        <div class="spiner-example hide text-center">
                            <div class="sk-spinner sk-spinner-three-bounce">
                                <div class="sk-bounce1"></div>
                                <div class="sk-bounce2"></div>
                                <div class="sk-bounce3"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                                <p class="message-no-match center-block label label-danger hide">No Match Found!</p>
                            </div>
                        </div>
                        <div class="row numPage hide text-right">
                            <div class="col-md-12 pull-right">
                                <ul class="pagination"><li><span class="currentCounter"></span></li></ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
   <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {
            
            //Activate Chosen for Select
             $(".chosen-select").chosen({
                placeholder_text_single: "Select an option",
                no_results_text: "Oops, nothing found!"
            });
            $('.slideDown').hide();
            $('.filterout').on('click',function(){
                $(".slideDown").toggle();
                $(".slideDown").css('visibility', 'visible');
                $(".resetfilter").addClass('hide');
                $(".exportToExcel").addClass('hide');
            });
            var resultZeroValue = $('.result-zero').val();
            if( resultZeroValue == '0' ){
                $('.filterout').addClass('hide');
            }

            $('.studentname').on('blur',function(){
                $('#refresh1').removeClass('hide');
            });
            $('#refresh1').on('click',function(e){
                $('.studentname').val('');
                $('#refresh1').addClass('hide');
            });

            $('.userEmailAddress').on('blur',function(){
                $('#refresh2').removeClass('hide');
            });
            $('#refresh2').on('click',function(e){
                $('.userEmailAddress').val('');
                $('#refresh2').addClass('hide');
            });

            $('.phoneNumber').on('blur',function(){
                $('#refresh3').removeClass('hide');
            });
            $('#refresh3').on('click',function(e){
                $('.phoneNumber').val('');
                $('#refresh3').addClass('hide');
            });

            $('.cityName').on('change',function(){
                $('#refresh4').removeClass('hide');
            });
            $('#refresh4').on('click',function(e){
                $('.cityName').val('').trigger('chosen:updated');
                $('#refresh4').addClass('hide');
            });
        });  
    </script>
    @endsection








