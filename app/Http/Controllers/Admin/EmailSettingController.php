<?php

namespace App\Http\Controllers\Admin;

use App\Models\EmailSetting;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EmailSettingRequest;

class EmailSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.email-settings.index', [
            'emailSettings' => EmailSetting::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.email-settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmailSettingRequest $request)
    {
        EmailSetting::create([
            'mail_mailer'       => $request->mail_mailer,
            'mail_host'         => $request->mail_host,
            'mail_port'         => $request->mail_port,
            'mail_username'     => $request->mail_username,
            'mail_password'     => $request->mail_password,
            'mail_encryption'   => $request->mail_encryption,
            'mail_from_address' => $request->mail_from_address,
            'mail_from_name'    => $request->mail_from_name,
            'status'            => $request->status,
        ]);

        return redirect()->back()->with('success', 'Email setting created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // deprecated
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view(
            'admin.pages.email-settings.edit',
            ['emailSetting' => EmailSetting::findOrFail($id)]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmailSettingRequest $request, string $id)
    {
        $emailSetting = EmailSetting::findOrFail($id);

        $emailSetting->update([
            'mail_mailer'       => $request->mail_mailer,
            'mail_host'         => $request->mail_host,
            'mail_port'         => $request->mail_port,
            'mail_username'     => $request->mail_username,
            'mail_password'     => $request->mail_password,
            'mail_encryption'   => $request->mail_encryption,
            'mail_from_address' => $request->mail_from_address,
            'mail_from_name'    => $request->mail_from_name,
            'status'            => $request->status,
        ]);

        return redirect()->back()->with('success', 'Email setting updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        EmailSetting::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'EmailSetting deleted successfully');
    }
}
