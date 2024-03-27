@extends('layouts.mainlayout')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        #additionalColumn {
            display: none;
        }
        #additionalColumn1{
            display: none;
        }
    </style>
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

              <li class="breadcrumb-item active">Add Expense</li>

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

                <h3 class="card-title">Expense</h3>

                <p align="right">

               

                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Expense</button>

              
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



<form method="POST" action="{{url('expenseinsert')}}" enctype="multipart/form-data">



@csrf



<div class="modal-dialog modal-lg" role="document" style="width:80%;">



<div class="modal-content">



<div class="modal-header">



<h5 class="modal-title" id="exampleModalLabel">Add Expense</h5>



<button type="button" class="close" data-dismiss="modal" aria-label="Close">



<span aria-hidden="true">&times;</span>



</button>



</div>



<div class="modal-body row">
<div class="form-group col-sm-6">
    <label class="exampleModalLabel">Staff Name</label>
    <select name="staff" id="staff_name" class="form-control">
        <option value="0">Select Staff Name</option>
        @foreach($con as $staff)
            <option value="{{ $staff->id }}">{{ $staff->name }}</option>
        @endforeach
    </select>
</div>


<div class="form-group col-sm-6">
    <label class="exampleModalLabel">Expense Type</label>
    <select name="emp_type" id="emp_id" class="form-control expensetype">
        <option value="0">Select Expense Type</option>
        @foreach($condd as $type)
        <option value="{{ $type->id }}">{{ $type->type }}</option>
        @endforeach
        <option value="001">Dearness Allowance</option>
        <option value="002">Outer City Allowance</option>
    </select>
</div>

<div id="additionalColumn" class="form-group col-sm-6">
    <label class="exampleModalLabel">Days</label>
    <input type="text" class="form-control" name="days" placeholder="Enter Days" required>
</div>



<div class="form-group col-sm-6">



<label class="exampleModalLabel">Amount</label>



<input type="text" class="form-control" name="amount" placeholder="Enter Amount" required>


</div>




<div class="form-group col-sm-6">



<label class="exampleModalLabel">Remarks</label>



<textarea class="form-control" name="remark"  placeholder="Enter Remarks"></textarea>


</div>


													<div class="form-group col-sm-6">
														<label class="exampleModalLabel">Bill Print</label>
														<input type="file" class="form-control" name="billimage" accept="image/*" required>
													</div>


<div class="form-group col-sm-6">



<label class="exampleModalLabel">Date</label>



<input type="date" class="form-control" name="date" >

 
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

<th>Expense Type</th>
<th>Amount</th>
<th>Remarks</th>
<th>Bill Print</th>
<th>Date</th>

<th>Action</th>
  

       

      </tr>



   </thead>

   <tbody>



@php 



$i=1;



@endphp






@foreach($cond as $key)
<tr>
<td>{{ $i }}</td>
<td>{{ $key->name }}</td>
<td>{{ $key->type }}</td>
<td>{{ $key->amount }}</td>
<td>{{ $key->remarks }}</td>

<td><img src="{{ asset('/image/'.$key->billprint) }}" alt=""  width="200" height="100" /></td>

<td>{{ $key->added_date }}</td>












    <td>



    <i class="fa fa-edit edit_expense" aria-hidden="true" data-toggle="modal" data-id="{{ $key->id }}"></i>
<a href="{{url('expensedelete')}}/{{ $key->id }}"><i class="fa fa-trash delete_banner text-danger"  aria-hidden="true"  data-id="{{$key->id}}"></i></a>

     




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

<th>Expense Type</th>
<th>Amount</th>
<th>Remarks</th>
<th>Bill Print</th>
<th>Date</th>
<th>Action</th>
  

       
      </tr>



   </tfoot>



</table>


                


				
                <div class="modal" id="editexpense_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Expense</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{url('expenseedit')}}" enctype="multipart/form-data" name="expenseedit">

@csrf
      <div class="modal-body row">


      <div class="form-group col-sm-6">

<input type="hidden" name="id" id="expense_id">



    <label class="exampleModalLabel">Staff Name</label>
    <select name="staff" id="name" class="form-control">
        <option value="0">Select Staff Name</option>
        @foreach($con as $staff)
            <option value="{{ $staff->id }}">{{ $staff->name }}</option>
        @endforeach
    </select>
</div>



<div class="form-group col-sm-6">
    <label class="exampleModalLabel">Expense Type</label>
    <select name="emp_type" id="type" class="form-control">
        <option value="0">Select Expense Type</option>
        @foreach($condd as $type)
            <option value="{{ $type->id }}">{{ $type->type }}</option>
        @endforeach
        <option value="001">Dearness Allowance</option>
        <option value="002">Outer City Allowance</option>
    </select>
</div>
<div id="additionalColumn1" class="form-group col-sm-6">
    <label class="exampleModalLabel">Days</label>
    <input type="text" class="form-control" name="days" placeholder="Enter Days" required>
</div>

<div class="form-group col-sm-6">



<label class="exampleModalLabel">Amount</label>



<input type="text" class="form-control" name="amount" id="amount" placeholder="Enter Amount" required>


</div>
<div class="form-group col-sm-6">



<label class="exampleModalLabel">Remarks</label>



<input type="text" class="form-control" name="remark" id="remark" placeholder="Enter Remarks" required>


</div>

<div class="modal-body row">
													<div class="form-group col-sm-6">
														<label class="exampleModalLabel">Bill Print</label>
														<input type="file" name="billimage" id="billimage" accept="image/*">
													</div>
                                                  


<div class="form-group col-sm-6">



<label class="exampleModalLabel">Date</label>



<input type="date" class="form-control" name="date" id="date" required>

 
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
  
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function(){
        $('#emp_id').on('change', function(){
            var selectedValue = $(this).val();
            if(selectedValue == '001' || selectedValue == '002') {
                $('#additionalColumn').show();
            } else {
                $('#additionalColumn').hide();
            }
        });
        $('#type').on('change', function(){
            var selectedValue = $(this).val();
            if(selectedValue == '001' || selectedValue == '002') {
                $('#additionalColumn1').show();
            } else {
                $('#additionalColumn1').hide();
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  $(document).ready(function() {
    $('input[name="amount"]').on('keyup change', function() {
      var value = $(this).val();
      if (isNaN(value) && value !== '') {
        alert('Please enter a valid number.');
        $(this).val(''); // Clear the input if not a number
      }
    });
  });
</script>


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