<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use Auth;

use App\NeededTeacher AS Hiring;

class AdminNeededTeachersController extends Controller
{

    function __construct()
    {
        // parent::__construct();
        $this->user = Auth::user();
    }

    function view()
    {
        $hiring = Hiring::with(['requestor', 'fulfillments.fulfilledBy'])->orderBy('id', 'DESC')->get();
        return view('blocks.hiring.view', compact('hiring'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hiring = Hiring::with(['requestor', 'fulfillments.fulfilledBy'])->orderBy('id', 'DESC')->get();
        return view('blocks.hiring.add', compact('hiring'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'midnight' => 'integer'
        ]);

        if($v->fails()){
            return response()->json([
                'result' => false,
                'errors' => $v->errors()
            ]);
        }

        $data = $request->only(['morning', 'afternoon', 'evening', 'midnight']);
        $data += [
            'date_requested' => date('Y-m-d'),
            'created_by' => $this->user->id
        ];

        $hiring = Hiring::create($data);

        return response()->json([
            'result' => true,
            'next_url' => route('needed-teachers.index')
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
        return response()->json(Hiring::find($id));
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
        $v = Validator::make($request->all(), [
            'morning' => 'integer',
            'afternoon' => 'integer',
            'evening' => 'integer',
            'midnight' => 'integer'
        ]);

        if($v->fails()){
            return response()->json([
                'result' => false,
                'errors' => $v->errors()
            ]);
        }

        $data = $request->only(['morning', 'afternoon', 'evening', 'midnight']);

        $hiring = Hiring::find($id);
        $hiring->fill($data)->save();

        return response()->json([
            'result' => true,
            'next_url' => route('needed-teachers.index')
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
        Hiring::find($id)->delete();
        return response()->json([
            'result' => true,
            'next_url' => route('needed-teachers.index')
        ]);
    }
}
