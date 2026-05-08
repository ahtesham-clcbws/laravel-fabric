<?php

use App\Models\Testimonial;
use Livewire\Livewire;
use function Pest\Laravel\get;

it('can render the Testimonial table', function () {
    Testimonial::factory()->count(5)->create();

    get(route('testimonial.index'))
        ->assertStatus(200)
        ->assertSee('Testimonial');
});

it('can search for a Testimonial', function () {
    $record = Testimonial::factory()->create(['author' => 'Fabric Search Target']);
    Testimonial::factory()->create(['author' => 'Other Record']);

    Livewire::test('App\Livewire\Fabric\Testimonial\\TestimonialTable')
        ->set('search', 'Fabric Search Target')
        ->assertSee('Fabric Search Target')
        ->assertDontSee('Other Record');
});

it('can create a new Testimonial', function () {
    Livewire::test('App\Livewire\Fabric\Testimonial\\TestimonialEditor')
        ->set('form.author', 'New Testimonial')
        ->call('save')
        ->assertHasNoErrors()
        ->assertDispatched('testimonial-saved');

    expect(Testimonial::where('author', 'New Testimonial')->exists())->toBeTrue();
});

it('can delete a Testimonial', function () {
    $record = Testimonial::factory()->create();

    Livewire::test('App\Livewire\Fabric\Testimonial\\TestimonialTable')
        ->set('selected', [(string) $record->id])
        ->call('deleteSelected')
        ->assertHasNoErrors();

    expect(Testimonial::find($record->id))->toBeNull();
});
