<x-layouts.app titulo="Planes y precios"
                descripcion="Planes Brújula, Mapa y Expedición con precios visibles. Todos parten de una sesión diagnóstica gratuita de 30 minutos.">
    <x-encabezado-pagina eyebrow="Planes" titulo="Tres planes, un mismo punto de partida">
        Todos empiezan con la sesión diagnóstica gratuita. Ahí vemos cuál te corresponde — o si no necesitas ninguno.
    </x-encabezado-pagina>
    @include('secciones.planes')
    @include('secciones.faq')
    <x-banda-cta titulo="¿No sabes cuál plan te corresponde?" />
</x-layouts.app>
