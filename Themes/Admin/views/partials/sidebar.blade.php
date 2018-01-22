<aside class="main--sidebar">
    <a href="" target="_blank" class="main--logo flex vcenter center">
    	@component('slot.logo')    
        {{ asset('themes/admin/images/logo-facile.svg') }}
        @endcomponent
    </a>
    {!! $sidebar !!}
</aside>