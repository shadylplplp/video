<?php

use App\Comment;


return [
    // 页面标题
    'title'   => '评论',

    // 模型单数，用作页面『新建 $single』
    'single'  => '评论',

    // 数据模型，用作数据的 CRUD
    'model'   => Comment::class,

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

        'user_id' => [
            // 数据表格里列的名称，默认会使用『列标识』
            'title'  => '用户id',

            // 是否允许排序
            'sortable' => false,
            'output' => function ($name, $model) {
                return '<a href="/user/'.$name.'" target=_blank>'.$model->User->name.'</a>';
            },
        ],

        'video_id' => [
            'title'    => '视频id',
            'sortable' => false,
            'output' => function ($name, $model) {
                return '<a href="/video/'.$name.'" target=_blank>'.$model->Video->title.'</a>';
            },
        ],
        'content' => [
            'title' => '评论内容',
            'sortable' => false,
        ],
        'created_at'=>[
            'title'=>'评论时间',
        ],
        'operation' => [
            'title'  => '管理',
            'sortable' => false,
        ],
    ],

    // 『模型表单』设置项
    'edit_fields' => [
        'content' => [
            'content' => '评论内容',
        ],
        'is_delete' => [
            'title' => '是否删除',

            // 表单使用 input 类型 password
            'type' => 'bool',
        ],
    ],

    // 『数据过滤』设置
    'filters' => [
        'id' => [

            // 过滤表单条目显示名称
            'title' => '评论id',
        ],
        'content' => [
            'title' => '评论内容',
        ],
    ],
];