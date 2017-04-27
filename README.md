# Yii2 后台模板
集成了rbac与AdminLTE

## Installation

```bash
# 安装
php composer install


# 测试环境
php init --env=Development --overwrite=n


# 导入SQL到MYSQL
sql/yii2.sql

```

```bash
server {
    listen       80;
    server_name local.yii2.com;
    index index.php;
    root   /data/yii2-advanced-template;

    location ~* \.(gif|jpg|jpeg|png|css|js|ico|swf|apk|ttf|woff|eof|svg|txt)$ {
        root   /data/open;
    }
    location / {
        if ($request_filename  !~* (js|css|images|txt|html|svg|woff|eof|ttf|wang)) {
                rewrite ^/(.+)$ /index.php/$1 last;
        }
    }

    location ~ \.php($|/) {
            fastcgi_pass   unix:/tmp/php-cgi.sock;
            fastcgi_index  index.php;
            fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
            fastcgi_param PATH_INFO $fastcgi_path_info;
            fastcgi_split_path_info ^(.+\.php)(.*)$;
            include        fastcgi_params;
    }
}
```

## Usage

http://local.yii2.com/backend/web/index.php