<?php


use App\Models\Categoria;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideosControllerTest extends TestCase
{

    use RefreshDatabase;

    public function test_index_video()
    {
        #Arrange
        Categoria::factory(2)->create();
        Video::factory(2)->create();

        #Act
        $response = $this->get("api/videos");

        #Assert
        $response->assertStatus(200);
        $response->assertJsonCount(2);
    }


    public function test_create_new_video_without_set_category()
    {
        #Arrange
        Categoria::factory(2)->create();

        $videoData = [
            'titulo' => 'Oliver Tree & Robin Schulz - Miss You',
            'descricao' => 'On repeat for hours on end.',
            'url' => 'https://www.youtube.com/watch?v=BX0lKSa_PTk'
        ];

        #Act
        $response = $this->postJson(
            'api/videos',
            $videoData,
        );


        #Assert
        $response->assertStatus(201);
        $response->assertJson(['categoriaId' => 1]);
    }

    public function test_create_new_video_with_other_category()
    {
        Categoria::factory(2)->create();

        #Arrange
        $videoData = [
            'titulo' => 'Oliver Tree & Robin Schulz - Miss You',
            'descricao' => 'On repeat for hours on end.',
            'categoriaId' => 2,
            'url' => 'https://www.youtube.com/watch?v=BX0lKSa_PTk'
        ];

        #Act
        $response = $this->postJson(
            'api/videos',
            $videoData,
        );


        #Assert
        $response->assertStatus(201);
        $response->assertJson(['categoriaId' => 2]);
    }

    public function test_update_video()
    {
        Categoria::factory(2)->create();
        $video = Video::factory(1)->create();

        $videoData = [
            'titulo' => 'Technomix Volume 2',
            'descricao' => 'Provided to YouTube by DistroKid',
            'categoriaId' => 2,
            'url' => 'https://www.youtube.com/watch?v=0BsUqeeVHE8'
        ];

        $response = $this->putJson(
            "api/videos/".$video->first()->id,
            $videoData,
        );

        $response->assertStatus(200);
        $response->assertJson(['titulo' => 'Technomix Volume 2']);
    }

    public function test_delete_video()
    {
        Categoria::factory(1)->create();
        $video = Video::factory(1)->create();

        $response = $this->deleteJson(
            "api/videos/".$video->first()->id
        );

        $response->assertStatus(204);
    }
}
