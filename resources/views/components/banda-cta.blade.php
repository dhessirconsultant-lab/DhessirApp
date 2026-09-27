@props(['titulo' => '¿Listo para saber en qué punto te estás quedando?'])
{{-- Franja de cierre de las páginas internas: lleva al formulario de agendamiento --}}
<section class="bg-white py-12 md:py-16" aria-labelledby="cta-titulo">
    <div class="contenedor">
        <div class="revelar relative overflow-hidden rounded-marca bg-azul-900 px-6 py-10 shadow-2xl md:px-12 md:py-12">
            <div class="pointer-events-none absolute -right-16 -bottom-16 size-64 rounded-full bg-teal-300/15" aria-hidden="true"></div>
            <div class="relative flex flex-col items-start gap-6 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h2 id="cta-titulo" class="!text-[1.5rem] !text-white md:!text-h3">{{ $titulo }}</h2>
                    <p class="mt-2 text-white/[0.78]">30 minutos por videollamada, sin costo y sin compromiso de compra.</p>
                </div>
                <a class="btn-primario w-full shrink-0 lg:w-auto" href="{{ route('contacto') }}#agenda">Agenda tu sesión gratuita</a>
            </div>
        </div>
    </div>
</section>
