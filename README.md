# Dhessir Consultant · Sitio web en Laravel

Sitio web de **Dhessir Consultant**, consultoría de empleabilidad 100 % virtual con sede en Bogotá. Ayuda a universitarios y profesionales colombianos a ajustar su hoja de vida a los filtros ATS, prepararse para la entrevista y definir hacia dónde aplicar.

Taller Práctico N.º 03 · Diseño y Programación Web · UNILATINA · 2026-II

## Stack

| Capa | Tecnología |
|---|---|
| Entorno | Ubuntu 24.04 sobre WSL 2 · Docker · Lando |
| Framework | Laravel 13 (PHP 8.4) con vistas Blade |
| Estilos | Tailwind CSS 4 compilado con Vite |
| Interacción | JavaScript modular sin dependencias |
| Base de datos | MariaDB (servicio de Lando) |

## Cómo ejecutarlo

Requisitos: Ubuntu en WSL 2, Docker y [Lando](https://lando.dev).

```bash
git clone https://github.com/dhessirconsultant-lab/DhessirApp.git
cd DhessirApp
cp .env.example .env
lando start                     # levanta Apache + PHP, MariaDB y Node
lando composer install
lando artisan key:generate
lando artisan migrate
lando npm install
lando build                     # compila Tailwind y JavaScript
```

Sitio: **https://dhessir-app.lndo.site**

Otros comandos útiles:

```bash
lando artisan test              # pruebas automáticas
lando npm run dev               # recompila estilos en cada cambio
lando info                      # URLs y datos de conexión
lando stop                      # apaga el entorno
```

## Páginas

El menú de navegación tiene cinco páginas y se convierte en menú hamburguesa en pantallas pequeñas.

| Página | Ruta | Contenido |
|---|---|---|
| Inicio | `/` | Hero, diagnóstico interactivo, compatibilidad ATS, caso documentado y formulario de agendamiento |
| Método | `/metodo` | Método PREP, para quién es y anatomía interactiva de una hoja de vida |
| Planes | `/planes` | Planes Brújula, Mapa y Expedición, y preguntas frecuentes |
| Nosotros | `/nosotros` | Consultor, podcast y blog |
| Contacto | `/contacto` | Canales de contacto y formulario de agendamiento |

También está la página de política de tratamiento de datos (`/politica-de-datos`), exigida por la Ley 1581 de 2012.

## Sistema de diseño

Los colores, tipografías, espaciados y sombras están definidos como tokens en [`resources/css/app.css`](resources/css/app.css) dentro del tema de Tailwind.

| Token | Color | Uso |
|---|---|---|
| `azul-900` | `#184264` | Titulares, texto principal y fondos oscuros |
| `teal-800` | `#035A55` | Enlaces, botón secundario y foco |
| `teal-500` | `#59908B` | Iconos y bordes |
| `teal-300` | `#76ABA5` | Fondos y decoración |
| `acento` | `#F2A63C` | Solo el botón principal (con texto azul, nunca blanco) |

- **Tipografía:** Manrope para titulares y Inter para el cuerpo. Se descargan al compilar y se sirven desde el propio sitio.
- **Logo:** vector SVG redibujado a partir del logo oficial ([`resources/views/components/logo.blade.php`](resources/views/components/logo.blade.php)). Aparece en el menú y en el pie de página.
- **Sombras multicapa:** la escala `shadow-sm` … `shadow-2xl` de Tailwind está redefinida con sombras de varias capas teñidas con el azul de la marca.
- **Microinteracciones:** tarjetas y botones se elevan con `hover:-translate-y-1` y `transition-all duration-300 ease-in-out`. Las secciones aparecen con animación al hacer scroll.
- **Accesibilidad:** zonas táctiles de 44 px, foco visible en todo elemento interactivo, enlace para saltar al contenido, un solo `<h1>` por página y respeto por `prefers-reduced-motion`.

## Formulario de agendamiento y seguridad

El formulario guarda la solicitud en la base de datos (tabla `solicitudes`) junto con la fecha en que la persona autorizó el tratamiento de sus datos.

- Validación en el servidor con mensajes en español
- Consentimiento obligatorio según la Ley 1581 de 2012 (Habeas Data)
- Protección CSRF de Laravel
- Límite de 5 envíos por minuto por IP
- Campo trampa invisible contra bots
- Redirecciones solo a páginas propias del sitio
- Encabezados HTTP de seguridad (`X-Frame-Options`, `X-Content-Type-Options`, `Referrer-Policy`, `Permissions-Policy`)

## Estructura

```
.lando.yml                        Receta de Lando (Laravel + MariaDB + Node)
app/Http/Controllers/             Controlador del formulario
app/Http/Middleware/              Encabezados de seguridad
app/Models/Solicitud.php          Modelo de las solicitudes
resources/css/app.css             Sistema de diseño en Tailwind
resources/js/                     Menú, diagnóstico, anatomía y animaciones
resources/views/components/       Layout, logo y componentes reutilizables
resources/views/secciones/        Las 13 secciones del sitio
resources/views/paginas/          Las páginas que arman las secciones
routes/web.php                    Rutas
tests/Feature/SitioTest.php       Pruebas de páginas y formulario
```

## Entrega

Para el `.zip` de Google Drive se excluyen `vendor/` y `node_modules/`, que se regeneran con `lando composer install` y `lando npm install`:

```bash
git archive --format=zip --output=DhessirApp.zip HEAD
```
