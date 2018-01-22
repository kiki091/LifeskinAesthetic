<form method="{{ $method  }}" action="{{$action }}" enctype="{{ $enctype }}" id="{{ $id or '' }}" class="{{ $class or '' }}" accept-charset="{{ $accept }}">


@if(isset($hidden) && $hidden)
	{{ csrf_field() }}
@endif

@if(isset($spoofmethod) && $spoofmethod)
	{{ method_field() }}
@endif
