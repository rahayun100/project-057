<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Task::all();
        return response()->json($data);
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
        //
        $validator = Validator::make($request->all(), [ 
            'name' => 'required',
            'description' => 'required',
            
        ]);
        if($validator->passes()){
            return Task::create($request->all());
        }
        return response()->json(['message' => 'Data Gagal Di Tambahkan!!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show( $task)
    {
        //
        $data = Task::where('id',$task)->first();
        if(!empty($data)){
            return $data;
        }
        return response()->json(['message' => 'Data Tidak Di Temukan'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $task)
    {
        //
        $data = Task::where('id',$task)->first();
        if(!empty($data)){
            $validator = Validator::make($request->all(), [ 
                'name' => 'required',
                'description' => 'required',
            ]);
            if($validator->passes()){
                $data->update($request->all());
                return response()->json([
                    'message' => 'Data Berhasil Di simpan',
                    'data' => $data
                ]);
            }else{
                return response()->json([
                    'message' => 'Data gagal di simpan',
                    'data' => $validator->errors()->all()
                ]);
            }
        }
        return response()->json(['message' => 'Data Tidak di temukan!'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy( $task)
    {
        //
        $data = Task::where('id', $task)->first();
        if(empty($data)){
            return response()->json([
                'message' => 'Data Tidak Ditemukan'
            ]);
        }
        $data->delete();
        return response()->json([
            'message' => 'Data berhasil di hapus'
        ]);
    }
}
