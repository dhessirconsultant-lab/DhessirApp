@props(['eyebrow', 'titulo', 'id', 'centrado' => false, 'claro' => false])
<div {{ $attributes->class(['revelar mb-12 max-w-[70ch]', 'mx-auto text-center' => $centrado]) }}>
    <p @class(['eyebrow', '!text-teal-300' => $claro])>{{ $eyebrow }}</p>
    <h2 id="{{ $id }}" @class(['!text-white' => $claro])>{{ $titulo }}</h2>
    @if ($slot->isNotEmpty())
        <p @class(['lede mt-4', 'mx-auto' => $centrado, '!text-white/[0.78]' => $claro])>{{ $slot }}</p>
    @endif
</div>
