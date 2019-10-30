<?php

namespace App\Http\Controllers;

use App\CurrentPost;
use App\Document;
use App\DocumentName;
use App\Subject;
use App\UserStatus;
use Illuminate\Http\Request;
use App\Temp;
use App\Procedure;
use App\Post;
use App\CurrentBlock;
use App\User;

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
        $id_current_post = CurrentPost::select('id_post')->where('id', '>', 0)->get();
        if($id_current_post[0]['id_post'] == $id_post)
        {
            CurrentPost::where('id', '>', 0)->update(['id_post' => 0,'name_post' =>0]);
        }

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
    public function add_current_post(Request $request)
    {
        $id_post = $request->input('id_post');
        $name_post = $request->input('name_post');
        CurrentPost::where('id', '>', 0)->update(['id_post' => $id_post,'name_post' =>$name_post]);
    }
    public function select_front_current_post()
    {
        $id_current_post = CurrentPost::select('id_post')->where('id', '>', 0)->get();
        return $id_current_post[0]['id_post'];
    }

    public function front_render_procedures()
    {
        $id_current_post = CurrentPost::select('id_post')->where('id', '>', 0)->get();
        $id_post = $id_current_post[0]['id_post'];
        return $posts = Procedure::where('id_post', '=', $id_post)->get();
    }

    public function change_current_block(Request $request)
    {
        $id_post = $request->input('id_post');
        $id_procedure = $request->input('id_procedure');
        $id_block = $request->input('id_block');

        CurrentBlock::where('id_post', '=', $id_post)->where('id_procedure', '=', $id_procedure)->delete();
        CurrentBlock::create([
            'id_post' => $id_post,
            'id_procedure' => $id_procedure,
            'id_block' => $id_block,
        ]);
    }

    public function select_front_current_block(Request $request)
    {
        $id_post = $request->input('id_post');
        $id_procedure = $request->input('id_procedure');
        $id_current_block = CurrentBlock::where('id_post', '=', $id_post)->where('id_procedure', '=', $id_procedure)->get();
        return $id_current_block[0]['id_block'];
    }

    public function front_render_start_block(Request $request)
    {
        $id_procedure = $request->input('id_procedure');
        $id_current_post = CurrentPost::select('id_post')->where('id', '>', 0)->get();
        $id_post = $id_current_post[0]['id_post'];
        $id_block = CurrentBlock::where('id_post', '=', $id_post)->where('id_procedure', '=', $id_procedure)->get();
        $id_block=$id_block[0]['id_block'];

        $result=Post::where('id_post', '=', $id_post)->where('id_procedure', '=', $id_procedure)->where('id_block', '=', $id_block)->get();
        $res_arr=[];
        $answer_text=[];
        $answer_link_id=[];
        foreach ($result as $value) {
                array_push($answer_text, $value['answer_text']);
                array_push($answer_link_id, $value['answer_link_id']);
        }
        $res_arr['id']=$result[0]['id'];
        $res_arr['id_post']=$result[0]['id_post'];
        $res_arr['id_procedure']=$result[0]['id_procedure'];
        $res_arr['id_block']=$result[0]['id_block'];
        $res_arr['block_name']=$result[0]['block_name'];
        $res_arr['question_text']=$result[0]['question_text'];
        $res_arr['answer_text']=$answer_text;
        $res_arr['answer_link_id']=$answer_link_id;
        return $res_arr;
    }

    public function front_render_add_block(Request $request)
    {
        $id_procedure = $request->input('id_procedure');
        $id_current_post = CurrentPost::select('id_post')->where('id', '>', 0)->get();
        $id_post = $id_current_post[0]['id_post'];
        $id_block = $request->input('id_block');

        $result=Post::where('id_post', '=', $id_post)->where('id_procedure', '=', $id_procedure)->where('id_block', '=', $id_block)->get();

        $res_arr=[];
        $answer_text=[];
        $answer_link_id=[];
        foreach ($result as $value) {
            array_push($answer_text, $value['answer_text']);
            array_push($answer_link_id, $value['answer_link_id']);
        }
        $res_arr['id']=$result[0]['id'];
        $res_arr['id_post']=$result[0]['id_post'];
        $res_arr['id_procedure']=$result[0]['id_procedure'];
        $res_arr['id_block']=$result[0]['id_block'];
        $res_arr['block_name']=$result[0]['block_name'];
        $res_arr['question_text']=$result[0]['question_text'];
        $res_arr['answer_text']=$answer_text;
        $res_arr['answer_link_id']=$answer_link_id;
        return $res_arr;
    }

    public function update_post_name(Request $request)
    {
        $id_post = $request->input('id_post');
        $name_post = $request->input('name_post');
        Procedure::where('id_post', '=', $id_post)->update(['name_post' =>$name_post]);
    }
    public function update_procedure_name(Request $request)
    {
        $id_post = $request->input('id_post');
        $id_procedure = $request->input('id_procedure');
        $name_procedure = $request->input('name_procedure');
        Procedure::where('id_post', '=', $id_post)->where('id_main_procedure', '=', $id_procedure)->update(['name_main_procedure' =>$name_procedure]);
    }

    public function save_subject(Request $request)
    {
        $UNP = $request->input('UNP');
        $polnoe_naimenovanie = $request->input('polnoe_naimenovanie');
        $socrasch_naimenovanie = $request->input('socrasch_naimenovanie');
        $FIO = $request->input('FIO');
        $mesto_nahozdenia = $request->input('mesto_nahozdenia');
        $pochtovyi_adres = $request->input('pochtovyi_adres');
        $nomer_rasch_sheta = $request->input('nomer_rasch_sheta');
        $naimenovanie_banka = $request->input('naimenovanie_banka');
        $BIC = $request->input('BIC');
        $razmer_ust_fonda = $request->input('razmer_ust_fonda');
        $balansovaja_stoim_aktivov = $request->input('balansovaja_stoim_aktivov');
        $objem_viruchki = $request->input('objem_viruchki');
        $vidy_tovarov = $request->input('vidy_tovarov');
        $rezident = $request->input('rezident');
        $status = $request->input('status');
        $dominant = $request->input('dominant');

        Subject::create([
            'UNP' => $UNP,
            'polnoe_naimenovanie' => $polnoe_naimenovanie,
            'socrasch_naimenovanie' => $socrasch_naimenovanie,
            'FIO' => $FIO,
            'mesto_nahozdenia' => $mesto_nahozdenia,
            'pochtovyi_adres' => $pochtovyi_adres,
            'nomer_rasch_sheta' => $nomer_rasch_sheta,
            'naimenovanie_banka' => $naimenovanie_banka,
            'BIC' => $BIC,
            'razmer_ust_fonda' => $razmer_ust_fonda,
            'balansovaja_stoim_aktivov' => $balansovaja_stoim_aktivov,
            'objem_viruchki' => $objem_viruchki,
            'vidy_tovarov' => $vidy_tovarov,
            'rezident' => $rezident,
            'status' => $status,
            'dominant' => $dominant,
        ]);
    }
    public function polute_start_array()
    {
        $name = Subject::select('polnoe_naimenovanie')->get();
        return $name;
    }
    public function get_autocomplete(Request $request)
    {
        $req_string = $request->input('req_string');
        $res=Subject::where('polnoe_naimenovanie','like',"%{$req_string}%")->get();
        return $res;
    }


    //documents list for user
    public function render_documents()
    {
        $user = User::find(JWTAuth::user()->id);

        $is_admin = Document::where('id_user', '=', $user['id'])->get();
    }

    public function documents_list()
    {
        $doc_list = DocumentName::where('id', '>', '0')->get();
        return $doc_list;
    }

    public function users_list()
    {
        $users_list = User::with('user_status')->where('id', '>', '0')->get();

        return $users_list;
    }

    public function users_list_pagination(Request $request)
    {
        $offset = ($request->input('offset')-1)*3;
        $users_list = User::with('user_status')->where('id', '>', '0')->offset($offset)->limit(3)->get();

        return $users_list;
    }

    public function change_user_banned(Request $request)
    {
        $user_id = $request->input('user_id');
        $user_banned = $request->input('user_banned');
        UserStatus::where('id_user', '=', $user_id)->update(['banned' =>$user_banned]);
    }

    public function change_user_role(Request $request)
    {
        $user_id = $request->input('user_id');
        $user_role = $request->input('user_role');
        UserStatus::where('id_user', '=', $user_id)->update(['status' =>$user_role]);
    }

}
