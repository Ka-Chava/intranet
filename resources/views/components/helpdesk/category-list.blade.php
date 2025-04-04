<div class="helpdesk-category-list">
    @foreach($categories as $category)
        <x-helpdesk.category :$category />
    @endforeach
</div>
