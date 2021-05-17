<?php

namespace Tests\Unit;

use App\Models\Book;
use App\Services\BookService;
use App\Services\Interfaces\BookServiceInterface;
use Tests\TestCase;
use Tests\Components\Repositories\BookRepository;

class BookServiceTest extends TestCase
{
    private $books = [
        [
            'id' => 0,
            'name' => 'Тестовая книга 1',
        ],
        [
            'id' => 1,
            'name' => 'Тестовая книга 2',
        ],
    ];

    private function getService(): BookServiceInterface
    {
        $collection = [];
        foreach ($this->books as $book) {
            $collection[] = Book::factory()->make($book);
        }
        $repository = new BookRepository($collection);
        return new BookService($repository);
    }

    public function testGetAll()
    {
        $service = $this->getService();
        $this->assertGreaterThan(0, count($service->getAll()));
    }

    public function testFindOne()
    {
        $service = $this->getService();
        $this->assertNotNull($service->getOneById(1));
    }

    public function testNotFound()
    {
        $service = $this->getService();
        $this->assertNull($service->getOneById(235));
    }

    public function testCreateNew()
    {
        $service = $this->getService();
        $currentAmount = count($service->getAll());
        $service->create([
            'id' => 250,
            'name' => 'New way!'
            ]);
        $newAmount = count($service->getAll());
        $this->assertGreaterThan($currentAmount, $newAmount);
    }
}
