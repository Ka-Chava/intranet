<?php

use Illuminate\Support\Facades\Http;
$response = app('jira')->getUnresolvedIssues();

dd($response->json());
?>
<x-app-layout>

</x-app-layout>
