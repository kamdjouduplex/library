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
    public function test_can_get_all_book_list()
    {
        $response = $this->get('/books');

        $response->assertStatus(200);
    }

    public function test_a_book_can_be_added_to_the_library()
    {
        
        $response = $this->post('/books', [
            'title' => 'Cool book title',
            'author' => 'Kamdjou'
        ]);

       $this->assertCount(1, Book::all());
       $response->assertRedirect('/books');

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

    public function test_a_book_can_be_updated()
    {

        $this->post('/books', [
            'title' => 'Cool ook title',
            'author' => 'Kamdjou'
        ]);
        $book = Book::first();

        $response = $this->patch($book->path(), [
            'title' => 'New title',
            'author' => 'New author'
        ]);

        $this->assertEquals('New title', Book::first()->title);
        $this->assertEquals('New author', Book::first()->author);

        $response->assertRedirect($book->path());

    }

    public function test_a_book_can_be_deleted(){

        $this->withoutExceptionHandling();

        $this->post('/books', [
            'title' => 'Cool ook title',
            'author' => 'Kamdjou'
        ]);

        $book = Book::first();

        $response = $this->delete($book->path());

        $this->assertCount(0, Book::all());
        
        $response->assertRedirect('/books');

    }
}
