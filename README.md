<p>基于Laravel框架</p>
<p>前端使用Bootstrap Jquery</p>
<p>弹幕播放器使用DanmuPlayer</p>
<p>管理后台基于summerblue/administrator</p>
<p>用户切换使用viacreative/sudo-su</p>

<p>使用方式</p>
<p>1.git clone https://github.com/shadylplplp/video.git</p>
<p>2.执行composer install</p>
<p>3.把.env.example修改成.env 里设置数据库 SMTP服务器等配置</p>
<p>4.执行php artisan key:generate生成key</p>
<p>5.执行php artisan migrate:refresh --seed 填充数据库 就可以看到demo了</p>
<p>6.如果没有安装过ffmpeg 安装ffmpeg用来视频转码</p>
<p>7.执行php artisan queue:listen --timeout=3600 启用列队监听</p>

<p>默认用户id1为管理员 管理后台为/admin</p>
