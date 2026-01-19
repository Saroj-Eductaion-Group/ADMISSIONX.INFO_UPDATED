<style type="text/css">
    table > tr >th,td {
    border: 2px solid #000000;
    wrap-text: true;
}
.textCenter {
    vertical-align: middle;
    text-align: center;
}
</style>
<table border="1" cellpadding="1" cellspacing="1" >
    <tr>
        <th style="text-align: center;">Id</th>
		<th style="text-align: center;">College Name</th>
		<th style="text-align: center;">College Registered Email </th>
		<th style="text-align: center;">College Phone Number</th>
		<th style="text-align: center;">Country</th>
		<th style="text-align: center;">State</th>
		<th style="text-align: center;">City</th>
		<th style="text-align: center;">Street Address</th>
		<th style="text-align: center;">Contact Person</th> 
		<th style="text-align: center;">Contact Person Email</th>
		<th style="text-align: center;">Contact Person Mobile </th>
		<th style="text-align: center;">University Name</th>
		<th style="text-align: center;">No. Of Times Advertising Is Taken</th>
		<th style="text-align: center;">No. Of Accepted Applications</th>
		<th style="text-align: center;">No. Of Rejected Applications</th>
		<th style="text-align: center;">No. Of Pending Applications</th>
    </tr>
    @foreach( $collegeProfileDataObj as $key => $values ) 
    	{{--*/ $totalApprovedApplication  = '0'; /*--}}
	    {{--*/ $totalPendingApplication  = '0'; /*--}}
	    {{--*/ $totalRejectApplication  = '0'; /*--}}          
        <tr>
            <td>{{ $key }}</td>
        @foreach ($values as $collegeName => $collegeNameData)
            @foreach ($collegeNameData as $collegeEmail => $colEmail)
            	@foreach ($colEmail as $collegePhone => $country)   
            		@foreach ($country as $countryName => $state)  
            			@foreach ($state as $stateName => $city)
            				@foreach ($city as $cityName => $streetAddress) 
            					@foreach ($streetAddress as $addressName => $address1)
            						@foreach ($address1 as $address1Name => $address2)  
            							@foreach ($address2 as $address2Name => $pin)  
            								@foreach ($pin as $pincode => $conPerName)   
            									@foreach ($conPerName as $conPersonName => $conPeremail)   
            										@foreach ($conPeremail as $conPersonEmail => $conPerPhone)
            											@foreach ($conPerPhone as $conPersonPhone => $uniName)
            												@foreach ($uniName as $unversityName => $applicationSta)
										                        <td>{{ $collegeName }}</td>
										                        <td>{{ $collegeEmail }}</td>
										                        <td>{{ $collegePhone }}</td>
										                        <td>{{ $countryName }}</td>
										                        <td>{{ $stateName }}</td>
										                        <td>{{ $cityName }}</td>
										                        <td>{{ $addressName }} {{ $address1Name }} {{ $address2Name }} {{ $pincode }}</td>
										                        <td>{{ $conPersonName }}</td>
										                        <td>{{ $conPersonEmail }}</td>
										                        <td>{{ $conPersonPhone }}</td>
										                        <td>{{ $unversityName }}</td>
									                        	<td></td>
										                        <td>
													                @if( !empty($applicationSta['1']) )
													                    {{ $applicationSta['1'] }}
													                @else
													                    0
													                @endif
													            </td>
													            <td>
													              	@if( !empty($applicationSta['3']) )
													                    {{ $applicationSta['3'] }}
													                @else
													                    0
													                @endif
													            </td>
													            <td>
													                @if( !empty($applicationSta['2']) )
													                    {{ $applicationSta['2'] }}
													                @else
													                    0
													                @endif
													            </td>
										                    @endforeach
										                @endforeach
										            @endforeach
										        @endforeach
										    @endforeach
										@endforeach
									@endforeach
								@endforeach
							@endforeach
		                @endforeach
                    @endforeach
                @endforeach                            
            @endforeach                               
        @endforeach 
        </tr>
    @endforeach
</table>
