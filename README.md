基于Laravel框架
前端使用Bootstrap Jquery
弹幕播放器使用DanmuPlayer
管理后台基于summerblue/administrator
用户切换使用viacreative/sudo-su


使用方式
1.git clone https://github.com/shadylplplp/video.git
2.在.env里设置数据库 SMTP服务器等配置
3.执行php artisan migrate:refresh --seed 填充数据库 就可以看到demo了
4.如果没有安装过ffmpeg 安装ffmpeg用来视频转码
5.执行php artisan queue:listen --timeout=3600 启用列队监听

默认用户id1为管理员 管理后台为/admin
默认邮箱输出在laravel的log文件中
