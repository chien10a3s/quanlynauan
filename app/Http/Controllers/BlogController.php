<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Models\Post;
use TCG\Voyager\Models\Category;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = BlogPost::all();
        return view('blog.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data_input = $request->only(['title', 'featured_image', 'content', 'excerpt', 'slug', 'author_id', 'blog_id', 'tags', 'meta_description', 'meta_keywords', 'active']);
        
        if($request->hasFile('featured_image')){
            
            $fullFilename = null;
            $resizeWidth = 1170;
            $resizeHeight = null;
            $file = $request->file('featured_image');
            $filename = Str::random(20);
            $fullPath = 'post/'.date('F').date('Y').'/'.$filename.'.'.$file->getClientOriginalExtension();
    
            $ext = $file->guessClientExtension();
            $extension_allow = ['jpeg', 'jpg', 'png', 'gif'];
            if (in_array($ext, $extension_allow)) {
                $image = Image::make($file)
                    ->resize($resizeWidth, $resizeHeight, function (Constraint $constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->encode($file->getClientOriginalExtension(), 75);
    
                // move uploaded file from temp to uploads directory
                if (Storage::disk(config('voyager.storage.disk'))->put($fullPath, (string) $image, 'public')) {
                    $status = 'Image successfully uploaded!';
                    $fullFilename = $fullPath;
                    $data_input['featured_image'] = $fullFilename;
                } else {
                    $status = 'Upload Fail: Unknown error occurred!';
                }
            } else {
                $status = 'Upload Fail: Unsupported file format or It is too large to upload!';
            }
        }
        
        $data_input['created_by'] = Auth::user()->id;
        $data_input['updated_by'] = Auth::user()->id;
        
        BlogPost::insert($data_input);
        
        return redirect()->route('blog.post.index')->withFlashSuccess('Thêm bài viết thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug',$slug)->first();
        if(!$post){
           return view('404');
        }
        return view('posts.show')->withPost($post);
    }
    
    public function showWithCategory($cate, $post){

        $cate = Category::where('slug', $cate)->first();
        $post = Post::where(['category_id' => $cate->id, 'slug' => $post])->first();
        if(!$post){
           return view('404');
        }
        return view('posts.show', compact(['category', 'post']));
    }
    
    public function showCategory($cate){

        $category = Category::where('slug', $cate)->first();
        if(!$category){
           return view('404');
        }
        return view('posts.category')->withCategory($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogPost $blogPost)
    {
        return view('blog.post.edit', compact('blogPost'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = BlogPost::find($id);
        
        if($request->hasFile('featured_image')){
            
            $fullFilename = null;
            $resizeWidth = 1170;
            $resizeHeight = null;
            $file = $request->file('featured_image');
            $filename = Str::random(20);
            $fullPath = 'post/'.date('F').date('Y').'/'.$filename.'.'.$file->getClientOriginalExtension();
    
            $ext = $file->guessClientExtension();
            $extension_allow = ['jpeg', 'jpg', 'png', 'gif'];
            if (in_array($ext, $extension_allow)) {
                $image = Image::make($file)
                    ->resize($resizeWidth, $resizeHeight, function (Constraint $constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->encode($file->getClientOriginalExtension(), 75);
    
                // move uploaded file from temp to uploads directory
                if (Storage::disk(config('voyager.storage.disk'))->put($fullPath, (string) $image, 'public')) {
                    $status = 'Image successfully uploaded!';
                    $fullFilename = $fullPath;
                    $post->featured_image = $fullFilename;
                } else {
                    $status = 'Upload Fail: Unknown error occurred!';
                }
            } else {
                $status = 'Upload Fail: Unsupported file format or It is too large to upload!';
            }
            
        }
        $data_input = $request->only(['title', 'featured_image', 'content', 'excerpt', 'slug', 'author_id', 'blog_id', 'tags', 'meta_description', 'meta_keywords', 'active']);
        
        $post->title     = $request->input('title');
        $post->content   = $request->input('content');
        $post->excerpt   = $request->input('excerpt');
        $post->author_id   = $request->input('author_id');
        $post->blog_id   = $request->input('blog_id');
        $post->tags   = $request->input('tags');
        $post->meta_description   = $request->input('meta_description');
        $post->meta_keywords   = $request->input('meta_keywords');
        $post->slug   = $request->input('slug');
        $post->active   = $request->input('active');
        
        $post->save();

        // redirect
        Session::flash('message', 'Cập nhật thành công');
        return redirect()->route('blog.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogPost $blogPost)
    {
        $post = BlogPost::find($id);
        $post->delete();
        return back()->with('info', 'Xóa thành công');
    }
}
