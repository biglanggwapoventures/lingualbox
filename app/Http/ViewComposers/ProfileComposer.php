<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use Auth;

class ProfileComposer
{
    public function __construct()
    {
       
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $displayPhoto = asset('images/display-photo-placeholder.png');
        if(!empty($user->preference)){
            $displayPhoto = asset("uploads/{$user->id}/display/{$user->preference->display_photo_filename}");
        }
        $view->with('displayPhoto', $displayPhoto);
    }
}