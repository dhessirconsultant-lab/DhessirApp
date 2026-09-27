<x-layouts.app titulo="Nosotros"
                descripcion="Conoce a Jerónimo Rocha, consultor principal de Dhessir, escucha el podcast y lee el blog sobre búsqueda de empleo.">
    <x-encabezado-pagina eyebrow="Nosotros" titulo="Del otro lado de la mesa de selección">
        Dhessir es una consultoría de empleabilidad 100&nbsp;% virtual desde Bogotá. Te asesora alguien que ha estado en procesos de selección, no un curso grabado.
    </x-encabezado-pagina>
    @include('secciones.consultor')
    @include('secciones.podcast')
    @include('secciones.blog')
    <x-banda-cta />
</x-layouts.app>
