<?php

namespace App\Views\Composers;

class MenuComposer
{
    public function compose($view)
    {
        $menu = [
            "Home" => "/",
            "About" => "/about",
            "Contact" => "/contact"
        ];
        $auth = true;
        if ($auth) {
            $menu = array_merge($menu, [
                "Dashboard" => "/dashboard",
                "Panel Admin" => "/panel_admin",
                "Logout" => "/logout"
            ]);
        }
        $view->with("menu", $menu);
    }
}
