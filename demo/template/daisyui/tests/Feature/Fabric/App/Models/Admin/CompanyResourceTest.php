<?php

use App\Models\Admin\CompanyResource;
use Livewire\Livewire;
use function Pest\Laravel\get;

it('can render the CompanyResource table', function () {
    CompanyResource::factory()->count(5)->create();

    get(route('companyResource.index'))
        ->assertStatus(200)
        ->assertSee('CompanyResource');
});

it('can search for a CompanyResource', function () {
    $record = CompanyResource::factory()->create(['name' => 'Fabric Search Target']);
    CompanyResource::factory()->create(['name' => 'Other Record']);

    Livewire::test('App\Livewire\Fabric\App\Models\Admin\CompanyResource\\CompanyResourceTable')
        ->set('search', 'Fabric Search Target')
        ->assertSee('Fabric Search Target')
        ->assertDontSee('Other Record');
});

it('can create a new CompanyResource', function () {
    Livewire::test('App\Livewire\Fabric\App\Models\Admin\CompanyResource\\CompanyResourceEditor')
        ->set('form.name', 'New CompanyResource')
        ->call('save')
        ->assertHasNoErrors()
        ->assertDispatched('companyResource-saved');

    expect(CompanyResource::where('name', 'New CompanyResource')->exists())->toBeTrue();
});

it('can delete a CompanyResource', function () {
    $record = CompanyResource::factory()->create();

    Livewire::test('App\Livewire\Fabric\App\Models\Admin\CompanyResource\\CompanyResourceTable')
        ->set('selected', [(string) $record->id])
        ->call('deleteSelected')
        ->assertHasNoErrors();

    expect(CompanyResource::find($record->id))->toBeNull();
});
