@extends('layouts.mainlayout')

@section('content')



<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

          

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="home">Home</a></li>

              <li class="breadcrumb-item active">Add Staff</li>

            </ol>

          </div>

        </div>

      </div><!-- /.container-fluid -->

    </section>

  

    @if(session('success'))

    <h3 style="margin-left: 19px;color: green;">{{session('success')}}</h3>

    @endif



    <!-- Main content -->

    <section class="content">

      <div class="container-fluid">

        <div class="row">

          <div class="col-12">

           

            <!-- /.card -->



            <div class="card">

              <div class="card-header">

                <h3 class="card-title">Staff</h3>

                <p align="right">

               

                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Staff</button>

              
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



<form method="POST" action="{{url('staffinsert')}}" enctype="multipart/form-data">



@csrf



<div class="modal-dialog modal-lg" role="document" style="width:80%;">



<div class="modal-content">



<div class="modal-header">



<h5 class="modal-title" id="exampleModalLabel">Add Staff</h5>



<button type="button" class="close" data-dismiss="modal" aria-label="Close">



<span aria-hidden="true">&times;</span>



</button>



</div>



<div class="modal-body row">






<div class="form-group col-sm-6">



<label class="exampleModalLabel">Staff Name</label>



<input class="form-control" name="staff_name" placeholder="Enter Name" required>


</div>
<div class="form-group col-sm-6">



<label class="exampleModalLabel">Employee Id</label>



<input type="text" class="form-control" name="emp_id" placeholder="Enter Employee Id" required>


</div>
<div class="form-group col-sm-6">



<label class="exampleModalLabel">Designation</label>



<input type="text" class="form-control" name="designation" placeholder="Enter Designation" required>


</div>
<div class="form-group col-sm-6">



<label class="exampleModalLabel">Date of Birth</label>



<input type="date" class="form-control" name="dob" placeholder="Enter date of birth" required max="<?php echo date('Y-m-d'); ?>">


</div>
<div class="form-group col-sm-6">



<label class="exampleModalLabel">Blood Group</label>



<input class="form-control" name="blood_group" placeholder="Enter Blood Group" required>


</div>


<div class="form-group col-sm-6">



<label class="exampleModalLabel">Phone Number</label>



<input class="form-control" name="phone_number" placeholder="Enter Phone Number" required>


</div>
<div class="form-group col-sm-6">
        <label class="exampleModalLabel">Email</label>
        <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
        <small id="emailHelp" class="form-text"><b>Please enter a valid email with the domain @example.com.</b></small>
    </div>

    <div class="form-group col-sm-6">
    <label class="exampleModalLabel">Password</label>
    <input type="password" class="form-control" name="password" placeholder="Enter Password" required pattern=".{8,}" title="Password must be at least 8 characters long">
    <small id="passwordHelp" class="form-text"><b>Password must be at least 8 characters long.</b></small>
</div>


    <div class="form-group col-sm-6">



<label class="exampleModalLabel">Joining Date</label>



<input type="date" class="form-control" name="j_date" placeholder="Enter Joining date" required>


</div>


<div class="form-group col-sm-6">



<label class="exampleModalLabel">Salary Mode</label>


<select name="mode" class="form-control" required>

<option value="3">Select Salary Mode</option>
<option value="0">Probation</option>
<option value="1">After Probation</option>

</select>


</div>


<div class="form-group col-sm-6">



<label class="exampleModalLabel">Probation Salary</label>



<input type="text" class="form-control" name="p_salary" placeholder="Enter Probation Salary" required>


</div>
<div class="form-group col-sm-6">



<label class="exampleModalLabel">After Probation Salary</label>



<input type="text" class="form-control" name="a_salary" placeholder="Enter After Probation Salary" required>


</div>

<div class="form-group col-sm-6">



<label class="exampleModalLabel">PF Account Deatails</label>



<input type="text" class="form-control" name="uan" placeholder="Enter Universal Account Number" required>


