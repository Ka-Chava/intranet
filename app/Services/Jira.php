<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;



class Jira {

    protected $client;
    protected $domain = 'https://kachava.atlassian.net/rest/api/3';

    public function __construct()
    {
        $this->client = Http::acceptJson()
            ->withBasicAuth('oliver.haroun@kachava.com', getenv('JIRA_AUTH'));
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
