<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;



class Jira {

    protected $client;
    protected $domain = 'https://kachava.atlassian.net/rest/api/3';

    public function __construct()
    {
        $this->client = Http::acceptJson()
            ->withBasicAuth('oliver.haroun@kachava.com', 'ATATT3xFfGF0l0D_pwbu7OOjIIKykd1CM3-UaZdc1RsgWsT7JYnIFFbGpFjcqnM29V5MCPCkTej9-1NoqJ5DfSkh-J84Z5y4Df4k56s9WVOHYnDxVZD4bj8RiZQhy6FBHz0UrA7V28O2cRUTHTwlFYQ0F_JW0FrkA1qb0nczZ7FUrB_MvR5NR8A=2729E8B4');
    }

    protected function formatUrl($url)
    {
        if(!str_starts_with($url, '/')) {
            $url = '/' . $url;
        }
        return $this->domain . $url;
    }

    public function get($url) {
        return $this->client->get($this->formatUrl($url));
    }

    public function getUnresolvedIssues() {
        return $this->get('/issue/picker?currentJQL=project=IT AND status!=resolved');
    }
}
