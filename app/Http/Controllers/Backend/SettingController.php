<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        return view('backend.settings.index');
    }

    public function update(Request $request)
{
    $request->validate([
        'logo_dark' => ['nullable', File::image(allowSvg: true)->max(2048)],
        'logo_white' => ['nullable', File::image(allowSvg: true)->max(2048)],
        'favicon' => ['nullable', File::image(allowSvg: true)->max(1024)],
    ]);

    if ($request->hasFile('logo_dark')) {
        $oldLogoDark = Setting::get('logo_dark');
        if ($oldLogoDark && Storage::disk('public')->exists($oldLogoDark)) {
            Storage::disk('public')->delete($oldLogoDark);
        }

        $logoPath = $request->file('logo_dark')->store('settings', 'public');
        Setting::set('logo_dark', $logoPath);
    }

    if ($request->hasFile('logo_white')) {
        $oldLogoWhite = Setting::get('logo_white');
        if ($oldLogoWhite && Storage::disk('public')->exists($oldLogoWhite)) {
            Storage::disk('public')->delete($oldLogoWhite);
        }

        $logoPath = $request->file('logo_white')->store('settings', 'public');
        Setting::set('logo_white', $logoPath);
    }

    if ($request->hasFile('favicon')) {
        $oldFavicon = Setting::get('favicon');
        if ($oldFavicon && Storage::disk('public')->exists($oldFavicon)) {
            Storage::disk('public')->delete($oldFavicon);
        }

        $faviconPath = $request->file('favicon')->store('settings', 'public');
        Setting::set('favicon', $faviconPath);
    }

    $fields = [
        'site_name', 'contact', 'address',
        'mailer', 'host', 'port', 'username', 'password', 'mail_encryption',
        'stripe_key', 'stripe_secret'
    ];

    foreach ($fields as $key) {
        Setting::set($key, $request->input($key));
    }

    return redirect()->back()->with('success', 'Settings updated successfully.');
}

}

