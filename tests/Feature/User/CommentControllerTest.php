<?php

namespace Tests\Feature\User;

use App\Models\Book;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    private $user;

    private $token;

    private $book;

    private $comment;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->user = User::factory()->create();

        $this->book = Book::factory()->create();

        $this->comment = Comment::factory()->create();

        $this->token = $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    }

    private function generateNewComment(): array
    {
        return [
            '_token' => $this->token, // Include the CSRF token in the request data
            'comment' => 'new_comment',
            'title' => 'new_title',
            'rating' => 2
        ];
    }


    public function test_store()
    {
        $response = $this->actingAs($this->user)
            ->withHeaders(['X-CSRF-TOKEN' => $this->token]) // Include the CSRF token in the request headers
            ->post("user/comment/{$this->book->id}/store", $this->generateNewComment());

        $response->assertStatus(302);
    }

    public function test_create_with_not_auth_user()
    {
        $response = $this->get("user/comment/{$this->book->id}/create");

        $response->assertStatus(302);
    }

    public function test_create_with_auth_user()
    {
        $response = $this->actingAs($this->user)->get("user/comment/{$this->book->id}/create");

        $response->assertStatus(200);
    }

    public function test_update_comment()
    {
        $response = $this->actingAs($this->user)
            ->withHeaders(['X-CSRF-TOKEN' => $this->token]) // Include the CSRF token in the request headers
            ->post("user/comment/{$this->book->id}/update", $this->generateNewComment());
        dd($response);
    }

    public function test_edit()
    {
        $response = $this->get("user/comment/{$this->comment->id}/edit");

        $response->assertStatus(200);
    }

    public function test_destroy()
    {
       $response =  $this->post("user/comment/{$this->comment->id}/delete");

       $response->assertStatus(302);
    }
}