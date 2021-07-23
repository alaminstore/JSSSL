<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'event_title' => 'required|max:80',
            'event_description' => 'required',
            'image' => 'required',
            'event_dated_at' => 'required',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=> 0,'error'=>$validator->errors()->toArray()]);
        }else{
                $news = new Event();
                $news->event_title = $request->event_title;
                $news->event_description = $request->event_description;
                $news->event_dated_at = $request->event_dated_at;
                if ($request->hasFile('image')) {
                    $path = 'images/events/';
                    if (!is_dir($path)) {
                        mkdir($path, 0755, true);
                    }
                    $image = $request->image;
                    $imageName = rand(100, 1000) . $image->getClientOriginalName();
                    $image->move($path, $imageName);
                    $news->event_image = $path . $imageName;
                }
                if($news->save()){
                    return response()->json(['status'=>true,'data' => $news]);
                }
        }
    }
    public function edit($id)
    {
        $data  = Event::find($id);
        if($data){
        $data['tags'] = $data->getTag;
          return response()->json([
              'success' => true,
              'data' => $data
            ]);
        }
        else{
          return response()->json([
              'success' => false,
              'data' => 'No information found'
            ]);
        }
    }

    public function updated(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'event_title' => 'required|max:80',
            'event_description' => 'required',
            'event_dated_at' => 'required',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=> 0,'error'=>$validator->errors()->toArray()]);
        }else{
            $event = Event::find($request->category_id);
            $event->event_title = $request->event_title;
            $event->event_description = $request->event_description;
            $event->event_dated_at = $request->event_dated_at;
        }
        if ($request->hasFile('image')) {
            $path = 'images/events/';
            @unlink($event->event_image);
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }
            $image = $request->image;
            $imageName = rand(100, 1000) . $image->getClientOriginalName();

            $image->move($path, $imageName);
            $event->news_image = $path . $imageName;
        }
        if($event->save()){
            return response()->json(['status'=>true]);
        }
    }


    public function destroy(Request $request){
        $event = Event::find($request->id);
        if($event->delete()){
            return response()->json(['success'=>true,'data'=>$event]);
        }
    }


    public function viewEvent($id){
        $data=Event::find($id);
        if($data){
          return response()->json([
              'success' => true,
              'data' => $data
            ]);
        }
        else{
          return response()->json([
              'success' => false,
              'data' => 'No information found'
            ]);
        }
    }
}
