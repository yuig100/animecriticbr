<div class="search-bar">
    <form action="{{ route('search') }}" method="GET">
        <input type="text" name="query" placeholder="{{ $placeholder }}" />
        <button type="submit" style="margin-top:5px;">Search</button>
    </form>
</div>
