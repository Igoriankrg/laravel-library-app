<?php


namespace Database\Factories;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookAuthor;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->streetName(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function(Book $book) {
            $authors = Author::all()->random(rand(1,3));
            foreach ($authors as $author) {
                BookAuthor::create([
                   'book_id' => $book->getAttribute('id'),
                   'author_id' => $author->getAttribute('id'),
                ]);
            }
        });
    }
}