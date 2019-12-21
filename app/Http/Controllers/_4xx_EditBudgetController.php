<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\SQL\_401_SQL;


/*
|--------------------------------------------------------------------------
| 入力画面のコントローラー
|--------------------------------------------------------------------------
*/
class _4xx_EditBudgetController extends Controller
{
    public function edit_budget_get(Request $request){
        $user = Auth::user();
        if(isset($user)){
            $user_id = $user->id;
            $year = $request->year;
            $month = 2;
            $budget = _401_SQL::select_budget($year,$month,$user_id);
            // dd($budget);
            return view('401_edit_budget',compact('year'));            
        }
        else{
            return redirect('login');
        }
    }
    public function edit_budget_post(Request $request){
        $user = Auth::user();
        if(isset($user)){
            $year = $request->year;
            $user_id = $user->id;
            for($i=1;$i<13;$i++){
                $month=$i;
                $budget= isset($request->{'budget_'.$i}) ? $request->{'budget_'.$i} : 0;

                if((_401_SQL::select_budget($year,$month,$user_id))!==null){
                    $result = _401_SQL::update_budget($year,$month,$budget,$user_id);
                }
                else{
                    _401_SQL::insert_budget($year,$month,$budget,$user_id);
                }
            }
            return view('402_edit_budget_result',compact('year'));          
        }
        else{
            return redirect('login');
        }
    }
    public function edit_budget_result_get(Request $request){
        $user = Auth::user();
        if(isset($user)){
            return view('402_edit_budget_result');            
        }
        else{
            return redirect('login');
        }
    }
}
