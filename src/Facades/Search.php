<?php namespace Sunny\OpenSearch\Facades;

use Illuminate\Support\Facades\Facade;

class Search extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'search';
    }
}
