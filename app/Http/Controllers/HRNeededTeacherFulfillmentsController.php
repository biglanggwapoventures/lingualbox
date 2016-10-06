<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;

use App\NeededTeachersFullfillment AS Fulfill;
use App\NeededTeacher AS Hiring;

use Auth;

class HRNeededTeacherFulfillmentsController extends Controller
{

    function __construct()
    {
        $this->user = Auth::user();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hiring = new Hiring;
        $unfulfilled = $hiring->getUnfulfilled();
        $unfulfilledForDropdown = [];

        foreach($unfulfilled AS $row){
            $dateRequested = date_create_immutable($row->date_requested)->format('M d, Y');
            $unfulfilledForDropdown[$row->id] = "Request # {$row->id} ({$dateRequested})";
        }
        

        $fulfillments = Fulfill::with('fulfilledBy')->get();
        return view('blocks.hiring.fulfill', compact('unfulfilledForDropdown', 'fulfillments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'morning' => 'integer',
            'afternoon' => 'integer',
            'evening' => 'integer',
            'midnight' => 'integer',
            'request_id' => 'required|exists:needed_teachers,id'
        ]);

        if($v->fails()){
            return response()->json([
                'result' => false,
                'errors' => $v->errors()
            ]);
        }

        $data = $request->only(['morning', 'afternoon', 'evening', 'midnight', 'request_id']);
        $data += [
            'date_fulfilled' => date('Y-m-d'),
            'created_by' => $this->user->id
        ];

        Fulfill::create($data);

        return response()->json([
            'result' => true,
            'next_url' => route('fulfill-teachers.index')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
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
         $v = Validator::make($request->all(), [
            'morning' => 'integer',
            'afternoon' => 'integer',
            'evening' => 'integer',
            'midnight' => 'integer',
            'request_id' => 'required|exists:needed_teachers,id'
        ]);

        if($v->fails()){
            return response()->json([
                'result' => false,
                'errors' => $v->errors()
            ]);
        }

        $data = $request->only(['morning', 'afternoon', 'evening', 'midnight', 'request_id']);

        $fulfillment = Fulfill::find($id);
        $fulfillment->fill($data)->save();

        return response()->json([
            'result' => true,
            'next_url' => route('fulfill-teachers.index')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Fulfill::find($id)->delete();
        return response()->json([
            'result' => true,
            'next_url' => route('fulfill-teachers.index')
        ]);
    }
}
