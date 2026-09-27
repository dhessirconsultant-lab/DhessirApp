@props([
    'titulo' => 'Consultoría de empleo',
    'descripcion' => '¿Aplicas y no te llaman? Ajustamos tu hoja de vida a los filtros ATS y te preparamos para la entrevista. Agenda tu sesión gratuita de 30 minutos.',
])
@php
    $menu = [
        ['ruta' => 'inicio',   'texto' => 'Inicio'],
        ['ruta' => 'metodo',   'texto' => 'Método'],
        ['ruta' => 'planes',   'texto' => 'Planes'],
        ['ruta' => 'nosotros', 'texto' => 'Nosotros'],
        ['ruta' => 'contacto', 'texto' => 'Contacto'],
    ];
    // En Inicio y Contacto el formulario está en la misma página
    $agenda = request()->routeIs('inicio', 'contacto') ? '#agenda' : route('contacto').'#agenda';
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $titulo }} | Dhessir</title>
    <meta name="description" content="{{ $descripcion }}">
    <meta name="theme-color" content="#184264">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $titulo }} | Dhessir">
    <meta property="og:description" content="{{ $descripcion }}">
    <meta property="og:locale" content="es_CO">
    <link rel="icon" href="{{ asset('images/favicon-32.png') }}" type="image/png" sizes="32x32">
    <link rel="icon" href="{{ asset('images/favicon.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" href="{{ asset('images/favicon-180.png') }}">
    <script>document.documentElement.classList.add('js')</script>
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="pb-[76px] md:pb-0">

<a href="#contenido"
   class="absolute top-[-100px] left-4 z-[2000] rounded-marca bg-acento px-5 py-3 font-display font-bold text-azul-900 transition-[top] duration-150 focus:top-4">
    Saltar al contenido principal
</a>

