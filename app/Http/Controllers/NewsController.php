<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsResource;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Events\NewsEvent;

class NewsController extends Controller
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
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'image' => 'required'
        ]);

        $newNews = new News();
        $newNews->title = $request->title;
        $newNews->content = $request->content;

        $image = $request->file('image');
        $directory = 'image/news/';
        $imageName = uniqid() . '_' . $image->getClientOriginalName();
        Storage::disk('public')->put($directory . $imageName, file_get_contents($image));
        $newNews->image = $directory . $imageName;

        $newNews->save();
        event(new NewsEvent($newNews->id, 'created'));
        return response([
            'news' => new
                NewsResource($newNews),
            'message' => 'Success'
        ], 200);
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
        $news = News::findOrFail($id);
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required'
        ]);

        $news->title = $request->title;
        $news->content = $request->content;

        $image = $request->file('image');
        if ($image) {
            Storage::disk('public')->delete($news->image);
            $directory = 'image/news/';
            $imageName = uniqid() . '_' . $image->getClientOriginalName();
            Storage::disk('public')->put($directory . $imageName, file_get_contents($image));
            $news->image = $directory . $imageName;
        }
        $news->save();
        event(new NewsEvent($news->id, 'updated'));
        return response([
            'news' => new
                NewsResource($news),
            'message' => 'Success'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        event(new NewsEvent($news->id, 'deleted'));
        Storage::disk('public')->delete($news->image);
        $news->delete();
        return response(['message' => 'News has been deleted']);
    }
}
