<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InicioTest extends TestCase
{
    /**
     * @test
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function testInicio()
    {
        $response = $this->get('/inicio');

        $response->assertStatus(200);
        $response->assertSee("TransferenciaCripto");
        $response->assertSee("Bitcoin Address");
        $response->assertDontSee("usuariosEdit");
    }

    /**
     * @test
     */
    public function testNoAddressSearch()
    {
        $response = $this->post('/addressSearchApi', [
            'address' => '',
        ]);
        $response->assertDontSee("Informacion de transaferencias realizadas por");
        $response->assertDontSee("Transferencias");

    }
}
