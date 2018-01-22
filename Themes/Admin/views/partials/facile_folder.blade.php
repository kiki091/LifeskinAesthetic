<?php
$folder = DataHelper::getFolderPerPage();
?>
@if(! empty($folder) )
    @foreach ($folder as $key => $value)
        <a href="#{{ $value['slug'] or '' }}" onclick="{{ $value['url'].'()' }}" class="folder--nav--link">
            <i class="ico-{{ $value['icon'] or '' }}">@include('ayana.cms.svg-logo.ico-folder-link.ico-'.$value['icon'])</i>
            <span class="folder--nav--link--span">{{ $value['name'] or '' }}</span>
        </a>
    @endforeach
@endif