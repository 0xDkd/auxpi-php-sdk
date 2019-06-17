<h1 align="center"> auxpi </h1>

<p align="center"> A auxpi ADK.</p>


## 安装

```shell
$ composer require aimer/auxpi -vvv
```

## 使用

你可以在 `src/index.php` 找到实例代码

### 上传图片

```php
use Aimer\Auxpi\Api;

include_once "../vendor/autoload.php";

$url = "http://你的图床/api/";
$token = "你的 Token";
$api = new Api($url, $token);
$v1 = $api->uploadImageV1('sougou '123.png');
$v2 = $api->uploadImageV2('123.png');


echo 'Version 1 Link:'.  $v1['data']['url']. "\r\n";
echo 'Version 2 Link:'. $v2['data']['url'] . "\r\n";
```

`uploadImageV1($select,$path)` 方法可以上传到指定图床其中`$select` 为要进行上传的图床，`$path` 为图片的存储路径。返回一个数组，格式如下:

```text
array(3) {
  ["code"]=>
  int(200)
  ["msg"]=>
  string(2) "ok"
  ["data"]=>
  array(3) {
    ["delete"]=>
    string(0) ""
    ["name"]=>
    string(7) "123.png"
    ["url"]=>
    string(71) "https://cy-pic.kuaizhan.com/g3/8a/79/3e25-c3f6-4d59-8e73-caa980b87f2d51"
  }
}
```

`uploadImageV2($path)` 方法是上传图片到你的服务器，并且获取分发链接，具体上传到那个图床由你的服务器决定。返回一个数组，格式如下:

```text
array(3) {
  ["code"]=>
  int(200)
  ["msg"]=>
  string(2) "ok"
  ["data"]=>
  array(2) {
    ["name"]=>
    string(7) "123.png"
    ["url"]=>
    string(66) "https://test.demo-1s.com/dispatch/46a13a9329ff4e2fc60e8e0d46b7c5cc"
  }
}
```

`$select` 的可选值如下

```text
sougou # 搜狗图床
sina   # 新浪图床
smms   #smms 图床
cc     #upload.cc
flickr #flickr
imgur  #imgur
prnt   #prnt
neteasy #网易
jd      #京东
juejin  #掘金
ali     #阿里
local   #本地
suning  #苏宁
xiaomi  #小米
vim     #Vim-CN
ooxx    #OOXX
souhu   #搜狐
github  #Github
toutiao #头条
gitee   #gitee 
```

### 运行示例代码

```php
cd src
php index.php
```

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/aimer/auxpi/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/aimer/auxpi/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT

