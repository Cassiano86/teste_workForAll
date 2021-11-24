<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use RealRashid\SweetAlert\Facades\Alert;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware(function($request,$next){
            if (session('success')) {
                Alert::success(session('success'));
            }

            if (session('error')) {
                Alert::error(session('error'));
            }

            return $next($request);
        });
    }

    protected function flashSuccess($title, $message, $icon, $showConfirmButton, $timer){
        self::setupFlash($title, $message, $icon, $showConfirmButton, $timer);
    }

    protected function flashError($title, $message, $icon, $showConfirmButton, $timer){
        self::setupFlash($title, $message, $icon, $showConfirmButton, $timer);
    }

    protected function setupFlash($title, $message, $icon, $showConfirmButton, $timer){
        request()->session()->flash('swal_msg', [
            'title' => $title,
            'message' => $message,
            'icon' => $icon,
            'showConfirmButton' =>$showConfirmButton,
            'timer' => $timer
        ]);
    }
}
