{{-- ══ 9 · PODCAST ══ --}}
{{-- Pendiente: reemplazar la lista por el iframe oficial de Spotify cuando se tenga el show ID:
     <iframe class="rounded-marca" src="https://open.spotify.com/embed/show/SHOW_ID" width="100%" height="352" allow="clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy" title="Podcast de Dhessir Consultant"></iframe> --}}
@php $spotify = 'https://open.spotify.com/search/Dhessir'; @endphp
<section class="bg-gris-50 py-12 md:py-16" id="podcast" aria-labelledby="podcast-titulo">
    <div class="contenedor grid items-center gap-8 lg:grid-cols-[1fr_1.2fr] lg:gap-12">
        <div class="revelar">
            <p class="eyebrow">Podcast</p>
            <h2 id="podcast-titulo">Escúchanos antes de contratarnos</h2>
            <p class="lede mt-4">El criterio con el que trabajamos está publicado y es gratis. Si lo que decimos en el podcast te sirve, la sesión te va a servir más.</p>
            <a class="btn-secundario mt-6" href="{{ $spotify }}" target="_blank" rel="noopener">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="currentColor" aria-hidden="true"><path d="M9 .8a8.2 8.2 0 100 16.4A8.2 8.2 0 009 .8zm3.8 11.9a.64.64 0 01-.88.21c-2.4-1.47-5.42-1.8-8.98-.99a.64.64 0 11-.28-1.25c3.9-.89 7.24-.5 9.93 1.14.3.19.4.58.21.89zm1.01-2.26a.8.8 0 01-1.1.26c-2.75-1.69-6.94-2.18-10.19-1.19a.8.8 0 11-.46-1.53c3.71-1.13 8.33-.58 11.49 1.36a.8.8 0 01.26 1.1zm.09-2.35C10.6 6.13 5.35 5.95 2.2 6.9a.96.96 0 11-.56-1.84c3.62-1.1 9.42-.89 13.13 1.31a.96.96 0 01-.98 1.65z"/></svg>
                Ver todos los episodios en Spotify
            </a>
        </div>

        <div class="revelar rounded-marca border border-gris-200 bg-white p-6 shadow-xl">
            <ul>
                @foreach ([
                    ['Por qué tu hoja de vida no llega a un humano', 'Episodio 03 · Filtros ATS', '24 min'],
                    ['STAR: la estructura que esperan los reclutadores', 'Episodio 02 · Entrevistas', '31 min'],
                    ['Aplicar a menos vacantes para conseguir más entrevistas', 'Episodio 01 · Estrategia', '19 min'],
                ] as [$titulo, $meta, $duracion])
                    <li class="border-b border-gris-200 last:border-b-0">
                        <a href="{{ $spotify }}" target="_blank" rel="noopener" aria-label="Escuchar en Spotify: {{ $titulo }}"
                           class="group -mx-3 grid grid-cols-[44px_1fr_auto] items-center gap-3.5 rounded-lg px-3 py-3.5 no-underline transition-all duration-300 ease-in-out hover:bg-gris-50 hover:shadow-sm">
                            <span class="flex size-11 items-center justify-center rounded-full bg-teal-800 shadow-md transition-all duration-300 ease-in-out group-hover:scale-110 group-hover:bg-azul-900 group-hover:shadow-lg">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="#fff" aria-hidden="true"><path d="M4 2.5l7 4.5-7 4.5V2.5z"/></svg>
                            </span>
                            <span>
                                <span class="block font-display leading-[1.35] font-semibold text-azul-900">{{ $titulo }}</span>
                                <span class="mt-0.5 block text-sm text-gris-600">{{ $meta }}</span>
                            </span>
                            <span class="text-sm text-gris-600 tabular-nums">{{ $duracion }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