</div>


</div>



<div class="modal-footer">



<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>



<button type="submit" name="submit" class="btn btn-primary">Add</button>



</div>



</div>



</div>



</form>



</div>
              

                </p>

               

              </div>
          

           





   <div class="card-body">



<table id="example1" class="table table-bordered table-striped">



   <thead>



      <tr>

      <th>id</th>

<th>Staff Name</th>

<th>Employee ID</th>
<th>Designation</th>
<th>Date of Birth</th>
<th>Blood Group</th>
<th>Email</th>
<th>Joining Date</th>
<th>Phone Number</th>

<th>Salary Mode</th>
<th>Probation</th>
<th>After Probation Salary</th>
<th>PF Details</th>
<th>Action</th>
  

       

      </tr>



   </thead>



   <tbody>



      @php 



      $i=1;



      @endphp



     


      @foreach($crr as $key)
<tr>
<td>{{ $i }}</td>
<td>{{ $key->name }}</td>
<td>{{ $key->employee_id }}</td>
<td>{{ $key->designation_id }}</td>
<td>{{ $key->dob }}</td>

<td>{{ $key->blood_group }}</td>
<td>{{ $key->email }}</td>
<td>{{ $key->joining_date}}</td>
<td>{{ $key->phone }}</td>
<td>
  
    @if($key->salary_mode==0) Probation @else   After Probation @endif

</td>
<td>{{ $key->p_salary}}</td>
<td>{{ $key->ap_salary}}</td>
<td>{{ $key->ua_number}}</td>










          <td>



          <i class="fa fa-edit edit_staff" aria-hidden="true" data-toggle="modal" data-id="{{ $key->id }}"></i>
  <a href="{{url('staffdelete')}}/{{ $key->id }}"><i class="fa fa-trash delete_banner text-danger"  aria-hidden="true"  data-id="{{$key->id}}"></i></a>

           




         </td>



      </tr>



      @php 



      $i++;



      @endphp



      @endforeach



   </tbody>



   <tfoot>



      <tr>


      <th>id</th>

<th>Staff Name</th>

<th>Employee ID</th>
<th>Designation</th>
<th>Date of Birth</th>
<th>Blood Group</th>
<th>Email</th>
<th>Joining Date</th>
<th>Phone Number</th>

<th>Salary Mode</th>
<th>Probation</th>
<th>After Probation Salary</th>
<th>PF Details</th>
<th>Action</th>
  

       
      </tr>



   </tfoot>



</table>


                


				
                <div class="modal" id="editstaff_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Staff</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{url('staffedit')}}" enctype="multipart/form-data" name="staffedit">

@csrf
      <div class="modal-body row">


      <div class="form-group col-sm-6">

<input type="hidden" name="id" id="staff_id">



<label class="exampleModalLabel">Staff Name</label>



<input class="form-control" name="staff_name" id="staff_name" placeholder="Enter Name" required>


</div>
<div class="form-group col-sm-6">



<label class="exampleModalLabel">Employee Id</label>



<input type="text" class="form-control" name="emp_id" id="emp_id" placeholder="Enter Employee Id" required>


</div>
<div class="form-group col-sm-6">



<label class="exampleModalLabel">Designation</label>



<input type="text" class="form-control" name="designation" id="designation" placeholder="Enter Designation" required>


</div>
<div class="form-group col-sm-6">



<label class="exampleModalLabel">Date of Birth</label>



<input type="date" class="form-control" name="dob" id="dob" placeholder="Enter date of birth" required max="<?php echo date('Y-m-d'); ?>">


</div>
<div class="form-group col-sm-6">



<label class="exampleModalLabel">Blood Group</label>



<input class="form-control" name="blood_group" id="blood_group" placeholder="Enter Blood Group" required>


</div>


<div class="form-group col-sm-6">



<label class="exampleModalLabel">Phone Number</label>



<input class="form-control" name="phone_number" id="phone_number" placeholder="Enter Phone Number" required>


