<?php

namespace App\Http\Controllers;

use App\Http\Requests\Plans\PlanStoreRequest;
use App\Http\Requests\Plans\PlanUpdateRequest;
use App\Http\Requests\Plans\LevelStoreRequest;
use App\Http\Requests\Plans\ChoosePlanRequest;
use Illuminate\Http\Request;
use App\Plan; 
use App\LevelDay; 
use App\UserPlan;
use App\UserDay;  

class PlanController extends Controller
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
    public function index(Request $request)
    {   
        $plans = Plan::orderBy('id','DESC')->paginate(5);
        return view('plans.index',compact('plans'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

   /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if(\Auth::user()->can('super-admin')){
            return view('plans.create',compact('day_array'));
        // }
        // abort('404');

    }
    /**
    * Get Specific clinic
    *
    * @param Clinic $clinic
    * @return void
    */
    public function show($id,Request $request)
    {
        $plan = Plan::findOrFail($id);
        $levels = LevelDay::where('plan_id',$id)->orderby('level_name')
        ->orderby('day_no')->get();
        return view('plans.show',compact('plan','levels'));
    }

    /**
     * Store Plan 
     *
     * @param planstoreRequest $request
     * @return void
     */
    public function store(planstoreRequest $request)
    {
        $plan = Plan::create(['plans_name' => $request['plan_name']]);
        return redirect()->route('plans.index')
        ->with('success','Plan is created successfully');  
    }

    public function edit($id){
        $plan = Plan::findOrFail($id);
        return view('plans.edit',compact('plan'));
    }

    /**
     * Update Plan
     *
     * @param PlanUpdateRequest $request
     * @return void
     */
    public function update(PlanUpdateRequest $request,$id)
    {
        $plan = Plan::findOrFail($id);
        $plan->fill($request->all())->save();
        return redirect()->route('plans.index')
        ->with('success','Plan is updated successfully');
    }

    public function destroy($id)
    {
        \DB::table("plans")->where('id',$id)->delete();
        return redirect()->route('plans.index')
                        ->with('success','Plan deleted successfully');
    }

    public function createLevel($id){
        // dd('aerw');
        $day = [
            ['id'=>'Sunday', 'name'=>'Sunday'],
            ['id'=>'Monday', 'name'=>'Monday'],
            ['id'=>'Tuesday', 'name'=>'Tuesday'],
            ['id'=>'Wednesday', 'name'=>'Wednesday'],
            ['id'=>'Thursday', 'name'=>'Thursday'],
            ['id'=>'Friday', 'name'=>'Friday'],
            ['id'=>'Saturday', 'name'=>'Saturday']
        ];
        $day_array = array(0=>'Select');
        foreach ($day as $key => $value) {
            // dd($value['id']);
            $day_array += [
                $value['id']=>$value['name']
            ];
        }
        $plan = Plan::findOrFail($id);
        return view('plans.addLevel',compact('plan','day_array'));
    }

    public function addLevel(LevelStoreRequest $request,$id)
    {
        // dd($request['level_name']);
        $level = LevelDay::create([
            'plan_id' => $request['plan_id'],
            'level_name' => $request['level_name'],
            'day_no' => $request['day_no'],
            'day_name' => $request['day_name'],
            'no_of_round' => $request['no_of_round'],
            'first_defination' => $request['first_defination'],
            'second_defination' => $request['second_defination'],
        ]);
        return redirect()->route('plans.index')
        ->with('success','Level is Added successfully');
    }

    public function choosePlanView($id)
    {
        $plan = Plan::findOrFail($id);
        return view('plans.choosePlan',compact('plan'));
    }

    public function choosePlan(ChoosePlanRequest $request,$id)
    {
        $dateIn = strtotime($request['start_date']);
        $start_day = strtolower(date("l", $dateIn));
        $planStartDay = LevelDay::where('day_no',1)->orderby('level_name')->first()->day_name;

        if(strtoupper($planStartDay) == strtoupper($start_day))
        {
            UserPlan::create([
                'plan_id' => $request['plan_id'],
                'user_id' => Auth()->user()->id,
                'start_date' => $request['start_date']
            ]);

            $levelDaysByPlanId = LevelDay::where('plan_id',$id)->orderby('level_name')
            ->orderby('day_no')->get();
            $i = 1;
            foreach ($levelDaysByPlanId as $levelDay) {
                
                $level = UserDay::create([
                    'day_no' => $i,
                    'level_day_id' => $levelDay->id,
                    'user_id' => Auth()->user()->id,
                    'start_time' => null,
                    'end_time' => null,
                    'status' => 0,
                    
                ]);
                $i +=1;
            }
        
            return redirect()->route('plans.choosedPlans')
            ->with('success','Plan is choosed successfully');
        }else{
            return redirect()->route('plans.choosePlanView',$id)
            ->with('unsuccess','Plan is choosed unsuccessfully');
        };
    }

    public function choosedPlans(Request $request)
    {   
        $userplans = UserPlan::where('user_id',Auth()->user()->id)
        ->with('plans')->paginate(5);
        return view('plans.choosedPlan',compact('userplans'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function startPlan($id)
    {
        $userplan =UserPlan::where('user_id',Auth()->user()->id)
        ->where('plan_id',$id)->first();

        $today = date("Y-m-d") ;
        $startdate = $userplan['start_date'];
        $diff = abs(strtotime($today) - strtotime($startdate));
        $days =  round($diff/86400) +1;
        $todayuserday = UserDay::where('day_no',$days)->with('levelDays')->first();
        if($todayuserday->status == 0){
            $plan = Plan::findOrFail($id);
            return view('plans.startPlan',compact('todayuserday','plan'));
        }else{
            return redirect()->route('plans.choosedPlans',$id)
            ->with('unsuccess','Today Job is Successfully Finished');
        };
    
        
    }

    public function updatestatus(Request $request)
    {
        // dd('aa',$request['user_day_id']);
        $userday = UserDay::findOrFail($request['user_day_id']);
 
        if($userday) {
            $userday->start_time = $request['start_time'];
            $userday->end_time = $request['end_time'];
            $userday->status = 1;
            $userday->save();
        }

        return $userday;
    }


    public function viewPlanStatus($plan_id)
    {;
        $userdays = UserDay::with('levelDays')->orderby('day_no')->with('levelDays')->get();
        $plan = Plan::findOrFail($plan_id);
        return view('plans.viewPlanStatus',compact('userdays','plan'));
    }
}
