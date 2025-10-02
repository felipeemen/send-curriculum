<?php

use function Pest\Laravel\get;
use function Pest\Laravel\post;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Página de envio de currículo', function () {
    it('pode ser acessada', function () {
        $response = get('/');

        $response->assertStatus(200);
    });
});

describe('Envio de currículo', function () {
    it('Envia dados de curriculo', function () {
        Storage::fake('public');
        $file = UploadedFile::fake()->create('curriculo.pdf', 1024);
        
        $response = post('/submit-curriculum', [
            'name' => 'Felipe Silva',
            'email' => 'R4A7o@example.com',
            'phone' => '11999999999',
            'position' => 'Desenvolvedor',
            'education' => 'Ensino Superior',
            'observations' => 'Nenhuma',
            'file' => $file,
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHas('success', 'Currículo enviado com sucesso!');
    });
});

describe('Validação do formulário de envio de currículo', function () {
    it('Valida campos obrigatórios', function () {
        $response = post('/submit-curriculum', []);

        $response->assertSessionHasErrors([
            'name',
            'email',
            'phone',
            'position',
            'education',
            'file',
        ]);
    });

    it('Valida formato de email', function () {
        $response = post('/submit-curriculum', [
            'email' => 'invalid-email',
        ]);

        $response->assertSessionHasErrors(['email']);
    });

    it('Valida formato de telefone', function () {
        $response = post('/submit-curriculum', [
            'phone' => 'invalid-phone',
        ]);

        $response->assertSessionHasErrors(['phone']);
    });

    it('Valida tamanho máximo do arquivo', function () {
        Storage::fake('public');
        $file = UploadedFile::fake()->create('large_file.pdf', 2048); 

        $response = post('/submit-curriculum', [
            'file' => $file,
        ]);

        $response->assertSessionHasErrors(['file']);
    });

    it('Valida tipos de arquivo permitidos', function () {
        Storage::fake('public');
        $file = UploadedFile::fake()->create('image.jpg', 500);

        $response = post('/submit-curriculum', [
            'file' => $file,
        ]);

        $response->assertSessionHasErrors(['file']);
    });

    it('Valida tamanho máximo das observações', function () {
        $longObservations = str_repeat('A', 256);

        $response = post('/submit-curriculum', [
            'observations' => $longObservations,
        ]);

        $response->assertSessionHasErrors(['observations']);
    });
});
