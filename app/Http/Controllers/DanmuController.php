<?php

namespace App\Http\Controllers;

use App\Danmu;
use Illuminate\Http\Request;
use App\Http\Requests\DanmuRequest;
use Illuminate\Support\Facades\Auth;

class DanmuController extends Controller
{
    //
    public function create(DanmuRequest $danmuRequest,Danmu $danmu)
    {
        $data=$danmuRequest->all();
        $data=json_decode($data['danmu'],true);
        $header=$danmuRequest->headers;
        $video_id=str_replace(env('APP_URL').'/video/','',$header->get('referer'));
        $video_id=intval($video_id);
        Danmu::create([
            'time'=>$data['time'],
            'text'=>$data['text'],
            'type'=>$data['position'],
            'size'=>$data['size'],
            'color'=>$data['color'],
            'video_id'=>$video_id,
            'user_id'=>Auth::id()
        ]);
        return dd($danmuRequest->all());
    }

    public function get($id,Danmu $danmu)
    {
        $danmus=Danmu::where('video_id',$id)
                    ->get();
        $json='[';
        $arr=array();
        foreach ($danmus as $k=>$danmu)
        {
            $arr[$k]['text']=$danmu['text'];
            $arr[$k]['color']=$danmu['color'];
            $arr[$k]['size']=intval($danmu['size']);
            $arr[$k]['position']=intval($danmu['type']);
            $arr[$k]['time']=intval($danmu['time']);
        }
        $json.=']';
        return response()->json($arr);
    }
}
