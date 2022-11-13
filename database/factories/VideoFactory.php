<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
{

    public function definition()
    {
        return [
            'titulo' => 'Oliver Tree & Robin Schulz - Miss You',
            'categoriaId' => 1,
            'descricao' => 'On repeat for hours on end.',
            'url' => 'https://www.youtube.com/watch?v=BX0lKSa_PTk'
        ];

    }
}
