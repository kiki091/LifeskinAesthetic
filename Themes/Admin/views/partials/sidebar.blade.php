<aside class="main--sidebar">
    <a href="" target="_blank" class="main--logo flex vcenter center">
    	@component('slot.logo')    
        {{ Theme::url('images/logo-facile.svg') }}
        @endcomponent
    </a>
    {!! $sidebar !!}
</aside>