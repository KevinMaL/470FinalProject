<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PlanItem;
use App\Plan;
use Auth;
use App\Http\Requests\PlanItemRequest;


class PlanItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $planItems = PlanItem::all();
        
        return view('plans.index', compact('planItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('planItems.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //PlanItem::create($request->all());
        $this->validate($request,array(
            'item_name' => 'required|max:255'
            ));
        $planItem = new PlanItem;
        $planItem->item_name =$request->item_name;
        $planItem->item_body =$request->item_body;
        $planItem->time1=$request->time1;
        $planItem->time2=$request->time2;
        $planItem->time3=$request->time3;
        $planItem->time4=$request->time4;

        If ($request->has('Monday')){
            $planItem->Monday=true;
        }
        If ($request->has('Tuesday')){
            $planItem->Tuesday=true;
        }        
        If ($request->has('Wednesday')){
            $planItem->Wednesday=true;
        }        
        If ($request->has('Thursday')){
            $planItem->Thursday=true;
        }        
        If ($request->has('Friday')){
            $planItem->Friday=true;
        }
        If ($request->has('Saturday')){
            $planItem->Saturday=true;
        }
        If ($request->has('Sunday')){
            $planItem->Sunday=true;
        }
        $planItem->plan_id = $request->planid;
        $planItem->save();

        return redirect()->back()->with('message','item has been added successfully');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PlanItem $planItem)
    {
        return view('planItems.show',compact('planItem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