{{-- ══ ENCABEZADO FIJO ══ --}}
<header class="sticky top-0 z-50 border-b border-gris-200 bg-white/[0.88] backdrop-blur-md transition-shadow duration-300" data-encabezado>
    <div class="contenedor flex min-h-[72px] items-center gap-8">
        <a href="{{ route('inicio') }}" class="group flex shrink-0 items-center" aria-label="Dhessir Consultant, ir al inicio">
            <x-logo class="h-10 w-auto transition-transform duration-300 ease-in-out group-hover:scale-105" />
        </a>

        <nav class="ml-auto hidden items-center gap-6 lg:flex" aria-label="Navegación principal">
            <ul class="flex items-center gap-1">
                @foreach ($menu as $item)
                    <li>
                        <a href="{{ route($item['ruta']) }}"
                           @if (request()->routeIs($item['ruta'])) aria-current="page" @endif
                           class="relative flex min-h-11 items-center rounded-lg px-3 font-display text-[0.9375rem] font-semibold text-azul-900 no-underline transition-all duration-300 ease-in-out hover:-translate-y-0.5 hover:bg-gris-50 aria-[current=page]:text-teal-800
                                  after:absolute after:inset-x-3 after:bottom-1.5 after:h-0.5 after:origin-left after:scale-x-0 after:rounded-full after:bg-teal-800 after:transition-transform after:duration-300 after:ease-in-out hover:after:scale-x-100 aria-[current=page]:after:scale-x-100">
                            {{ $item['texto'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
            <a class="btn-primario" href="{{ $agenda }}">Agenda tu sesión gratuita</a>
        </nav>

        <button type="button"
                class="ml-auto flex size-12 cursor-pointer items-center justify-center rounded-[10px] border border-gris-200 bg-white shadow-sm transition-all duration-300 ease-in-out hover:-translate-y-0.5 hover:shadow-lg lg:hidden"
                aria-label="Abrir menú de navegación" aria-expanded="false" aria-controls="menu-movil" data-abrir-menu>
            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" aria-hidden="true">
                <path d="M3 6h16M3 11h16M3 16h16" stroke="#184264" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </button>
    </div>
</header>

{{-- Menú móvil a pantalla completa --}}
<div id="menu-movil" class="fixed inset-0 z-[1500] hidden flex-col overflow-y-auto bg-azul-900 p-6 data-[abierto=true]:flex"
     data-abierto="false" role="dialog" aria-modal="true" aria-label="Menú de navegación">
    <div class="flex min-h-12 items-center justify-between">
        <x-logo claro class="h-9 w-auto" />
        <button type="button" data-cerrar-menu aria-label="Cerrar menú"
                class="flex size-12 cursor-pointer items-center justify-center rounded-[10px] border border-white/30 text-2xl leading-none text-white transition-all duration-300 hover:rotate-90 hover:bg-white/10">
            &times;
        </button>
    </div>
    <ul class="mt-12 flex flex-col gap-2">
        @foreach ($menu as $i => $item)
            <li class="animate-aparecer" style="animation-delay: {{ 60 * $i }}ms">
                <a href="{{ route($item['ruta']) }}" data-cerrar-menu
                   @if (request()->routeIs($item['ruta'])) aria-current="page" @endif
                   class="flex min-h-14 items-center justify-between border-b border-teal-300/25 font-display text-h4 font-semibold text-white no-underline transition-all duration-300 hover:pl-2 hover:text-teal-300 aria-[current=page]:text-teal-300">
                    {{ $item['texto'] }}
                    <span aria-hidden="true">→</span>
                </a>
            </li>
        @endforeach
        <li class="animate-aparecer" style="animation-delay: 300ms">
            <a href="{{ route('planes') }}#faq" data-cerrar-menu
               class="flex min-h-14 items-center justify-between border-b border-teal-300/25 font-display text-h4 font-semibold text-white no-underline transition-all duration-300 hover:pl-2 hover:text-teal-300">
                Preguntas frecuentes
                <span aria-hidden="true">→</span>
            </a>
        </li>
    </ul>
    <a class="btn-primario mt-auto w-full" href="{{ $agenda }}" data-cerrar-menu>Agenda tu sesión gratuita</a>
</div>

<main id="contenido">
    {{ $slot }}
</main>

{{-- ══ PIE DE PÁGINA ══ --}}
<footer class="bg-azul-950 pt-16 pb-8 text-sm text-white/[0.72]">
    <div class="contenedor">
        <div class="grid gap-12 md:grid-cols-2 lg:grid-cols-[1.3fr_1fr_1fr]">
            <div>
                <a href="{{ route('inicio') }}" class="mb-6 inline-block" aria-label="Dhessir Consultant, ir al inicio">
                    <x-logo claro class="h-12 w-auto" />
                </a>
                <dl class="flex flex-col gap-2.5">
                    <div>
                        <dt class="mb-0.5 text-xs tracking-[0.08em] text-teal-300 uppercase">Razón social</dt>
                        <dd class="text-white/[0.82]">Dhessir Consultant</dd>
                    </div>
                    <div>
                        <dt class="mb-0.5 text-xs tracking-[0.08em] text-teal-300 uppercase">Correo</dt>
                        <dd><a class="text-white/[0.82] transition-colors duration-300 hover:text-white" href="mailto:contacto@dhessir.co">contacto@dhessir.co</a></dd>
                    </div>
                    <div>
                        <dt class="mb-0.5 text-xs tracking-[0.08em] text-teal-300 uppercase">WhatsApp Business</dt>
                        <dd><a class="text-white/[0.82] transition-colors duration-300 hover:text-white" href="https://wa.me/573159608790" target="_blank" rel="noopener">+57 315 960 8790</a></dd>
                    </div>
                    <div>
                        <dt class="mb-0.5 text-xs tracking-[0.08em] text-teal-300 uppercase">Ciudad de operación</dt>
                        <dd class="text-white/[0.82]">Bogotá, Colombia · atención 100&nbsp;% virtual</dd>
                    </div>
                    <div>
                        <dt class="mb-0.5 text-xs tracking-[0.08em] text-teal-300 uppercase">Horario de atención</dt>
                        <dd class="text-white/[0.82]">Lunes a viernes, 8:00 a.m. – 6:00 p.m.<br>Sábados, 9:00 a.m. – 1:00 p.m. (COT)</dd>
                    </div>
                </dl>
            </div>

            <nav aria-label="Navegación del pie de página">
                <p class="mb-4 font-display text-sm font-bold tracking-[0.12em] text-teal-300 uppercase">Navegación</p>
                <ul class="flex flex-col gap-1">
                    @foreach ([
                        [route('inicio'), 'Inicio'],
                        [route('metodo'), 'Método PREP'],
                        [route('planes'), 'Planes y precios'],
                        [route('inicio').'#casos', 'Casos'],
                        [route('nosotros').'#podcast', 'Podcast'],
                        [route('nosotros').'#blog', 'Blog'],
                        [route('planes').'#faq', 'Preguntas frecuentes'],
                        [route('contacto'), 'Agenda tu sesión'],
                    ] as [$href, $texto])
                        <li>
                            <a href="{{ $href }}" class="inline-flex min-h-11 items-center text-white/[0.78] no-underline transition-all duration-300 hover:translate-x-1 hover:text-white">{{ $texto }}</a>
                        </li>
                    @endforeach
                </ul>
            </nav>

            <div>
                <p class="mb-4 font-display text-sm font-bold tracking-[0.12em] text-teal-300 uppercase">Legal</p>
                <ul class="flex flex-col gap-1">
                    <li><a href="{{ route('politica') }}" class="inline-flex min-h-11 items-center text-white/[0.78] no-underline transition-all duration-300 hover:translate-x-1 hover:text-white">Política de tratamiento de datos personales</a></li>
                    <li><a href="{{ route('politica') }}#terminos" class="inline-flex min-h-11 items-center text-white/[0.78] no-underline transition-all duration-300 hover:translate-x-1 hover:text-white">Términos y condiciones</a></li>
                    <li><a href="{{ route('politica') }}#cookies" class="inline-flex min-h-11 items-center text-white/[0.78] no-underline transition-all duration-300 hover:translate-x-1 hover:text-white">Política de cookies</a></li>
                </ul>

                <p class="mt-8 mb-4 font-display text-sm font-bold tracking-[0.12em] text-teal-300 uppercase">Síguenos</p>
                <div class="flex gap-2">
                    @php $red = 'flex size-11 items-center justify-center rounded-[10px] border border-teal-300/35 text-teal-300 transition-all duration-300 ease-in-out hover:-translate-y-1 hover:bg-teal-300/15 hover:text-white hover:shadow-lg'; @endphp
                    <a href="https://instagram.com/dhessirco" target="_blank" rel="noopener" aria-label="Dhessir en Instagram" class="{{ $red }}">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M10 1.8c2.67 0 2.99.01 4.04.06 1.05.05 1.62.22 2 .37.47.18.82.41 1.18.77.36.36.59.71.77 1.18.15.38.32.95.37 2 .05 1.05.06 1.37.06 4.04s-.01 2.99-.06 4.04c-.05 1.05-.22 1.62-.37 2-.18.47-.41.82-.77 1.18-.36.36-.71.59-1.18.77-.38.15-.95.32-2 .37-1.05.05-1.37.06-4.04.06s-2.99-.01-4.04-.06c-1.05-.05-1.62-.22-2-.37a3.18 3.18 0 01-1.18-.77 3.18 3.18 0 01-.77-1.18c-.15-.38-.32-.95-.37-2C1.81 12.99 1.8 12.67 1.8 10s.01-2.99.06-4.04c.05-1.05.22-1.62.37-2 .18-.47.41-.82.77-1.18.36-.36.71-.59 1.18-.77.38-.15.95-.32 2-.37C7.01 1.81 7.33 1.8 10 1.8zm0 3.78a4.42 4.42 0 100 8.84 4.42 4.42 0 000-8.84zm0 7.29a2.87 2.87 0 110-5.74 2.87 2.87 0 010 5.74zm5.62-7.47a1.03 1.03 0 11-2.07 0 1.03 1.03 0 012.07 0z"/></svg>
                    </a>
                    <a href="https://www.linkedin.com/in/dhessir" target="_blank" rel="noopener" aria-label="Dhessir en LinkedIn" class="{{ $red }}">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M17 1H3a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V3a2 2 0 00-2-2zM6.5 16h-2.5V8h2.5v8zM5.2 6.7A1.45 1.45 0 115.2 3.8a1.45 1.45 0 010 2.9zM16 16h-2.5v-4.3c0-1-.4-1.7-1.3-1.7-.7 0-1.1.5-1.3 1-.1.2-.1.4-.1.7V16H7.5s.03-7.2 0-8H10v1.1c.3-.5 1-1.3 2.4-1.3 1.8 0 3.1 1.2 3.1 3.7V16z"/></svg>
                    </a>
                    <a href="https://tiktok.com/@dhessirco" target="_blank" rel="noopener" aria-label="Dhessir en TikTok" class="{{ $red }}">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M11.2 1.5h2.9c.2 1.9 1.6 3.4 3.5 3.6v2.9a6.6 6.6 0 01-3.5-1.1v6.1a5.4 5.4 0 11-5.4-5.4c.3 0 .6 0 .9.1v3a2.5 2.5 0 101.6 2.3V1.5z"/></svg>
                    </a>
                    <a href="{{ config('dhessir.spotify') }}" target="_blank" rel="noopener" aria-label="Podcast de Dhessir en Spotify" class="{{ $red }}">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M10 1a9 9 0 100 18 9 9 0 000-18zm4.2 13.1a.7.7 0 01-.96.23c-2.64-1.61-5.96-1.97-9.86-1.08a.7.7 0 11-.31-1.37c4.28-.98 7.95-.56 10.9 1.25.33.2.44.63.23.97zm1.11-2.48a.88.88 0 01-1.2.29c-3.02-1.86-7.62-2.4-11.19-1.31a.88.88 0 11-.51-1.68c4.08-1.24 9.15-.64 12.62 1.5.41.25.54.79.28 1.2zm.1-2.58c-3.63-2.15-9.4-2.35-12.86-1.3a1.05 1.05 0 11-.61-2.02c3.98-1.2 10.35-.98 14.42 1.44a1.05 1.05 0 01-1.07 1.81z"/></svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-12 flex flex-col items-start justify-between gap-6 border-t border-teal-300/20 pt-6 md:flex-row md:flex-wrap md:items-center">
            <div class="flex flex-wrap gap-2">
                <span class="inline-flex items-center gap-1.5 rounded-lg border border-teal-300/30 px-3 py-1.5 text-xs text-white/75">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true"><path d="M4 6.3V4.5a3 3 0 016 0v1.8M2.8 6.3h8.4v5.2H2.8V6.3z" stroke="#76ABA5" stroke-width="1.3" stroke-linejoin="round"/></svg>
                    Sitio seguro · SSL
                </span>
                <span class="inline-flex items-center rounded-lg border border-teal-300/30 px-3 py-1.5 text-xs text-white/75">Tarjeta débito y crédito</span>
                <span class="inline-flex items-center rounded-lg border border-teal-300/30 px-3 py-1.5 text-xs text-white/75">PSE</span>
                <span class="inline-flex items-center rounded-lg border border-teal-300/30 px-3 py-1.5 text-xs text-white/75">Nequi</span>
            </div>
            <p>&copy; {{ date('Y') }} Dhessir Consultant. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>

{{-- ══ BARRA MÓVIL DE CONVERSIÓN · aparece tras 400px de scroll ══ --}}
<div id="barra-movil" data-visible="false"
     class="fixed inset-x-0 bottom-0 z-40 translate-y-full border-t border-gris-200 bg-white/95 px-4 py-3 shadow-2xl backdrop-blur-md transition-transform duration-300 ease-in-out data-[visible=true]:translate-y-0 md:hidden">
    <a class="btn-primario w-full" href="{{ $agenda }}">Agenda tu sesión gratuita · sin costo</a>
</div>

</body>
</html>
