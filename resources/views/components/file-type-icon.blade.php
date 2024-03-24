@props([
    'filetype',
    'class' => '',
])
@if($filetype == 'pdf')
    <x-filetype-s-pdf {{$attributes->class(['w-6 h-6 text-gray-500'])}} />
@elseif($filetype == 'png' || $filetype == 'jpg' || $filetype == 'jpeg' || $filetype == 'gif' || $filetype == 'svg')
    <x-filetype-s-png {{$attributes->class(['w-6 h-6 text-gray-500'])}} />
@elseif($filetype == 'doc' ||  $filetype == 'docx')
    <x-filetype-s-doc {{$attributes->class(['w-6 h-6 text-gray-500'])}} />
@elseif($filetype == 'txt')
    <x-filetype-s-txt {{$attributes->class(['w-6 h-6 text-gray-500'])}} />
@elseif($filetype == 'xls' || $filetype == 'xlsx')
    <x-filetype-s-xls {{$attributes->class(['w-6 h-6 text-gray-500'])}} />
@elseif($filetype == 'ppt' || $filetype == 'pptx')
    <x-filetype-s-ppt {{$attributes->class(['w-6 h-6 text-gray-500'])}} />
@else
    <x-heroicon-o-document {{$attributes->class(['w-6 h-6 text-gray-500'])}} />
@endif
