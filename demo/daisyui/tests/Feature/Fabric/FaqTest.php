<?php

use App\Models\Faq;
use Livewire\Livewire;
use function Pest\Laravel\get;

it('can render the Faq table', function () {
    Faq::factory()->count(5)->create();

    get(route('faq.index'))
        ->assertStatus(200)
        ->assertSee('Faq');
});

it('can search for a Faq', function () {
    $record = Faq::factory()->create(['question' => 'Fabric Search Target']);
    Faq::factory()->create(['question' => 'Other Record']);

    Livewire::test('App\Livewire\Fabric\Faq\\FaqTable')
        ->set('search', 'Fabric Search Target')
        ->assertSee('Fabric Search Target')
        ->assertDontSee('Other Record');
});

it('can create a new Faq', function () {
    Livewire::test('App\Livewire\Fabric\Faq\\FaqEditor')
        ->set('form.question', 'New Faq')
        ->call('save')
        ->assertHasNoErrors()
        ->assertDispatched('faq-saved');

    expect(Faq::where('question', 'New Faq')->exists())->toBeTrue();
});

it('can delete a Faq', function () {
    $record = Faq::factory()->create();

    Livewire::test('App\Livewire\Fabric\Faq\\FaqTable')
        ->set('selected', [(string) $record->id])
        ->call('deleteSelected')
        ->assertHasNoErrors();

    expect(Faq::find($record->id))->toBeNull();
});
