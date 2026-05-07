<?php

use App\Models\Post;
use Livewire\Livewire;
use function Pest\Laravel\get;

it('can render the Post table', function () {
    Post::factory()->count(5)->create();

    get(route('post.index'))
        ->assertStatus(200)
        ->assertSee('Post');
});

it('can search for a Post', function () {
    $record = Post::factory()->create(['title' => 'Fabric Search Target']);
    Post::factory()->create(['title' => 'Other Record']);

    Livewire::test('App\Livewire\Fabric\App\Models\Post\\PostTable')
        ->set('search', 'Fabric Search Target')
        ->assertSee('Fabric Search Target')
        ->assertDontSee('Other Record');
});

it('can create a new Post', function () {
    Livewire::test('App\Livewire\Fabric\App\Models\Post\\PostEditor')
        ->set('form.title', 'New Post')
        ->call('save')
        ->assertHasNoErrors()
        ->assertDispatched('post-saved');

    expect(Post::where('title', 'New Post')->exists())->toBeTrue();
});

it('can delete a Post', function () {
    $record = Post::factory()->create();

    Livewire::test('App\Livewire\Fabric\App\Models\Post\\PostTable')
        ->set('selected', [(string) $record->id])
        ->call('deleteSelected')
        ->assertHasNoErrors();

    expect(Post::find($record->id))->toBeNull();
});
