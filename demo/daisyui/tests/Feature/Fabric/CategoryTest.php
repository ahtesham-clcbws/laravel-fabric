<?php

use App\Models\Category;
use Livewire\Livewire;
use function Pest\Laravel\get;

it('can render the Category table', function () {
    Category::factory()->count(5)->create();

    get(route('category.index'))
        ->assertStatus(200)
        ->assertSee('Category');
});

it('can search for a Category', function () {
    $record = Category::factory()->create(['name' => 'Fabric Search Target']);
    Category::factory()->create(['name' => 'Other Record']);

    Livewire::test('App\Livewire\Fabric\Category\\CategoryTable')
        ->set('search', 'Fabric Search Target')
        ->assertSee('Fabric Search Target')
        ->assertDontSee('Other Record');
});

it('can create a new Category', function () {
    Livewire::test('App\Livewire\Fabric\Category\\CategoryEditor')
        ->set('form.name', 'New Category')
        ->call('save')
        ->assertHasNoErrors()
        ->assertDispatched('category-saved');

    expect(Category::where('name', 'New Category')->exists())->toBeTrue();
});

it('can delete a Category', function () {
    $record = Category::factory()->create();

    Livewire::test('App\Livewire\Fabric\Category\\CategoryTable')
        ->set('selected', [(string) $record->id])
        ->call('deleteSelected')
        ->assertHasNoErrors();

    expect(Category::find($record->id))->toBeNull();
});
