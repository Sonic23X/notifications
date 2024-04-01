<?php

namespace Tests\Feature;

use App\Enums\NotificationType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\V1\Category;

class NotificationControllerTest extends TestCase
{
    /** @test */
    public function test_it_displays_notifications(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();

        $response = $this->get(route('notification.index'));
        $response->assertStatus(200);
        $response->assertInertia();
    }

    /** @test */
    public function test_it_displays_notifications_create(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();

        $response = $this->get(route('notification.create'));
        $response->assertStatus(200);
        $response->assertInertia();
    }

    /** @test */
    public function test_save_new_notification_and_send_it(): void
    {
        $movie = Category::factory()->create([
            'name' => 'Peliculas'
        ]);

        $user = User::factory()->create([
            'suscribed_to' => json_encode([$movie->id]),
            'channels' => json_encode(NotificationType::getAllValuesAsString()),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();

        $response = $this->post(route('notification.store'), [
            'content' => 'testing',
            'type' => NotificationType::Email,
            'category' => $movie->uuid,
        ]);

        $response->assertStatus(201);
        $response->assertJson(['message' => 'Notification created and sent successfully']);
    }

    /** @test */
    public function test_save_new_notification_without_content(): void
    {
        $movie = Category::factory()->create([
            'name' => 'Peliculas'
        ]);

        $user = User::factory()->create([
            'suscribed_to' => json_encode([$movie->id]),
            'channels' => json_encode(NotificationType::getAllValuesAsString()),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();

        $response = $this->post(route('notification.store'), [
            'type' => NotificationType::Email,
            'category' => $movie->uuid,
        ]);

        $response->assertStatus(422);
    }

    /** @test */
    public function test_save_new_notification_without_type(): void
    {
        $movie = Category::factory()->create([
            'name' => 'Peliculas'
        ]);

        $user = User::factory()->create([
            'suscribed_to' => json_encode([$movie->id]),
            'channels' => json_encode(NotificationType::getAllValuesAsString()),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();

        $response = $this->post(route('notification.store'), [
            'content' => 'testing',
            'category' => $movie->uuid,
        ]);

        $response->assertStatus(422);
    }

    /** @test */
    public function test_save_new_notification_without_category(): void
    {
        $movie = Category::factory()->create([
            'name' => 'Peliculas'
        ]);

        $user = User::factory()->create([
            'suscribed_to' => json_encode([$movie->id]),
            'channels' => json_encode(NotificationType::getAllValuesAsString()),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();

        $response = $this->post(route('notification.store'), [
            'content' => 'testing',
            'type' => NotificationType::Email,
        ]);

        $response->assertStatus(422);
    }
}
