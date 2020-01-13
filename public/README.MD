基于Laravel平台的弹幕视频网站 
前端使用Bootstrap和jquery 
弹幕播放器基于DanmuPlayer 
使用ffmpeg视频转码
后台使用summerblue/administrator
用户切换使用viacreative/sudo-su

使用步骤
1.项目需要使用ffmepg 需要先安装

2.git clone https://github.com/shadylplplp/video.git

3.进入.env  修改数据库等配置

4.php artisan migrate:refresh --seed 数据库自动填充 就可以看到demo的样子 
可以使用右下角的用户切换更换用户 默认用户ID 1和2的用户为管理员