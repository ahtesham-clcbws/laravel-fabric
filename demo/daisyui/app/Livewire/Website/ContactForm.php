<?php

namespace App\Livewire\Website;

use Livewire\Component;
use App\Models\Inquiry;

class ContactForm extends Component
{
    public string $name = '';
    public string $email = '';
    public string $subject = '';
    public string $message = '';

    public function submit()
    {
        $this->validate([
            'name' => 'required|min:2',
            'email' => 'required|email',
            'message' => 'required|min:10',
        ]);

        Inquiry::create([
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);

        $this->reset();
        session()->flash('success', 'Your message has been sent successfully! We will get back to you soon.');
    }

    public function render()
    {
        return view('livewire.website.contact-form');
    }
}
