<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Buku;

class BukuControllerTest extends TestCase
{
    
    use RefreshDatabase;

    public function test_store_method_saves_buku_and_file(){
        Storage::fake('public');

        $file = UploadedFile::fake()->image('cover.jpg');

        $response = $this->post('/buku', [
            'judul' => 'Buku Test',
            'penulisan' => 'Penulis Test',
            'kategori' => 'Kategori Test',
            'sampul' => $file
        ]);

        Storage::disk('public')->assertExists('sampul-buku/' . $file->hashName());

        $this->assertDatabaseHas('bukus', [
            'judul' => 'Buku Test',
            'penulisan' => 'Penulis Test',
            'kategori' => 'Kategori Test',
        ]);

        $response->assertRedirect('/buku');
    }

    public function test_store_method_update_buku_and_file(){
        Storage::fake('public');

        $buku = Buku::factory()->create([
            'judul' => 'Judul Lama',
            'penulisan' => 'Penulis Lama',
            'kategori' => 'Kategori Lama',
            'sampul' => 'sampul-lama.jpg'
        ]);

        $newFile = UploadedFile::fake()->image('new-cover.jpg');

        $response = $this->put('/buku/' . $buku->id, [
            'judul' => 'Judul Baru',
            'penulisan' => 'Penulis Baru',
            'kategori' => 'Kategori Baru',
            'sampul' => $newFile,
            'sampulLama' => 'sampul-lama.jpg',
        ]);

        Storage::disk('public')->assertExists('sampul-buku/' . $newFile->hashName());
        Storage::disk('public')->assertExists('sampu-lama.jpg');

        $this->assertDatabaseHas('bukus', [
            'id' => $buku->id,
            'judul' => 'Judul Baru',
            'penulisan' => 'Penulis Baru',
            'kategori' => 'Kategori Baru',
            'sampul' => 'sampul-buku/' . $newFile->hashName(),
        ]);

        $response->assertRedirect('/buku');
    }

    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
}
