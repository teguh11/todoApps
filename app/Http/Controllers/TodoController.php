<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lists()
    {

        $lists = DB::table('todo')->select('id', 'name')->get();
        $stringHtml = '';
        foreach ($lists as $key => $value) {
            $stringHtml .= $this->listItem((array)$value);
        }
        return response()->json($stringHtml); 
        // return view('welcome', ['lists' => $lists]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->isMethod('post'))
        {
            $insert = DB::table('todo')->insert(['name' => $request->input('todo')]);
            if($insert)
            {
                $id = DB::getPdo()->lastInsertId();
                $todoItem = $this->listItem(['id'=> $id, 'name' => $request->input('todo')]);
                return response()->json(['status' => true, 'data' => ['item' => $todoItem]]);
            }
            return response()->json(['status' => false]);
        }

        return response()->json(['status' => false]);
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
        $delete = DB::table('todo')->where('id', '=', $id)->delete();
        return response()->json(['status' => true]);
        //
    }

    public function bulkdestroy(Request $request)
    {

        $delete = DB::table('todo')->whereIn('id', $request->input('id'))->delete();
        if($delete)
        {
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false]);
    }

    public function listItem($data)
    {
        return view('todo.todoItem', ['data' => $data])->render();
    }
}
