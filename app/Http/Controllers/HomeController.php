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
}