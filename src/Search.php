<?php
/**
 * openSearch类
 */

namespace Sunny\OpenSearch;

//引入头文件
require_once("OpenSearch/Autoloader/Autoloader.php");
use OpenSearch\Client\OpenSearchClient;
use OpenSearch\Client\SearchClient;
use OpenSearch\Util\SearchParamsBuilder;
use Illuminate\Config\Repository;

class Search {

    /**
     * @var Repository
     */
    protected $config;

    private $client;

    public function __construct(Repository $config) {
        $this->config = $config;

        //创建OpenSearchClient客户端对象
        $this->client = new OpenSearchClient($this->config->get('opensearch.ACCESS_KEY_ID'),
        $this->config->get('opensearch.ACCESS_KEY_SECRET'),
        $this->config->get('opensearch.ENDPOINT'),
        $this->config->get('opensearch.options'));
    }

    /**
     * 搜索知识点
     * @param $field
     * @param $keyword
     * @param int $hits
     */
    public function getSearch($keyword, $hits = 5) {
        $app_name = $this->config->get('opensearch.app_name');
        $field    = $this->config->get('opensearch.index_name');
        $qp       = $this->config->get('opensearch.app_qp');
        // 实例化一个搜索类
        $searchClient = new SearchClient($this->client);
        // 实例化一个搜索参数类
        $params = new SearchParamsBuilder();
        //设置config子句的start值
        $params->setStart(0);
        //设置config子句的hit值--返回结果条数
        $params->setHits($hits);
        // 指定一个应用用于搜索
        $params->setAppName($app_name);
        // 指定搜索关键词
        $params->setQuery("{$field}:'{$keyword}'");
        // 指定返回的搜索结果的格式为json
        $params->setFormat("fulljson");
        //添加排序字段
        //$params->addSort('RANK', SearchParamsBuilder::SORT_DECREASE);
        //添加查询分析功能
        $params->addQueryProcessor($qp);
        // 执行搜索，获取搜索结果
        $ret = $searchClient->execute($params->build());
        //打印调试信息
        //echo $ret->traceInfo->tracer;

        return json_decode($ret->result,true); // 将json类型字符串解码
    }
}
