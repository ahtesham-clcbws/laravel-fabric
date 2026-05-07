<?php

namespace App\Enums;

enum CompanyType: string
{
    case STARTUP = 'startup';
    case ENTERPRISE = 'enterprise';
    case NGO = 'ngo';

    public function getLabel(): string
    {
        return match($this) {
            self::STARTUP => 'Startup',
            self::ENTERPRISE => 'Enterprise',
            self::NGO => 'Non-Profit',
        };
    }
}
