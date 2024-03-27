<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Tbl_staffs;
use App\Models\Tbl_expenses;
use App\Models\Tbl_expsensetypes;
use App\Models\Tbl_attendences;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use DB;
use Auth;
use Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function staff()
    {
        $cr = tbl_staffs::with('user')->get();
        $role = Auth::user()->user_type;

        $crr = DB::table('tbl_staffs')
            ->leftJoin('users', 'tbl_staffs.user_id', '=', 'users.id')
            ->select('tbl_staffs.*', 'users.email')
            ->get();

        return view('staff', compact('role', 'crr', 'cr'));
    }

    public function staffinsert(Request $request)
{
    $user = new User;
    $user->name = $request->staff_name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);

    if ($user->save()) {
        $staff = new Tbl_staffs;
        $staff->name = $request->staff_name;
        $staff->employee_id = $request->emp_id;
        $staff->added_by = Auth::user()->id;
        $staff->joining_date = $request->j_date;
        $staff->designation_id = 0;
        $staff->dob = $request->dob;

        $staff->blood_group = $request->blood_group;
        $staff->phone = $request->phone_number;
        $staff->salary_mode = $request->mode;
        $staff->p_salary = $request->p_salary;
        $staff->ap_salary = $request->a_salary;
        $staff->ua_number = $request->uan;

        $staff->user_id = $user->id;

        $staff->ip_address = $request->ip();

        $staff->save();

        // Display success toast
        Session::flash('success', 'Staff Details added successfully!');
    } else {
        // Display error toast
        Session::flash('error', 'Error adding staff details. Please try again.');
    }

    return redirect('staff');
}
	
	public function staffdelete($id){
		DB::delete('delete from tbl_staffs where id = ?',[$id]);
		return redirect('staff');
	}
    public function stafffetch(Request $request){
		$id=$request->id;
		$staff=Tbl_staffs::find($id);
		print_r(json_encode($staff));
	}
	public function staffedit(Request $request)
{
    $id = $request->id;
    $staff = Tbl_staffs::find($id);

    if ($staff) {
        $staff->name = $request->staff_name;
        $staff->employee_id = $request->emp_id;
        $staff->added_by = 0;
        $staff->joining_date = $request->j_date;
        $staff->designation_id = 0;
        $staff->dob = $request->dob;
        
        $staff->blood_group = $request->blood_group;
        $staff->phone = $request->phone_number;
        $staff->salary_mode = $request->mode;
        $staff->p_salary = $request->p_salary;
        $staff->ap_salary = $request->a_salary;
        $staff->ua_number = $request->uan;
        $staff->ip_address = 0;
        $staff->save();

        // Display success toast
        Session::flash('success', 'Staff Details updated successfully!');
    } else {
        // Display error toast if the staff is not found
        Session::flash('error', 'Staff details not found. Unable to update.');
    }

    return redirect('staff');
}


    public function expensetype(){
        $exp=DB::table('tbl_expsensetypes')->get();
        $role=Auth::user()->user_type;
		return view('expensetype',compact('role','exp'));
	}
    
    public function expensetypeinsert(Request $request)
{
    $expense = new Tbl_expsensetypes;
    $expense->type = $request->types;
    $expense->ip_address = $request->ip();
    $expense->save();

    // Display success toast
    Session::flash('success', 'Expense type added successfully');

    return redirect('expensetype');
}
    public function expensetypefetch(Request $request){
		$id=$request->id;
		$expense=Tbl_expsensetypes::find($id);
		print_r(json_encode($expense));
	}
    public function expensetypeedit(Request $request){
        $id = $request->id;
        $expense = Tbl_expsensetypes::find($id);
        if (!$expense) {
            return redirect('expensetype')->with('error', 'Expense type not found');
        }
        $expense->type = $request->types;
        $expense->save();
        return redirect('expensetype');
    }
    public function expense(){
		$role=Auth::user()->user_type;
        $con=DB::table('tbl_staffs')
        ->get();
        $condd=DB::table('tbl_expsensetypes')
        ->get();
        $cond=DB::table('tbl_expenses')
        ->leftJoin('tbl_expsensetypes', 'tbl_expenses.type_id', '=', 'tbl_expsensetypes.id')
        ->leftJoin('tbl_staffs', 'tbl_expenses.staff_id', '=', 'tbl_staffs.id')

        ->select('tbl_expenses.*','tbl_expsensetypes.type','tbl_staffs.name')
        ->get();

        return view('expense',compact('role','con','condd','cond'));
    }
    public function expenseinsert(Request $request)
{
    $expense = new Tbl_expenses;
    $expense->staff_id = $request->staff;
    $expense->type_id = $request->emp_type;
    $expense->added_by = Auth::user()->id;
    $expense->amount = $request->amount;
    $expense->days = $request->days;
    $expense->remarks = $request->remark;
    $expense->added_date = $request->date;
    $expense->ip_address = $request->ip();

    if ($files = $request->file('billimage')) {
        $name = $files->getClientOriginalName();
        $files->move('image/', $name);
        $expense->billprint = $name;
    }

    $expense->save();

    // Display success toast
    Session::flash('success', 'Expense added successfully');

    return redirect('expense');
}
    public function expensedelete($id){
		DB::delete('delete from tbl_expenses where id = ?',[$id]);
		return redirect('expense');
	}
    public function expensefetch(Request $request){
		$id=$request->id;
		$expense=Tbl_expenses::find($id);
		print_r(json_encode($expense));
	}
    public function expenseedit(Request $request){
        $id = $request->id;
        $expense = Tbl_expenses::find($id);
    
        $expense->staff_id = $request->staff;
        $expense->type_id = $request->emp_type;
        $expense->amount = $request->amount;
        $expense->remarks = $request->remark;
        $expense->added_date = $request->date;
    
        if ($request->hasFile('billimage')) {
            $files = $request->file('billimage');
            $name = $files->getClientOriginalName();
            $files->move(public_path('image/'), $name);
            $expense->billprint = $name;
        }
    
        $expense->save();
    
        return redirect('expense');
    }
    public function attendance(){
		$exe=DB::table('tbl_attendences')
        ->leftJoin('tbl_staffs', 'tbl_attendences.staff_id', '=', 'tbl_staffs.id')
        ->select('tbl_attendences.*','tbl_staffs.name')->get();
        $mark=DB::table('tbl_staffs')->get();
		$role=Auth::user()->user_type;
		return view('attendance',compact('role','exe','mark'));
	}

    public function attendanceinsert(Request $request)
    {
        $staffIds = $request->staffid;

        $date=$request->date;
    
        // Get today's date
        $todayDate = now()->toDateString();

        $existingAttendance = Tbl_attendences::where('date', $date)
        ->first();

        if($existingAttendance){
         return redirect('attendance');
        }else{
            foreach ($staffIds as $index => $staffId) {
          
                $attend = [
                    'staff_id' => $staffId,
                    'status' => $request->status[$index],
                    'day_type' => $request->day_type[$index],
                    'punchin' => 0,
                    'punchout' => 0,
                    'date' => $date,
                    'ip_address' => $request->ip(),
                    'added_by' => Auth::user()->id,
                    'updated_at' => now(),
                    'created_at' => now()
                ];
    
                Tbl_attendences::insert($attend);
           
        }
        }
    
      
    
        return redirect('attendance');
    }
    
    public function attendancefetch(Request $request){
		$id=$request->id;
		$attend=tbl_attendences::find($id);
		print_r(json_encode($attend));
	}

    public function showDetails()
    {
        $date=date('Y-m-d');
        $attendances = Tbl_attendences::with('staff')->where('date',$date)->get();
    
        return view('attendancedetails', compact('attendances'));
    }
    public function showDetailsfilter(Request $request){
        $date=$request->date;
        $attendances = Tbl_attendences::with('staff')->where('date',$date)->get();
    
        return view('attendancedetails', compact('attendances'));
    }
    
    
    public function attendanceedit(Request $request){
        $id=$request->id;
        $attend=Tbl_attendences::find($id);
        $attend->status=$request->status;
    
        $attend->day_type=$request->day_type;
        
    
        $attend->save();
        return redirect('attendancedetails');
    }
    public function salary(){
		$role=Auth::user()->user_type;
        $month=date('Y-m');
        $stafflist=DB::table('tbl_staffs')->get();


        return view('salary',compact('role','stafflist','month'));
    } 
    public function filterByMonth(Request $request){
        $month=$request->month;
        
        $role=Auth::user()->user_type;
      
        $stafflist=DB::table('tbl_staffs')->get();


        return view('salary',compact('role','stafflist','month'));
    }

  
}