</div>


    <div class="form-group col-sm-6">



<label class="exampleModalLabel">Joining Date</label>



<input type="date" class="form-control" name="j_date" id="j_date" placeholder="Enter Joining date" required>


</div>


<div class="form-group col-sm-6">



<label class="exampleModalLabel">Salary Mode</label>


<select name="mode" id="mode" class="form-control" required>

<option value="3">Select Salary Mode</option>
<option value="0">Probation</option>
<option value="1">After Probation</option>

</select>


</div>


<div class="form-group col-sm-6">



<label class="exampleModalLabel">Probation Salary</label>



<input type="text" class="form-control" name="p_salary" id="p_salary" placeholder="Enter Probation Salary" required>


</div>
<div class="form-group col-sm-6">



<label class="exampleModalLabel">After Probation Salary</label>



<input type="text" class="form-control" name="a_salary" id="a_salary" placeholder="Enter After Probation Salary" required>


</div>
<div class="form-group col-sm-6">



<label class="exampleModalLabel">PF Account Deatails</label>



<input type="text" class="form-control" name="uan" id="uan" placeholder="Enter Universal Account Number" required>


</div>

</div>



<div class="modal-footer">



<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>



<button type="submit" name="submit" class="btn btn-primary">Add</button>



</div>


    </div>
  </div>
</div>

              </div>

              <!-- /.card-body -->

            </div>

            <!-- /.card -->

          </div>

          <!-- /.col -->

        </div>

        <!-- /.row -->

      </div>

      <!-- /.container-fluid -->

    </section>

    <!-- /.content -->

  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
        var phoneInput = document.querySelector('input[name="phone_number"]');

        phoneInput.addEventListener('input', function () {
            var value = phoneInput.value;

            // Remove non-numeric characters
            var numericValue = value.replace(/\D/g, '');

            // Limit to 10 digits
            numericValue = numericValue.substring(0, 10);

            // Update the input value with the cleaned numeric value
            phoneInput.value = numericValue;

            if (/[^\d]/.test(value) && value !== '') {
                alert('Please enter a valid numeric phone number.');
                phoneInput.value = ''; // Clear the input if non-numeric characters are present
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var dobInput = document.querySelector('input[name="dob"]');
        
        // Calculate the minimum date for an 18-year-old
        var minDate = new Date();
        minDate.setFullYear(minDate.getFullYear() - 18);
        
        // Format the date in YYYY-MM-DD format
        var formattedMinDate = minDate.toISOString().split('T')[0];

        // Set the max attribute to restrict future dates
        dobInput.max = formattedMinDate;
    });
</script>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        var emailInput = document.querySelector('input[name="email"]');
        var emailHelp = document.getElementById('emailHelp');

        emailInput.addEventListener('input', function () {
            var emailValue = emailInput.value.toLowerCase();
            
            // Check if the email has a valid format
            if (!/^[\w.%+-]+@[\w.-]+\.[a-zA-Z]{2,}$/.test(emailValue) && emailValue !== '') {
                emailInput.setCustomValidity('Please enter a valid email address.');
                emailHelp.style.color = 'red';
            } else {
                emailInput.setCustomValidity('');
                emailHelp.style.color = 'inherit';
            }
        });
    });
</script>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  $(document).ready(function() {
    $('input[name="p_salary"],input[name="a_salary"],input[name="phone_number"],input[name="emp_id"]').on('keyup change', function() {
      var value = $(this).val();
      if (isNaN(value) && value !== '') {
        alert('Please enter a valid number.');
        $(this).val(''); // Clear the input if not a number
      }
    });
  });
</script>

<!-- Include Toastr CSS and JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Your Laravel Blade View Content -->

@if(Session::has('success'))
    <script>
        toastr.success('{{ Session::get('success') }}');
    </script>
@endif

@if(Session::has('error'))
    <script>
        toastr.error('{{ Session::get('error') }}');
    </script>
@endif

  @endsection