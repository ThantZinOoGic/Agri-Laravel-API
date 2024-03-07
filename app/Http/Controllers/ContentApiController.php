<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContentApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contents = Content::all();
        return response()->json($contents);
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
            $image = $request->image;
            $newName = "gallery_".uniqid().".".$image->extension();
            $image->storeAs("public/gallery", $newName);

            $content = new Content();
            $content->title = $request->title;
            $content->author = $request->author;
            $content->image = $newName;
            $content->content = $request->content;
            $content->save();
            return response()->json(["status" => "Success item store"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $content = Content::find($id);
        if($content)
        {
            return response()->json($content);
        }
        return response()->json(["status" => "Item not found"]);
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
        $content = Content::find($id);
        if($content)
        {
            $content = new Content();
            $content->title = $request->title;
            $content->author = $request->author;
            $content->content = $request->content;
            if($request->image) {
                $image = $request->image;
                $newName = "gallery_".uniqid().".".$image->extension();
                $image->storeAs("public/gallery", $newName);
                Storage::disk('public')->delete('gallery/'. $content->image);
                $content->image = $newName;
            }
            $content->update();
            return response()->json(["status" => "Success item update"]);
        }
        return response()->json(["status" => "Fail update, Item not found"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $content = Content::find($id);
        if($content)
        {
            Storage::disk('public')->delete('gallery/'.$content->image);
            $content->delete();
            return response()->json(['status' => "Item is deleted"]);
        }
        return response()->json(['status' => 'delete process is fail']);
    }
}
