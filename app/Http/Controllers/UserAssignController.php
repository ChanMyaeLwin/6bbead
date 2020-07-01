<?php

namespace App\Http\Controllers;

use App\Http\Requests\Plans\PlanStoreRequest;
use App\Http\Requests\Plans\PlanUpdateRequest;
use Illuminate\Http\Request;
use App\Plan; 

class UserAssignController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        dd($request);
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
            return view('plans.create');
        // }
        // abort('404');

    }
    /**
    * Get Specific clinic
    *
    * @param Clinic $clinic
    * @return void
    */
    public function show($id)
    {
        
        $plan = Plan::findOrFail($id);
        return view('plans.show',compact('plan'));
    }

    /**
     * Store Plan 
     *
     * @param planstoreRequest $request
     * @return void
     */
    public function store(planstoreRequest $request)
    {
        dd($request);
            $plan = Plan::create($request->all());
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
        $plan = Plan::findOrFail($id);
        // dd($plan);
        $plan = $plan->delete();
        return redirect()->route('plans.index')
        ->with('success','Plan is delected successfully');
    }

}
