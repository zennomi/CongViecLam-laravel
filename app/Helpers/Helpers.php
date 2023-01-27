<?php

use App\Models\WebsiteSettings;

function website_setting()
{
    return WebsiteSettings::first();
}
