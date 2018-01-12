# Aliyun OpenSearch

> 基于 阿里云 开放搜索 SDK

> 应用于 Laravel 5.5

## 安装

1. 安装包文件
    ```bash
    $ composer require feng18/aliyun-opensearch
    ```

## 配置

1. 在`config/app.php`文件中注册 provider 和 facade：

    ```php
    'providers' => [
        ...,
        Sunny\OpenSearch\OpenSearchServiceProvider::class,
    ]

    'aliases' => [
        ...,
        'OpenSearch' => Sunny\OpenSearch\Facades\Search::class,
    ]
    ```

2. 创建配置文件：

    ```bash
    $ php artisan vendor:publish --provider=Sunny\OpenSearch\OpenSearchServiceProvider
    ```

3. 请修改应用根目录下的 `config/opensearch.php` 中对应的项即可；
