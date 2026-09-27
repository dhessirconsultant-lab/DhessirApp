{{-- ══ 13 · AGENDAMIENTO · núcleo del embudo ══ --}}
@php
    $campo = 'min-h-12 w-full rounded-lg border bg-white px-3.5 py-3 font-body text-base text-texto shadow-xs transition-all duration-300 ease-in-out placeholder:text-gris-600/75 hover:border-teal-500 focus:border-teal-800 focus:shadow-md';
    $etiqueta = 'mb-1.5 block font-display text-sm font-semibold text-azul-900';
    $borde = fn (string $nombre) => $errors->has($nombre) ? 'border-error' : 'border-gris-200';
@endphp
<section class="bg-azul-900 py-12 text-white md:py-16" id="agenda" aria-labelledby="agenda-titulo">
    <div class="contenedor grid items-start gap-8 lg:grid-cols-[1fr_1.1fr] lg:gap-12">
        <div class="revelar">
            <p class="eyebrow !text-teal-300">Sesión diagnóstica gratuita</p>
            <h2 id="agenda-titulo" class="!text-white">30 minutos para saber qué está pasando</h2>
            <p class="mt-4 max-w-[52ch] text-lg text-white/[0.78]">Sin costo, sin compromiso de compra y sin discurso de ventas. Esto es lo que revisamos en esos 30 minutos:</p>

            <ol class="mt-8 flex flex-col gap-4">
                @foreach ([
                    ['Tu hoja de vida actual', 'Si la tienes a mano, la abrimos en la llamada y te mostramos qué está bloqueando la lectura del sistema.'],
                    ['Dónde se cae el proceso', 'Identificamos si el problema está en el documento, en la entrevista o en el rumbo al que estás aplicando.'],
                    ['Qué harías distinto esta semana', 'Sales con dos o tres acciones concretas, aunque no contrates ningún plan.'],
                    ['Qué plan te corresponde', 'Te recomendamos uno de los tres — o te decimos que no necesitas ninguno.'],
                ] as $i => [$titulo, $texto])
                    <li class="group grid grid-cols-[32px_1fr] items-start gap-3.5">
                        <span class="flex size-8 items-center justify-center rounded-full border border-teal-300/45 bg-teal-300/20 font-display text-sm font-bold text-teal-300 transition-all duration-300 ease-in-out group-hover:scale-110 group-hover:bg-teal-300 group-hover:text-azul-900">{{ $i + 1 }}</span>
                        <div>
                            <strong class="mb-0.5 block font-display text-white">{{ $titulo }}</strong>
                            <span class="text-sm leading-normal text-white/70">{{ $texto }}</span>
                        </div>
                    </li>
                @endforeach
            </ol>
        </div>

        <form method="POST" action="{{ route('solicitudes.store') }}" novalidate data-formulario
              class="revelar rounded-marca bg-white p-6 text-texto shadow-2xl md:p-8">
            @csrf
            <input type="hidden" name="origen" value="{{ request()->routeIs('contacto') ? 'contacto' : 'inicio' }}">

            @if (session('solicitud_enviada'))
                <div class="mb-6 animate-aparecer rounded-lg border-l-4 border-teal-800 bg-teal-800/7 p-4" role="status">
                    <strong class="block font-display text-azul-900">¡Recibimos tu solicitud!</strong>
                    <span class="text-sm text-gris-600">Te confirmamos horario por WhatsApp en menos de 12 horas hábiles.</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-lg border-l-4 border-error bg-error/6 p-4 text-sm text-error" role="alert">
                    Revisa los campos marcados para poder agendar tu sesión.
                </div>
            @endif

            {{-- Campo trampa contra bots: las personas no lo ven ni lo llenan --}}
            <div class="absolute -left-[9999px]" aria-hidden="true">
                <label for="sitio_web">No llenes este campo</label>
                <input type="text" id="sitio_web" name="sitio_web" tabindex="-1" autocomplete="off">
            </div>

            <div class="mb-6">
                <label for="nombre" class="{{ $etiqueta }}">Nombre completo <span class="text-error" aria-hidden="true">*</span></label>
                <input type="text" id="nombre" name="nombre" autocomplete="name" placeholder="Como aparece en tu hoja de vida" required maxlength="120"
                       value="{{ old('nombre') }}" @error('nombre') aria-invalid="true" aria-describedby="nombre-error" @enderror class="{{ $campo }} {{ $borde('nombre') }}">
                @error('nombre') <p id="nombre-error" class="mt-1.5 text-sm text-error">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label for="correo" class="{{ $etiqueta }}">Correo electrónico <span class="text-error" aria-hidden="true">*</span></label>
                <input type="email" id="correo" name="correo" autocomplete="email" placeholder="tucorreo@ejemplo.com" required maxlength="160"
                       value="{{ old('correo') }}" @error('correo') aria-invalid="true" aria-describedby="correo-error" @enderror class="{{ $campo }} {{ $borde('correo') }}">
                @error('correo') <p id="correo-error" class="mt-1.5 text-sm text-error">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label for="whatsapp" class="{{ $etiqueta }}">Número de WhatsApp <span class="text-error" aria-hidden="true">*</span></label>
                <input type="tel" id="whatsapp" name="whatsapp" autocomplete="tel" inputmode="tel" placeholder="+57 3XX XXX XXXX" required maxlength="20"
                       value="{{ old('whatsapp') }}" aria-describedby="whatsapp-ayuda @error('whatsapp') whatsapp-error @enderror" @error('whatsapp') aria-invalid="true" @enderror class="{{ $campo }} {{ $borde('whatsapp') }}">
                <p id="whatsapp-ayuda" class="mt-1.5 text-sm text-gris-600">Es el canal por el que confirmamos la sesión y enviamos el material.</p>
                @error('whatsapp') <p id="whatsapp-error" class="mt-1 text-sm text-error">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label for="punto" class="{{ $etiqueta }}">¿En qué punto te estás quedando? <span class="text-error" aria-hidden="true">*</span></label>
                <select id="punto" name="punto" required aria-describedby="punto-ayuda @error('punto') punto-error @enderror" @error('punto') aria-invalid="true" @enderror class="{{ $campo }} {{ $borde('punto') }} cursor-pointer">
                    <option value="">Elige una opción</option>
                    @foreach (\App\Models\Solicitud::PUNTOS as $valor => $texto)
                        <option value="{{ $valor }}" @selected(old('punto') === $valor)>{{ $texto }}</option>
                    @endforeach
                </select>
                <p id="punto-ayuda" class="mt-1.5 text-sm text-gris-600">Esta respuesta permite que el consultor llegue preparado a la sesión.</p>
                @error('punto') <p id="punto-error" class="mt-1 text-sm text-error">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-start gap-3 pt-4 pb-6">
                <input type="checkbox" id="consentimiento" name="consentimiento" value="1" required @checked(old('consentimiento'))
                       @error('consentimiento') aria-invalid="true" aria-describedby="consentimiento-error" @enderror
                       class="mt-0.5 size-6 shrink-0 cursor-pointer accent-teal-800">
                <div>
                    <label for="consentimiento" class="text-sm leading-normal text-gris-600">Autorizo el tratamiento de mis datos personales conforme a la <a href="{{ route('politica') }}" class="font-semibold underline-offset-2 hover:underline">política de tratamiento de datos</a> de Dhessir Consultant y a la Ley 1581 de 2012. Mis datos se usan exclusivamente para contactarme y prestar este servicio.</label>
                    @error('consentimiento') <p id="consentimiento-error" class="mt-1 text-sm text-error">{{ $message }}</p> @enderror
                </div>
            </div>

            <button class="btn-primario w-full" type="submit">Agendar mi sesión gratuita</button>
            <p class="mt-4 text-center text-sm leading-normal text-gris-600">Te confirmamos horario por WhatsApp en menos de 12 horas hábiles. Cuatro campos, nada más: no pedimos edad, ciudad ni cargo actual.</p>
        </form>
    </div>
</section>
