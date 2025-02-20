@php
    $links = [
        ['url' =>'dashboard', 'title' => 'Dashboard'],
        ['url' =>'dashboard', 'title' => 'Handbook'],
        ['url' =>'dashboard', 'title' => 'Company News'],
        ['url' =>'dashboard', 'title' => 'Helpdesk'],
        ['url' =>'dashboard', 'title' => 'Technology News'],
        ['url' =>'https://www.adp.com', 'title' => 'ADP'],
        ['url' =>'dashboard', 'title' => '401k'],
        ['url' =>'http://kachava.dash.app', 'title' => 'Dash'],
        ['url' =>'store', 'title' => 'Employee Store'],
    ]
@endphp
<aside class="side-nav">
    <x-aside.user-info />
    <div class="side-nav__nav mt-6 p-6">
        <h2>Organization</h2>
        <ul class="mt-6">
            @foreach ($links as $link)
                @php
                    $is_external = false;
                    if (str_starts_with($link['url'], 'http')) {
                        $url = $link['url'];
                        $is_external = true;
                    }
                    else {
                        $url = route($link['url']);
                     }
                @endphp
                <li><a href="{{ $url }}" {{ $is_external === true ? "target=_blank" : null }} class="p-2 {{ $is_external === true ? 'is-external' : 'is-local' }}">{{ $link['title'] }}</a></li>
            @endforeach
        </ul>
    </div>
</aside>

