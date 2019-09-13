<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostEditRequest;
use App\Photo;
use App\Post;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;


class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index()
    {
        $data = Post::latest();
        $cat = Category::pluck('name','id')->all();
        if (request()->ajax())
        {

            return Datatables::of($data)
                ->editColumn('category_id',function ($data){
                    return $data->category->name;
                })
                ->editColumn('photo_id',function ($data){
                    return $data->photo->file;
                })
                ->editColumn('user_id',function ($data){
                    return $data->user->name;
                })
                ->editColumn('updated_at',function ($data){
                    return $data->updated_at->diffForHumans();
                })
                ->editColumn('created_at',function ($data){
                    return $data->created_at->diffForHumans();
                })
                ->addColumn('action',function ($data){
                    $button = '<span class="fa fa-pencil-square-o fa-2x text-primary edit" id="'.$data->id.'" style="cursor: pointer;"></span>';
                    $button .= '<span class="text-success" style="font-size: 20px" ">&nbsp;|&nbsp;</span>';
                    $button .='<span class="fa fa-trash-o text-danger fa-2x delete" id="'.$data->id.'" style="cursor: pointer"></span>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.posts.index',compact('cat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name','id')->all();
        return view('admin.posts.create',compact('categories'));
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
        $rules = [
            'category_id' =>'required',
            'photo_id'    =>'required',
            'title'       =>'required',
            'body'        =>'required'];

        $message =[
            'photo_id.required' =>'The Image is Required.',
            'photo_id.image' =>'The File must be an Image.',
            'photo_id.max:2048' =>'The Image size must be 2MB.'
        ];

        $error = Validator::make($request->all(),$rules,$message);
        if ($error->fails())
        {
            return response()->json(['formerror'=>$error->errors()]);
        }


        else
        {
            $input = $request->all();
            if($file = $request->file('photo_id'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('images',$name);

                $photo = Photo::create(['file'=>$name]);

                $input['photo_id'] = $photo->id;

            }

            $user = Auth::user();
            $user->posts()->create($input);
            return response()->json(['formsuccess'=>'working','formerror'=>'']);
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
        //
        $post = Post::findOrFail($id);
        $category =$post->category->id;
        $photo = $post->photo->file;
        return response()->json(['post'=>$post,'category'=>$category,'photo'=>$photo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'title' => 'required',
            'category_id' =>'required',
            'body' =>'required',
        );


        $error = Validator::make($request->all(),$rules);

        if($error->fails())
        {
            return response()->json(['formerror'=>$error->errors()]);
        }

        else
        {

            if($file = $request->file('photo_id'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('images',$name);
                $photo = Photo::create(['file'=>$name]);
                $input['photo_id'] = $photo->id;
            }
            Auth::user()->posts()->whereId($request->id)->first()->update($input);
            return response()->json(['formsuccess'=>'working','formerror'=>'']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Post::findOrFail($id);
        if($data->photo)
        {
            unlink(public_path().$data->photo->file);
            $data->photo->delete();
            $data->delete();
            return response()->json(['ok'=>$data]);
        }


    }
}
