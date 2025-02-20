@if($hasAnnouncements)
<div class="announcement">
    <h2>{{ $announcement->title }}</h2>
    <p>{{ $announcement->content }}</p>
</div>
@endif

