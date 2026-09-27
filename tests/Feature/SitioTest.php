<?php

namespace Tests\Feature;

use App\Models\Solicitud;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class SitioTest extends TestCase
{
    use RefreshDatabase;

    public static function paginas(): array
    {
        return [
            'inicio' => ['/', 'El problema no eres tú.'],
            'método' => ['/metodo', 'Primero se diagnostica.'],
            'planes' => ['/planes', 'Tres planes, un mismo punto de partida'],
            'nosotros' => ['/nosotros', 'Del otro lado de la mesa de selección'],
            'contacto' => ['/contacto', 'Hablemos de tu búsqueda de empleo'],
            'política' => ['/politica-de-datos', 'Política de tratamiento de datos personales'],
        ];
    }

    #[DataProvider('paginas')]
    public function test_cada_pagina_carga_con_su_titulo_y_el_menu(string $url, string $titulo): void
    {
        $this->get($url)
            ->assertOk()
            ->assertSee($titulo)
            ->assertSee('Navegación principal')
            ->assertHeader('X-Frame-Options', 'SAMEORIGIN');
    }

    private function datosValidos(array $cambios = []): array
    {
        return array_merge([
            'origen' => 'contacto',
            'nombre' => 'Ana Prueba',
            'correo' => 'ana@ejemplo.com',
            'whatsapp' => '+57 300 000 0000',
            'punto' => 'hv',
            'consentimiento' => '1',
        ], $cambios);
    }

    public function test_una_solicitud_valida_se_guarda_con_la_fecha_de_consentimiento(): void
    {
        $this->post('/solicitudes', $this->datosValidos())
            ->assertRedirect(route('contacto').'#agenda')
            ->assertSessionHas('solicitud_enviada');

        $solicitud = Solicitud::sole();
        $this->assertSame('ana@ejemplo.com', $solicitud->correo);
        $this->assertNotNull($solicitud->consentimiento_at);
    }

    public function test_sin_consentimiento_no_se_guarda(): void
    {
        $this->post('/solicitudes', $this->datosValidos(['consentimiento' => null]))
            ->assertRedirect(route('contacto').'#agenda')
            ->assertSessionHasErrors('consentimiento');

        $this->assertDatabaseCount('solicitudes', 0);
    }

    public function test_datos_invalidos_devuelven_errores_en_espanol(): void
    {
        $this->post('/solicitudes', $this->datosValidos(['correo' => 'malo', 'punto' => 'inventado']))
            ->assertSessionHasErrors([
                'correo' => 'Escribe un correo válido, por ejemplo tucorreo@ejemplo.com.',
                'punto' => 'Elige una de las opciones de la lista.',
            ]);
    }

    public function test_el_campo_trampa_descarta_bots_sin_guardar(): void
    {
        $this->post('/solicitudes', $this->datosValidos(['sitio_web' => 'http://spam.test']))
            ->assertSessionHas('solicitud_enviada');

        $this->assertDatabaseCount('solicitudes', 0);
    }

    public function test_el_origen_nunca_redirige_fuera_del_sitio(): void
    {
        $this->post('/solicitudes', $this->datosValidos(['origen' => 'https://malo.test']))
            ->assertRedirect(route('inicio').'#agenda');
    }
}
