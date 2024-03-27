<!-- resources/views/attendancedetails.blade.php -->

@extends('layouts.mainlayout')

@section('content')
<style>
        /* Add some basic styling to align elements in the same row */
        form {
            display: flex;
            align-items: center;
        }

        /* Add margin to create some space between the elements */
        input, button {
            margin-right: 10px;
        }
    </style>
    <div class="content-wrapper">
        <section class="content-header">
            <!-- Add your header content here -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Attendance Details</h3>
                            </div>
                            <div class="card-body">
                            <form method="POST" action="{{url('attendancedetails')}}" >
                                @csrf
                                
 
                                <input type="date" class="form-control" name="date" style="width:20%;">
                               <button type="submit" class="btn btn-sm btn-success">FILTER</button>
                                </form>
                                <table class="table table-bordered table-striped">
                                
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Date</th>
                                            <th>Staff Name</th>
                                            <th>Status</th>
                                            <th>Day Type</th>
                                            <th>Action</th>
                                            <!-- Add other fields as needed -->
                                        </tr>
                                    </thead>
                                    <tbody id="attendance">
                                    @foreach($attendances as $key)
                                        <tr>
                                            <td>{{ $key->id }}</td>
                                            <td>{{ date('d-m-Y', strtotime($key->date))  }}</td>
                                            <td>{{ optional($key->staff)->name ?? '' }}</td>
                                            <td>{{ $key->status_name }}</td>
                                            <td>{{ $key->day_type_name }}</td>
                                            <td>
                                                <i class="fa fa-edit edit_attendance" aria-hidden="true" data-toggle="modal"  data-id="{{ $key->id }}" data-status="{{ $key->status }}" data-day-type="{{ $key->day_type }}"></i>
                                            </td>
                                            <!-- Add other fields as needed -->
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <!-- Edit Attendance Modal -->
                                <div class="modal" id="editattendance_modal" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Attendance</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="{{url('attendanceedit')}}" enctype="multipart/form-data" name="attendanceedit">
                                                @csrf
                                                <div class="modal-body row">
                                                    <input type="hidden" name="id" id="attend_id">
                                                    
                                                    <div class="form-group col-sm-6">
                                                        <label class="exampleModalLabel">Status</label>
                                                        <select class="form-control" name="status" id="edit_status" required>
                                                            <option value="1">Full Day</option>
                                                            <option value="2">Half Day</option>
                                                            <option value="0">Absent</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label class="exampleModalLabel">Day Type</label>
                                                        <select class="form-control" name="day_type" id="day_type" required>
                                                        <option value="0" >Select</option>
                                                        <option value="1" >Morning</option>
        <option value="2" >Afternoon</option>
                                                        </select>
                                                    </div>
                                                    <!-- Add other form fields as needed -->
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- ... (existing code) -->

    <!-- Ensure jQuery is included -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Your existing HTML content -->

<script>
    $(document).ready(function () {
        // Add a change event listener to the "Status" dropdown
        $('#edit_status').change(function () {
            // Get the selected value
            var selectedValue = $(this).val();
            
            // Check if the selected status is "Full Day" or "Absent"
            if (selectedValue == 1 || selectedValue == 0) {
                // If yes, set the "Day Type" dropdown to the default value ("Select")
                $('#day_type').val(0);
            }
        });
    });
</script>


@endsection
