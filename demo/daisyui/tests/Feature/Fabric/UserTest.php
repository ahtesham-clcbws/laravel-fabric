<?php

use App\Models\User;
use Livewire\Livewire;
use function Pest\Laravel\get;

it('can render the User table', function () {
    User::factory()->count(5)->create();

    get(route('user.index'))
        ->assertStatus(200)
        ->assertSee('User');
});

it('can search for a User', function () {
    $record = User::factory()->create(['name' => 'Fabric Search Target']);
    User::factory()->create(['name' => 'Other Record']);

    Livewire::test('App\Livewire\Fabric\User\\UserTable')
        ->set('search', 'Fabric Search Target')
        ->assertSee('Fabric Search Target')
        ->assertDontSee('Other Record');
});

it('can create a new User', function () {
    Livewire::test('App\Livewire\Fabric\User\\UserEditor')
        ->set('form.name', 'New User')
        ->call('save')
        ->assertHasNoErrors()
        ->assertDispatched('user-saved');

    expect(User::where('name', 'New User')->exists())->toBeTrue();
});

it('can delete a User', function () {
    $record = User::factory()->create();

    Livewire::test('App\Livewire\Fabric\User\\UserTable')
        ->set('selected', [(string) $record->id])
        ->call('deleteSelected')
        ->assertHasNoErrors();

    expect(User::find($record->id))->toBeNull();
});
