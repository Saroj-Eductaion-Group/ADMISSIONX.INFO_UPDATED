<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h2>Candidate Applied For All India Engineering Association Examination</h2>

	<div>
		<p>
			Candidate Name : 
			@if( !empty($dataArray['title']) )	{{ $dataArray['title'] }} @endif
			@if( !empty($dataArray['firstname']) )	{{ $dataArray['firstname'] }} @endif
			@if( !empty($dataArray['middlename']) )	{{ $dataArray['middlename'] }} @endif
			@if( !empty($dataArray['lastname']) )	{{ $dataArray['lastname'] }} @endif
		</p>
		<p>
			Email : 
			@if( !empty($dataArray['email']) )	{{ $dataArray['email'] }} @endif
		</p>
		<p>
			Phone : 
			@if( !empty($dataArray['phone']) )	{{ $dataArray['phone'] }} @endif
		</p>
		<p>
			Father's Name : 
			@if( !empty($dataArray['fathername']) )	{{ $dataArray['fathername'] }} @endif
		</p>
		<p>
			Category : 
			@if( !empty($dataArray['category']) )	{{ $dataArray['category'] }} @endif
		</p>
		<p>
			Gender : 
			@if( !empty($dataArray['gender']) )	{{ $dataArray['gender'] }} @endif
		</p>
		<p>
			Nationality : 
			@if( !empty($dataArray['nationality']) )	{{ $dataArray['nationality'] }} @endif
		</p>
		<p>
			1st Choice of Center : 
			@if( !empty($dataArray['choice1st']) )	{{ $dataArray['choice1st'] }} @endif
		</p>
		<p>
			2nd Choice of Center : 
			@if( !empty($dataArray['choice2nd']) )	{{ $dataArray['choice2nd'] }} @endif
		</p>
		<p>
			3rd Choice of Center : 
			@if( !empty($dataArray['choice3rd']) )	{{ $dataArray['choice3rd'] }} @endif
		</p>

		<p>
			Correspondence Address : @if( !empty($dataArray['firstaddress1']) )	{{ $dataArray['firstaddress1'] }} @endif @if( !empty($dataArray['firstaddress2']) )	{{ $dataArray['firstaddress2'] }} @endif @if( !empty($dataArray['firstaddress3']) )	, {{ $dataArray['firstaddress3'] }} @endif @if( !empty($dataArray['firstcity']) ) , {{ $dataArray['firstcity'] }} @endif @if( !empty($dataArray['firststate']) ) , {{ $dataArray['firststate'] }} @endif @if( !empty($dataArray['firstpincode']) ) , {{ $dataArray['firstpincode'] }} @endif @if( !empty($dataArray['firstcontact']) ) , {{ $dataArray['firstcontact'] }} @endif
		</p>
		<p>
			Permanent Address : @if( !empty($dataArray['secondaddress1']) )	{{ $dataArray['secondaddress1'] }} @endif @if( !empty($dataArray['secondaddress2']) )	{{ $dataArray['secondaddress2'] }} @endif @if( !empty($dataArray['secondaddress3']) )	, {{ $dataArray['secondaddress3'] }} @endif @if( !empty($dataArray['secondcity']) ) , {{ $dataArray['secondcity'] }} @endif @if( !empty($dataArray['secondstate']) ) , {{ $dataArray['secondstate'] }} @endif @if( !empty($dataArray['secondpincode']) ) , {{ $dataArray['secondpincode'] }} @endif @if( !empty($dataArray['secondcontact']) ) , {{ $dataArray['secondcontact'] }} @endif
		</p>

		<table border="1" cellpadding="1" cellspacing="1">
			<thead>
				<tr>
					<th>Class</th>
					<th>Board</th>
					<th>Subjects</th>
					<th>Passing Year</th>
					<th>CGPA</th>
					<th>Division</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Matriculation</td>
					<td>@if( !empty($dataArray['board1']) ) {{ $dataArray['board1'] }} @endif</td>
					<td>@if( !empty($dataArray['subject1']) ) {{ $dataArray['subject1'] }} @endif</td>
					<td>@if( !empty($dataArray['passingyr1']) ) {{ $dataArray['passingyr1'] }} @endif</td>
					<td>@if( !empty($dataArray['cgpa1']) ) {{ $dataArray['cgpa1'] }} @endif</td>
					<td>@if( !empty($dataArray['division1']) ) {{ $dataArray['division1'] }} @endif</td>
				</tr>
				<tr>
					<td>Intermediate</td>
					<td>@if( !empty($dataArray['board2']) ) {{ $dataArray['board2'] }} @endif</td>
					<td>@if( !empty($dataArray['subject2']) ) {{ $dataArray['subject2'] }} @endif</td>
					<td>@if( !empty($dataArray['passingyr2']) ) {{ $dataArray['passingyr2'] }} @endif</td>
					<td>@if( !empty($dataArray['cgpa2']) ) {{ $dataArray['cgpa2'] }} @endif</td>
					<td>@if( !empty($dataArray['division2']) ) {{ $dataArray['division2'] }} @endif</td>
				</tr>
			</tbody>
		</table>

		<p>
			Place : 
			@if( !empty($dataArray['place']) )	{{ $dataArray['place'] }} @endif
		</p>
		<p>
			Date : 
			@if( !empty($dataArray['date']) )	{{ date('d/M/Y', strtotime($dataArray['date'])) }} @endif
		</p>
	</div>
</body>
</html>