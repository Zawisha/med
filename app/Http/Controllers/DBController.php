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
        $id_procedure = $request->input('id_procedure');
        $id_block = $request->input('id_block');
        $block_name = $request->input('block_name');
        $question_text = $request->input('question_text');
        $answer_text = $request->input('answer_text');
        $answer_link_id = $request->input('answer_link_id');



        return Post::create([
            'id_post' => $id_post,
            'id_procedure' => $id_procedure,
            'id_block' => $id_block,
            'block_name' => $block_name,
            'question_text' => $question_text,
            'answer_text' => $answer_text,
            'answer_link_id' => $answer_link_id,
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id_post = $request->input('id_post');
        $id_procedure = $request->input('id_procedure');
        $id_block = $request->input('id_block');
        $delete = Post::where('id_post', '=', $id_post)->where('id_procedure', '=', $id_procedure)->where('id_block', '=', $id_block)->delete();
    }
    public function render(Request $request)
    {
        $id_post = $request->input('id_post');
        $id_procedure= $request->input('id_procedure');
        $id_block=$request->input('id_block');
        $posts = Post::where('id_post', '=', $id_post)->where('id_procedure', '=', $id_procedure)->where('id_block', '=', $id_block)->get();
        foreach( $posts as $key => $value){
            if($posts[$key]['answer_link_id']!=0)
            {
                $name = Post::select('block_name')->where('id_block', '=', $posts[$key]['answer_link_id'])->first();
                if($name){
                    $posts[$key]['answer_link_name']=$name['block_name'];
                }
                else
                {
                    $posts[$key]['answer_link_name']='';
                }
            }
            else
            {
                $posts[$key]['answer_link_name']='';
            }

        }
        return $posts;
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
        return $posts = Post::select('id_block', 'block_name')->where('id_post', '=', $id_post)->where('id_procedure', '=', $id_procedure)->distinct('id_block')->get();
    }

}
