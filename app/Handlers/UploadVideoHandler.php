<?php
namespace App\Handlers;

use  Illuminate\Support\Str;
use Image;
use FFMpeg;
use App\Jobs\VideoQueue;

class UploadVideoHandler
{
    protected $filetype = ['mp4','avi','wmv'];

    public function save($file, $folder, $file_prefix)
    {
        ///最后存储路径  public/upload/image/类型/年月日/1-999随机数_时间戳.jpg
        $savefile = 'uploads/video/' . $folder . '/' . date("Ym/d", time());
        $uploadfile = public_path() . '/' . $savefile;

        $extension = strtolower($file->getClientOriginalExtension());
        $filename = $this->checkfilename($file_prefix,$extension);
        $videofile=$filename.'.'.$extension;
        $imgfile=$filename.'.'.'jpg';
        $state=1;


        $file->move($uploadfile, $videofile);
        if (!in_array($extension, $this->filetype)) {
            //如果上传的不是允许的格式 返回false
            return false;
        }elseif (in_array($extension, $this->filetype) && $extension!=='mp4'){
            //视频格式不是mp4的其他格式  ffmpeg进行转码

            $cmd = 'ffmpeg -i '.public_path() ."/$savefile/$videofile".' -vcodec h264 '.public_path() ."/$savefile/$filename.mp4";
            $videofile=$filename.'.mp4';
            dispatch(new VideoQueue($cmd,config('app.url') . "/$savefile/$videofile"));
            $state=0;
        }

        $this->createvideoimg(public_path() . "/$savefile/$filename.".$extension,public_path() . "/$savefile/$imgfile");
        return [
            'video_path' => config('app.url') . "/$savefile/$videofile",
            'video_image' => config('app.url') . "/$savefile/$imgfile",
            'state'=>$state,
        ];

    }

    //检查是否重复图片名称 如果重复递归自己重新生成随机文件名
    public function checkfilename($file_prefix,$extension)
    {
        $filename = mt_rand(1, 999) . '_' . time();
        if (file_exists($file_prefix . $filename.'.'.$extension)) {
            return $this->checkfilename($file_prefix,$extension);
        } else {
            return $file_prefix . $filename;
        }
    }

    public function createvideoimg($videourl,$imgurl)
    {
        $ffmpeg = FFMpeg\FFMpeg::create(array(
            'ffmpeg.binaries'  => '/home/vagrant/ffmpeg-git-20191222-amd64-static/ffmpeg',
            'ffprobe.binaries' => '/home/vagrant/ffmpeg-git-20191222-amd64-static/ffprobe',
            'timeout'          => 3600,
            'ffmpeg.threads'   => 12,
        ));
        $video = $ffmpeg->open($videourl);
        $frame = $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(2));
        $frame->save($imgurl);
    }

}