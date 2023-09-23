<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Author;
use Carbon\Carbon;

class AuthorManagementTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_an_author_can_be_created()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/author', [
            'name' => 'Author name',
            'dob' => '07/06/1987'
        ]);

        $response->assertStatus(200);

        $author = Author::all();

        $this->assertCount(1, $author);
        $this->assertInstanceOf(Carbon::class, $author->first()->dob);
        $this->assertEquals('1987/06/07', $author->first()->dob->format('Y/d/m'));
    }
}
