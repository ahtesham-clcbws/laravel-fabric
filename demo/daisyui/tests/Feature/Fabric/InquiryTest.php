<?php

use App\Models\Inquiry;
use Livewire\Livewire;
use function Pest\Laravel\get;

it('can render the Inquiry table', function () {
    Inquiry::factory()->count(5)->create();

    get(route('inquiry.index'))
        ->assertStatus(200)
        ->assertSee('Inquiry');
});

it('can search for a Inquiry', function () {
    $record = Inquiry::factory()->create(['name' => 'Fabric Search Target']);
    Inquiry::factory()->create(['name' => 'Other Record']);

    Livewire::test('App\Livewire\Fabric\Inquiry\\InquiryTable')
        ->set('search', 'Fabric Search Target')
        ->assertSee('Fabric Search Target')
        ->assertDontSee('Other Record');
});

it('can create a new Inquiry', function () {
    Livewire::test('App\Livewire\Fabric\Inquiry\\InquiryEditor')
        ->set('form.name', 'New Inquiry')
        ->call('save')
        ->assertHasNoErrors()
        ->assertDispatched('inquiry-saved');

    expect(Inquiry::where('name', 'New Inquiry')->exists())->toBeTrue();
});

it('can delete a Inquiry', function () {
    $record = Inquiry::factory()->create();

    Livewire::test('App\Livewire\Fabric\Inquiry\\InquiryTable')
        ->set('selected', [(string) $record->id])
        ->call('deleteSelected')
        ->assertHasNoErrors();

    expect(Inquiry::find($record->id))->toBeNull();
});
