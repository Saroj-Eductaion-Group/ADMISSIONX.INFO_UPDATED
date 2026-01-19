
<table>
  <tbody>
    <tr>
      <th>Id</th>
      <th>College Name</th>
      <th>College Registered Email </th>
      <th>College Phone Number</th>
      <th>Country</th>
      <th>State</th>
      <th>City</th>
      <th>Street Address</th>
      <th>Contact Person</th> 
      <th>Contact Person Email</th>
      <th>Contact Person Mobile </th>
      <th>University Name</th>
      <th>No. Of Times Advertising Is Taken</th>
      <th>No. Of Accepted Applications</th>
      <th>No. Of Rejected Applications</th>
      <th>No. Of Pending Applications</th>
    </tr>
    @foreach($collegeProfileDataObj as $item)
    <tr>
      <td>{{$item->collegeprofileID}}</td>
      <td>{{$item->firstname}}</td>
      <td>{{$item->registerEmail}}</td>
      <td>{{$item->registerPhone}}</td>
      <td>{{$item->countryName}}</td>
      <td>{{$item->stateName}}</td> 
      <td>{{$item->cityName}}</td>
      <td>{{$item->addressName}}, {{$item->address1}}, {{$item->address2}}, {{$item->postalcode}}</td>
      <td>{{$item->contactpersonname}}</td>
      <td>{{$item->contactpersonemail}}</td>
      <td>{{$item->contactpersonnumber}}</td>
      <td>{{$item->universityName}}</td>
      <td></td> 
      <td></td> 
      <td></td>
      <td></td>
    </tr>
    @endforeach
  </tbody>
</table>
          
