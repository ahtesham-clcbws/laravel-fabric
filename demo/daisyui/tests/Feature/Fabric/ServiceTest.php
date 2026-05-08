<?php

use App\Models\Service;
use Livewire\Livewire;
use function Pest\Laravel\get;

it('can render the Service table', function () {
    Service::factory()->count(5)->create();

    get(route('service.index'))
        ->assertStatus(200)
        ->assertSee('Service');
});

it('can search for a Service', function () {
    $record = Service::factory()->create(['title' => 'Fabric Search Target']);
    Service::factory()->create(['title' => 'Other Record']);

    Livewire::test('App\Livewire\Fabric\Service\\ServiceTable')
        ->set('search', 'Fabric Search Target')
        ->assertSee('Fabric Search Target')
        ->assertDontSee('Other Record');
});

it('can create a new Service', function () {
    Livewire::test('App\Livewire\Fabric\Service\\ServiceEditor')
        ->set('form.title', 'New Service')
        ->call('save')
        ->assertHasNoErrors()
        ->assertDispatched('service-saved');

    expect(Service::where('title', 'New Service')->exists())->toBeTrue();
});

it('can delete a Service', function () {
    $record = Service::factory()->create();

    Livewire::test('App\Livewire\Fabric\Service\\ServiceTable')
        ->set('selected', [(string) $record->id])
        ->call('deleteSelected')
        ->assertHasNoErrors();

    expect(Service::find($record->id))->toBeNull();
});
