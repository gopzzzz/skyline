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
                                <h3 class="card-title">Staff Payrole</h3>
                            </div>
                            <div class="card-body">
                            <form method="POST" action="{{url('filterByMonth')}}" >
                                @csrf
                               
 
                                <input type="month" class="form-control" value="{{$month}}" name="month" style="width:20%;">
                               <button type="submit" class="btn btn-sm btn-success">FILTER</button>
                                </form>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Staff Name</th>
                                            <th>Total Present Days</th>
                                            <th>Total Half Days</th>
                                            <th>Total Leave Days</th>
                                            <th>Salary Per Day</th>
                                            <th>PF</th>
                                            <th>ESI</th>
                                            <th>DA</th>
                                            <th>Outer City Allowance</th>
                                            <th>Others</th>

                                            <th> Salary</th>
                                            <th>Total Salary</th>
                                            <th> Salary Slip</th>
                                            <!-- Add other fields as needed -->
                                        </tr>
                                    </thead>
                                    <tbody id="attendance">
                                    @foreach($stafflist as $key)

                                    @php $id=$key->id;

                                  
                                    
                                                 $pdays=DB::table('tbl_attendences')
                                                ->where('tbl_attendences.staff_id',$id)
                                                ->where('status',1)
                                                ->where(DB::raw('DATE_FORMAT(date, "%Y-%m")'), '=', $month)
                                                ->count();

                                       

                                                $hdays=DB::table('tbl_attendences')
                                                ->where('tbl_attendences.staff_id',$id)
                                                ->where(DB::raw('DATE_FORMAT(date, "%Y-%m")'), '=', $month)
                                                ->where('status',2)->count();

                                                $adays=DB::table('tbl_attendences')
                                                ->where('tbl_attendences.staff_id',$id)
                                                ->where(DB::raw('DATE_FORMAT(date, "%Y-%m")'), '=', $month)
                                                ->where('status',0)->count();

                                                 if($key->salary_mode==0){
                                                    $salary=$key->p_salary;
                                                 }else{
                                                    $salary=$key->ap_salary;
                                                 }

                                                 $other=DB::table('tbl_expenses')
                                                 ->where('staff_id',$id)
                                                 ->where('type_id','!=','001')
                                                 ->where('type_id','!=','002')
                                                 ->where(DB::raw('DATE_FORMAT(added_date, "%Y-%m")'), '=', $month)
                                                
                                                 ->sum('amount');

                                                 $da=DB::table('tbl_expenses')
                                                 ->where('staff_id',$id)
                                                 ->where('type_id','001')
                                                 ->where(DB::raw('DATE_FORMAT(added_date, "%Y-%m")'), '=', $month)
                                                
                                                 ->get();

                                                 $daSum=0;

                                                 if($da){

                                                   

                                                    foreach($da as $kda){
                                                        $daSum=($kda->amount)*($kda->days);
                                                    }
   

                                                 }

                                               


                                                 $oca=DB::table('tbl_expenses')
                                                 ->where('staff_id',$id)
                                                 ->where('type_id','002')
                                                 ->whereMonth('added_date', '=', $month)
                                                 ->get();

                                                 $ocaSum=0;
                                                 if($oca){

                                                   

                                                    foreach($oca as $koca){
                                                        $ocaSum=($koca->amount)*($koca->days);
                                                    }


                                                    }
                                                 

                                                 $total_salary= ($pdays*$salary)+($hdays*$salary/2);

                                                 $pf=$total_salary*(12/100);

                                                 $esi=$total_salary*(0.75/100);

                                                 $Finaltotal=($other+$total_salary+$ocaSum+$daSum)-($pf+$esi);



                                                 

                                               
                                                @endphp

                                                
                                               

                                                
                                        <tr>
                                            <td>{{ $key->id }}</td>
                                            <td>{{ $key->name }}</td>
                                            <td> {{$pdays}}</td>
                                            <td> {{$hdays}}</td>
                                            <td> {{$adays}}</td>
                                            <td>{{ $salary}}</td>
                                            <td>{{$pf}}</td>
                                            <td>{{$esi}}</td>
                                            <td>{{$daSum}}</td>
                                            <td>{{$ocaSum}}</td>
                                          
                                            <td>{{ $other}}</td>
                                            <td>{{$total_salary}}</td>
                                            <td>{{$Finaltotal}}</td>
                                            <td><a href="#">download</a></td>
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




@endsection
