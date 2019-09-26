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

        $parents = $request->input('parents');

        if(count($answer_text)==0)
        {
            Post::create([
                'id_post' => $id_post,
                'id_procedure' => $id_procedure,
                'id_block' => $id_block,
                'block_name' => $block_name,
                'question_text' => $question_text,
                'answer_text' => '',
                'answer_link_id' => 0,
            ]);
        }


      // return dd($request->input('answer_text'));
        for ($i = 0; $i < count($answer_text); $i++) {
            Post::create([
                'id_post' => $id_post,
                'id_procedure' => $id_procedure,
                'id_block' => $id_block,
                'block_name' => $block_name,
                'question_text' => $question_text,
                'answer_text' => $answer_text[$i],
                'answer_link_id' => $answer_link_id[$i],
            ]);

        }

        //блок родителей
        foreach ($parents as $parent)
        {
           if(empty($parent['answer']))
           {
               Post::create([
                   'id_post' => $id_post,
                   'id_procedure' => $id_procedure,
                   'id_block' => $parent['parent_id_block'],
                   'block_name' => $parent['parent_name_block'],
                   'question_text' => $parent['parent_question_text'],
                   'answer_text' => '',
                   'answer_link_id' => 0,
               ]);
           }
        else
    {
    Post::create([
        'id_post' => $id_post,
        'id_procedure' => $id_procedure,
        'id_block' => $parent['parent_id_block'],
        'block_name' => $parent['parent_name_block'],
        'question_text' => $parent['parent_question_text'],
        'answer_text' => $parent['answer'],
        'answer_link_id' => $parent['answer_link_id'],
    ]);
    }



        }

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
        $id_blocks = $request->input('id_block');

        foreach( $id_blocks as  $id_block) {
            $delete = Post::where('id_post', '=', $id_post)->where('id_procedure', '=', $id_procedure)->where('id_block', '=', $id_block)->delete();
        }

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

    public function render_parents(Request $request)
    {
        $id_post = $request->input('id_post');
        $id_procedure= $request->input('id_procedure');
        $id_block=$request->input('id_block');
       $posts =  Post::select('id_block')->where('id_post', '=', $id_post)->where('id_procedure', '=', $id_procedure)->where('answer_link_id', '=', $id_block)->distinct('id_block')->get();
        $parents=[];
        foreach( $posts as $key => $value) {
            $parent = Post::where('id_post', '=', $id_post)->where('id_procedure', '=', $id_procedure)->where('id_block', '=', $posts[$key]['id_block'])->get();
            $parents[$key]=$parent;
        }


        foreach($parents as $key => $value)
        {

            foreach( $value as $key1 => $value1){
                if($value[$key1]['answer_link_id']!=0)
                {
                    $name = Post::select('block_name')->where('id_block', '=', $parents[$key][$key1]['answer_link_id'])->first();
                    if($name){
                        $parents[$key][$key1]['answer_link_name']=$name['block_name'];
                    }
                    else
                    {
                        $parents[$key][$key1]['answer_link_name']='';
                    }
                }
                    else
                    {
                    $parents[$key][$key1]['answer_link_name']='';
                    }
            }
        }

        return $parents;
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
    public function max_block_id()
    {
        return $posts = Post::max('id_block');
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
       $null_procedura = Procedure::where('id_post', '=', $id_post)->first();
        if($null_procedura['id_main_procedure']==0)
        {$del_null  = Procedure::where('id_post', '=', $id_post)->delete();}
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
    public function delete_post(Request $request)
    {
        $id_post = $request->input('id_post');
        Procedure::where('id_post', '=', $id_post)->delete();
        Post::where('id_post', '=', $id_post)->delete();
    }
    public function delete_procedure(Request $request)
    {
        $id_post = $request->input('id_post');
        $id_procedure = $request->input('id_procedure');
        $name_post =$request->input('name_post');
        Procedure::where('id_post', '=', $id_post)->where('id_main_procedure', '=', $id_procedure)->delete();
        Post::where('id_post', '=', $id_post)->where('id_procedure', '=', $id_procedure)->delete();
        $counts_of_procedure = Procedure::where('id_post', '=', $id_post)->get();
         if (count($counts_of_procedure)==0)
         {
             Procedure::create([
                 'id_post' => $id_post,
                 'name_post' => $name_post,
                 'id_main_procedure' =>0,
                 'name_main_procedure' =>0,
             ]);
         }

    }

    public function delete_block(Request $request)
    {
        $id_post = $request->input('id_post');
        $id_procedure = $request->input('id_procedure');
        $id_block = $request->input('id_block');
        Post::where('id_post', '=', $id_post)->where('id_procedure', '=', $id_procedure)->where('id_block', '=', $id_block)->delete();
        Post::where('id_post', '=', $id_post)->where('id_procedure', '=', $id_procedure)->where('answer_link_id', '=', $id_block)->update(['answer_link_id' => 0]);
    }

}
