<?php
namespace App\Handlers;

use  Illuminate\Support\Str;
use Image;

class UploadImageHandler
{
    protected $filetype = ['png', 'jpeg', 'jpg'];

    public function save($file, $folder, $file_prefix, $max_width)
    {
        ///最后存储路径  public/upload/image/类型/年月日/1-999随机数_时间戳.jpg
        ///
        $savefile = 'uploads/images/' . $folder . '/' . date("Ym/d", time());
        $uploadfile = public_path() . '/' . $savefile;


        $extension = strtolower($file->getClientOriginalExtension());
        $filename = $this->checkfilename($file_prefix,$extension).'.'.$extension;

        if (!in_array($extension, $this->filetype)) {
            //如果上传的不是图片 返回false
            return false;
        }

        $file->move($uploadfile, $filename);

        if (isset($max_width) && $extension != 'gif') {
            // 此类中封装的函数，用于裁剪图片
            $this->reduceSize($uploadfile . '/' . $filename, $max_width);
        }

        return [
            'path' => config('app.url') . "/$savefile/$filename"
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


    public function reduceSize($file_path, $max_width)
    {
        // 先实例化，传参是文件的磁盘物理路径
        $image = Image::make($file_path);

        // 进行大小调整的操作
        $image->resize($max_width, null, function ($constraint) {

            // 设定宽度是 $max_width，高度等比例缩放
            $constraint->aspectRatio();

            // 防止裁图时图片尺寸变大
            $constraint->upsize();
        });


        // 对图片修改后进行保存
        $image->save();
    }
}