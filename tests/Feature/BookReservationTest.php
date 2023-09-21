<?php

namespace Tests\Feature;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_book_can_be_added_to_the_library()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->post('/books', [
            'title' => 'Cool book title',
            'author' => 'Kamdjou'
        ]);

       $response->assertOk();
       $this->assertCount(1, Book::all());
    }

    public function test_a_title_is_require()
    {
        $response = $this->post('/books', [
            'title' => '',
            'author' => 'Kamdjou'
        ]);

       $response->assertSessionHasErrors('title');
    }

    public function test_an_author_is_require()
    {
        $response = $this->post('/books', [
            'title' => 'Cool ook title',
            'author' => ''
        ]);

       $response->assertSessionHasErrors('author');
    }
}
