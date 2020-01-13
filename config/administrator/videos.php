<?php

use App\Video;


return [
    // 页面标题
    'title'   => '视频',

    // 模型单数，用作页面『新建 $single』
    'single'  => '视频',

    // 数据模型，用作数据的 CRUD
    'model'   => Video::class,

    // 设置当前页面的访问权限，通过返回布尔值来控制权限。
    // 返回 True 即通过权限验证，False 则无权访问并从 Menu 中隐藏
    'permission'=> function()
    {
        return Auth::check() && Auth::user()->can('manage_contents');
    },

    // 字段负责渲染『数据表格』，由无数的『列』组成，
    'columns' => [

        // 列的标示，这是一个最小化『列』信息配置的例子，读取的是模型里对应
        // 的属性的值，如 $model->id
        'id',

        'video_path' => [
            // 数据表格里列的名称，默认会使用『列标识』
            'title'  => '视频路径',

            // 是否允许排序
            'sortable' => false,
        ],

        'title' => [
            'title'    => '标题',
            'sortable' => false,
            'output' => function ($name, $model) {
                return '<a href="/users/'.$model->id.'" target=_blank>'.$name.'</a>';
            },
        ],
        'video_type'=>[
            'title'=>'视频分区',
            'output' => function ($video_type, $model) {
                switch ($video_type)
                {
                    case 1:
                        $video_type='娱乐';
                    break;
                    case 2:
                        $video_type='音乐';
                        break;
                    case 3:
                        $video_type='电影';
                        break;
                    case 4:
                        $video_type='舞蹈';
                        break;
                    case 5:
                        $video_type='科技';
                        break;
                    case 6:
                        $video_type='游戏';
                        break;
                    case 7:
                        $video_type='美食';
                        break;

                }
                return $video_type;
            },
        ],


        'description' => [
            'title' => '简介',
        ],
        'state'=>[
            'title'=>'状态',
            'output' => function ($state, $model) {
                switch ($state)
                {
                    case 0:
                        $state='正在转码';
                        break;
                    case 1:
                        $state='未审核';
                        break;
                    case 2:
                        $state='审核通过';
                        break;
                    case 3:
                        $state='审核不通过';
                        break;
                }
                return $state;
            },
        ],
        'operation' => [
            'title'  => '管理',
            'sortable' => false,
        ],
    ],

    // 『模型表单』设置项
    'edit_fields' => [
        'title' => [
            'title' => '标题',
        ],
        'description' => [
            'title' => '简介',
        ],
        'is_reprint' => [
            'title' => '是否转载',

            // 表单使用 input 类型 password
            'type' => 'bool',
        ],
        'is_delete' => [
            'title' => '是否删除',

            // 表单使用 input 类型 password
            'type' => 'bool',
        ],
        'state'=>[
          'title'=>'审核',
            'type'=>'enum',
            'options'=>array('1'=>'未审核','2'=>'审核通过','3'=>'审核不通过'),
        ],
    ],

    // 『数据过滤』设置
    'filters' => [
        'id' => [

            // 过滤表单条目显示名称
            'title' => '视频 ID',
        ],
        'title' => [
            'title' => '标题',
        ],
    ],
];