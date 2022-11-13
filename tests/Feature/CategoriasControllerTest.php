<?php


use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoriasControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_categoria()
    {
        Categoria::factory(1)->create();

        $response = $this->getJson(
            "api/categorias"
        );

        $response->assertStatus(200);
        $response->assertJsonCount(1);
    }

    public function test_create_new_categoria()
    {
        #Arrange
        $categoriaData = [
            "titulo" => "Música",
            "cor" => "amarelo",
        ];

        #Act
        $response = $this->postJson(
            'api/categorias',
            $categoriaData,
        );

        #Assert
        $response->assertStatus(201);
        $response->assertJson(['titulo' => 'Música']);
    }


    public function test_update_categoria()
    {
        $categoria = Categoria::factory(1)->create();

        $categoriaData = [
            "titulo" => "Música",
            "cor" => "amarelo",
        ];

        $response = $this->putJson(
            "api/categorias/".$categoria->first()->id,
            $categoriaData,
        );

        $response->assertStatus(200);
        $response->assertJson(['titulo' => 'Música']);
    }

    public function test_delete_categoria()
    {
        $categoria = Categoria::factory(1)->create();

        $response = $this->deleteJson(
            "api/categorias/".$categoria->first()->id
        );

        $response->assertStatus(204);
    }
}
