@extends('layouts.mainlayout')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home">Home</a></li>
                        <li class="breadcrumb-item active">Attendance</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    @if(session('success'))
    <h3 style="margin-left: 19px;color: green;">{{session('success')}}</h3>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Staff</h3>
                        </div>
                        <div class="card-body">
                        <button type="button" id="showDetailsBtn" class="btn btn-success float-right" onclick="window.location.href='attendancedetails'">Show Saved Details</button>


                        <form method="POST" action="{{url('attendanceinsert')}}" >
                        @csrf

                        <input type="date" class="form-control" name="date" style="width:20%;">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Staff Name</th>
                                        <th>Status</th>
                                        <th>Day Type</th>
                                        <!-- <th>Punchin</th>
                                        <th>Punch Out</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach($mark as $key)
                                    <tr>

                                        <td>{{ $i }}
                                            <input type="hidden" name="staffid[]" value="{{$key->id}}">
                                        </td>
                                        <td>{{$key->name}}</td>
                                        <td>
    <select name="status[]" id="status_{{$key->id}}" class="form-control status_click" data-id="{{$key->id}}" >
        
        <option value="1" >Full Day</option>
        <option value="2" >Half Day</option>
        <option value="0" >Absent</option>
    </select>
</td>

<td>
    <select name="day_type[]" id="day_type_{{$key->id}}" class="form-control"  >
    <option value="0" >Select</option>
        <option value="1" >Morning</option>
        <option value="2" >Afternoon</option>
    </select>
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
                                        <th>Status</th>
                                        <th>Day Type</th>
                                        <!-- <th>Punchin</th>
                                        <th>Punch Out</th> -->
                                        <!-- <th>Date</th> -->
                                      
                                    </tr>
                                </tfoot>
                            </table>
                            <button type="submit" name="submit" class="btn btn-primary">Submit Attendance</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    $(document).ready(function () {
        // Add a change event listener to the "Status" dropdowns
        $('.status_click').change(function () {
            var id = $(this).data('id');
            var selectedValue = $(this).val();
            var dayTypeDropdown = $('#day_type_' + id);

            // Enable or disable the "Day Type" dropdown based on the selected value in "Status"
          //  dayTypeDropdown.prop('disabled', selectedValue != 2);

            // Validate for "Half Day" status
            if (selectedValue == 2 && (dayTypeDropdown.val() == null || dayTypeDropdown.val() == 0)) {
                alert('Please select a Day Type for Half Day status.');
            }
        });

        // Add a submit event listener to the form
        $('#attendanceForm').submit(function (e) {
            // Perform additional validation here if needed

            // Check if there are any "Half Day" statuses without a selected "Day Type"
            var invalidHalfDay = $('.status_click[value="2"]').filter(function () {
                var id = $(this).data('id');
                var dayTypeDropdown = $('#day_type_' + id);
                return !dayTypeDropdown.prop('disabled') && (dayTypeDropdown.val() == null || dayTypeDropdown.val() == 0);
            }).length > 0;

            if (invalidHalfDay) {
                alert('Please select a Day Type for all Half Day statuses.');
                e.preventDefault(); // Prevent form submission
            }
        });
    });
</script>


@endsection
