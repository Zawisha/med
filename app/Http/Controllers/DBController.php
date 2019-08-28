<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Temp;

class DBController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


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
        $id_post = $request->input('id_post');
        $name_post = $request->input('name_post');
        $parent = $request->input('parent');
        $text = $request->input('text');
        $number_line = $request->input('number_line');
        return Temp::create([
            'id_post' => $id_post,
            'name_post' => $name_post,
            'parent' => $parent,
            'text' => $text,
            'number_line' => $number_line,
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
    public function render(Request $request)
    {
        $parent = $request->input('parent');
       return $posts = Temp::where('parent', '=', $parent)->get();
    }
}
