@if($group->shouldShowHeading())
    <li class="menu--title"><span>{{ $group->getName() }}</span></li>
@endif

@foreach($items as $item)
    {!! $item !!}
@endforeach
