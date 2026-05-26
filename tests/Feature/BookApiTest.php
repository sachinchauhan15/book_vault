<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_manage_books(): void
    {
        $user = User::factory()->create();

        $create = $this->actingAs($user, 'api')->postJson('/api/books', [
            'title' => 'Clean Laravel APIs',
            'author' => 'Taylor Reader',
            'price' => 49.99,
            'published_date' => '2024-01-10',
        ]);

        $create->assertCreated()
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.title', 'Clean Laravel APIs');

        $bookId = $create->json('data.id');

        $this->actingAs($user, 'api')->getJson('/api/books?search=laravel')
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('meta.total', 1);

        $this->actingAs($user, 'api')->putJson("/api/books/{$bookId}", [
            'price' => 39.99,
        ])->assertOk()
            ->assertJsonPath('data.price', 39.99);

        $this->actingAs($user, 'api')->deleteJson("/api/books/{$bookId}")
            ->assertOk()
            ->assertJsonPath('success', true);

        $this->assertSoftDeleted(Book::class, ['id' => $bookId]);
    }

    public function test_books_are_protected_by_jwt_middleware(): void
    {
        $this->getJson('/api/books')
            ->assertUnauthorized()
            ->assertJsonPath('success', false);
    }
}
