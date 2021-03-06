<?php 

namespace Modules\Core\Composers;

use Illuminate\Contracts\View\View;

class SettingLocalesComposer
{
    public function compose(View $view)
    {
        $view->with('locales', config('facile.core.available-locales'));
    }
}
