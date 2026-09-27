<x-layouts.app titulo="Agenda tu sesión gratuita"
                descripcion="Agenda tu sesión diagnóstica gratuita de 30 minutos con Dhessir Consultant. Te confirmamos horario por WhatsApp.">
    <x-encabezado-pagina eyebrow="Contacto" titulo="Hablemos de tu búsqueda de empleo">
        Agenda la sesión diagnóstica o escríbenos por el canal que prefieras. Respondemos en menos de 12 horas hábiles.
    </x-encabezado-pagina>

    <section class="bg-gris-50 py-12" aria-label="Canales de contacto">
        <div class="contenedor grid gap-4 md:grid-cols-3">
            @foreach ([
                ['WhatsApp Business', '+57 315 960 8790', 'https://wa.me/573159608790', 'Canal oficial de atención y cierre',
                 '<path d="M11 2a9 9 0 00-7.7 13.8L2 20l4.3-1.2A9 9 0 1011 2z" stroke="#035A55" stroke-width="1.7" stroke-linejoin="round"/>'],
                ['Correo', 'contacto@dhessir.co', 'mailto:contacto@dhessir.co', 'Para documentos y consultas',
                 '<rect x="2.5" y="4.5" width="17" height="13" rx="2" stroke="#035A55" stroke-width="1.7"/><path d="M3 6l8 6 8-6" stroke="#035A55" stroke-width="1.7" stroke-linejoin="round"/>'],
                ['Horario de atención', 'Lun a vie, 8:00 a.m. – 6:00 p.m.', null, 'Sábados, 9:00 a.m. – 1:00 p.m. (COT)',
                 '<circle cx="11" cy="11" r="8.5" stroke="#035A55" stroke-width="1.7"/><path d="M11 6.5V11l3 2" stroke="#035A55" stroke-width="1.7" stroke-linecap="round"/>'],
            ] as [$titulo, $valor, $enlace, $nota, $icono])
                <div class="tarjeta group revelar flex items-start gap-4 p-6">
                    <span class="flex size-12 shrink-0 items-center justify-center rounded-[10px] border border-gris-200 bg-gris-50 transition-all duration-300 ease-in-out group-hover:-rotate-6 group-hover:bg-white group-hover:shadow-md">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" aria-hidden="true">{!! $icono !!}</svg>
                    </span>
                    <div>
                        <p class="text-sm font-semibold tracking-[0.06em] text-teal-800 uppercase">{{ $titulo }}</p>
                        @if ($enlace)
                            <a href="{{ $enlace }}" @if (str_starts_with($enlace, 'http')) target="_blank" rel="noopener" @endif
                               class="font-display text-lg font-bold text-azul-900 underline-offset-4 hover:underline">{{ $valor }}</a>
                        @else
                            <p class="font-display text-lg font-bold text-azul-900">{{ $valor }}</p>
                        @endif
                        <p class="text-sm text-gris-600">{{ $nota }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    @include('secciones.agenda')
</x-layouts.app>
