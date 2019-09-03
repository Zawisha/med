<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Temp;
use App\Procedure;
use App\Post;

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
        $post_in_work= $request->input('post_in_work');
       return $posts = Temp::where('parent', '=', $parent)->where('id_post', '=', $post_in_work)->get();
    }
    public function render_procedures(Request $request)
    {
        $id_post = $request->input('id_post');
        return $posts = Procedure::where('id_post', '=', $id_post)->get();
    }

    public function render_posts(Request $request)
    {
        return $names = Procedure::select('id_post', 'name_post')->distinct('id_post')->get();
    }
    public function post_id()
    {
        return $posts = Procedure::max('id_post');
    }
    public function select_line(Request $request)
    {
        $id_post = $request->input('id_post');
        return $line = Temp::where('id_post', '=', $id_post)->max('number_line');
    }
    public function select_name(Request $request)
    {
        $id_post = $request->input('id_post');
        return $name = Procedure::select('name_post')->where('id_post', '=', $id_post)->first();
    }
    public function add_procedure(Request $request)
    {
        $id_post = $request->input('id_post');
        $name_post = $request->input('name_post');
        $id_main_procedure = $request->input('id_main_procedure');
        $name_main_procedure = $request->input('name_main_procedure');
        return Procedure::create([
            'id_post' => $id_post,
            'name_post' => $name_post,
            'id_main_procedure' => $id_main_procedure,
            'name_main_procedure' => $name_main_procedure,
        ]);
    }

    public function render_blocks(Request $request)
    {
        $id_post = $request->input('id_post');
        $id_procedure = $request->input('id_procedure');
        return $posts = Post::where('id_post', '=', $id_post)->where('id_procedure', '=', $id_procedure)->get();
    }

}
