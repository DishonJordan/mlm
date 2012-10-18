@layout("layout.main")

@section("content")
@include("maps.menu")
<div id="content" class="maps clearfix">
<div id="page" class="maxwidth">
<div id="multiview">
<ul class="{{ Cookie::get_raw("multiview", 'grid') }}">
@foreach ($maps->results as $map)
	<li>
		<a href="{{ URL::to_action("maps@view", array($map->id, $map->slug)) }}" title="">
		<div class="mv-image">
		@if($map->image)
		{{ HTML::image($map->image->file_medium) }}
		@else
		<img src="{{ URL::to_asset("images/static/noimage.jpg") }}" alt="No Images found" />
		@endif
		</div>
		<div class="mv-details">
		<div class="mv-title"><h1>{{ e($map->title) }}</h1></div>
		<div class="mv-summary"><p>{{ $map->summary }}</p></div>
		<div class="mv-meta">
			<span>By 
				@foreach($map->users as $author)
				<b>{{ $author->username }}</b>,
				@endforeach
			</span>
			<span>Version <b>{{$map->version}}</b>,</span>
			@unless($map->published)
			<p><strong>This map isn't yet published</strong></p>
			@endunless
			<span>Type: <b>{{ array_get(Config::get("maps.types"), $map->maptype) }}</b></span>
		</div>
		</div>
		</a>
	</li>
@endforeach
</ul>
</div>
<div id="loadmore">{{ $maps->links() }}</div>
</div>
</div>
@endsection