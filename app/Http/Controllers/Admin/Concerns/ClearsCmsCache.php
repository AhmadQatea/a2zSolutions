<?php

namespace App\Http\Controllers\Admin\Concerns;

use App\Models\SiteSetting;
use App\Services\Cms\SiteDataService;

trait ClearsCmsCache
{
    /**
     * Clear the cached runtime CMS config so public pages reflect the latest admin changes.
     *
     * @param  list<string>  $settingGroups  Optional site_settings groups to forget as well.
     */
    protected function clearCmsCache(array $settingGroups = []): void
    {
        SiteDataService::clearCache();

        foreach ($settingGroups as $group) {
            SiteSetting::forgetGroupCache($group);
        }
    }
}
