<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function about() {
        return view('frontend.pages.about');
    }
    public function faq() {
        return view('frontend.pages.faq');
    }
    public function login() {
        return view('frontend.pages.custom-login');
    }
    public function register() {
        return view('frontend.pages.custom-register');
    }
    public function mail_success() {
        return view('frontend.pages.mail-success');
    }
    public function error() {
        return view('frontend.pages.404-error');
    }

    public function forgot_password() {
        return view('frontend.pages.forgot-password');
    }
}
