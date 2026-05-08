<?php

use App\Models\Tag;
use Livewire\Livewire;
use function Pest\Laravel\get;

it('can render the Tag table', function () {
    Tag::factory()->count(5)->create();

    get(route('tag.index'))
        ->assertStatus(200)
        ->assertSee('Tag');
});

it('can search for a Tag', function () {
    $record = Tag::factory()->create(['name' => 'Fabric Search Target']);
    Tag::factory()->create(['name' => 'Other Record']);

    Livewire::test('App\Livewire\Fabric\Tag\\TagTable')
        ->set('search', 'Fabric Search Target')
        ->assertSee('Fabric Search Target')
        ->assertDontSee('Other Record');
});

it('can create a new Tag', function () {
    Livewire::test('App\Livewire\Fabric\Tag\\TagEditor')
        ->set('form.name', 'New Tag')
        ->call('save')
        ->assertHasNoErrors()
        ->assertDispatched('tag-saved');

    expect(Tag::where('name', 'New Tag')->exists())->toBeTrue();
});

it('can delete a Tag', function () {
    $record = Tag::factory()->create();

    Livewire::test('App\Livewire\Fabric\Tag\\TagTable')
        ->set('selected', [(string) $record->id])
        ->call('deleteSelected')
        ->assertHasNoErrors();

    expect(Tag::find($record->id))->toBeNull();
});
