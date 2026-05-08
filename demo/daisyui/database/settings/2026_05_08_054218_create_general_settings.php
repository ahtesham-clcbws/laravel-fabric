<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'Laravel Fabric Demo');
        $this->migrator->add('general.site_description', 'A high-performance DaisyUI demo built with Laravel Fabric.');
        $this->migrator->add('general.contact_email', 'admin@example.com');
        $this->migrator->add('general.contact_phone', '+1 234 567 890');
        $this->migrator->add('general.address', '123 Fabric Lane, Digital City');
        $this->migrator->add('general.facebook_url', 'https://facebook.com');
        $this->migrator->add('general.twitter_url', 'https://twitter.com');
        $this->migrator->add('general.instagram_url', 'https://instagram.com');
    }
};
