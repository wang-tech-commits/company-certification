# company-certification

>企业认证

## 1.安装

```shell script
composer require wang-tech-commits/company-certification
```

## 2.初始化

```shell script
php artisan vendor:publish --provider="MrwangTc\CompanyCertification\ServiceProvider"

php artisan migrate
```

## 3.使用

### 1.调整用户模型

```php
<?php

use MrwangTc\CompanyCertification\Certification\Traits\UserHasCompanyCertification;

class User {

    use UserHasCompanyCertification;
}
```

### 2.增加路由

```php
<?php

use MrwangTc\CompanyCertification\CompanyCertification;


/**
 * $prefix string 路由前缀
 * 当前方法推荐放置于需授权的路由作用域内
 */
CompanyCertification::routes('user');

```