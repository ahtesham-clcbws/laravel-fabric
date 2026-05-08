<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $site_name;
    public string $site_description;
    public string $contact_email;
    public string $contact_phone;
    public string $address;
    public ?string $facebook_url;
    public ?string $twitter_url;
    public ?string $instagram_url;

    public static function group(): string
    {
        return 'general';
    }
}