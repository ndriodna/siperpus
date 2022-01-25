<?php

namespace Database\Factories;

use App\Models\Buku;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Buku::class;

    public function definition()
    {
        return [
            'judul' => $this->faker->sentence(),
            'isbn' => $this->faker->isbn10(),
            'pengarang' => $this->faker->name(),
            'penerbit' => $this->faker->company(),
            'tahun_terbit' => $this->faker->year(),
            'stok' => $this->faker->randomDigit(),
            'cover' => null,
            'kategori_id' => 1
        ];
    }
}
