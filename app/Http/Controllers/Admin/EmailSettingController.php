<?php

namespace App\Http\Controllers\Admin;

use App\Models\EmailSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\EmailSettingRequest;

class EmailSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = EmailSetting::latest('id')->get();
            return DataTables::of($data)
                ->addColumn('checkbox', function ($item) {
                    return '<div class="form-check form-check-sm form-check-custom form-check-solid">
                    <input class="form-check-input emailDT-delete" id="manual_entry_' . $item->id . '" name="rowId[]" type="checkbox" value="' . $item->id . '"  />
                </div>';
                })
                ->addColumn('status', function ($row) {
                    $status = $row->status == '1' ? 'Active' : 'Inactive';
                    return '<span class="badge badge-light-' . ($status == 'Active' ? 'success' : 'danger') . ' fs-7 m-1">' . $status . '</span>';
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.email-settings.edit', [$row->id]);
                    $deleteUrl = route('admin.email-settings.destroy', [$row->id]);
                    return '<a href="' . $editUrl . '" class="text-primary"><i class="fas fa-pen text-primary"></i></a>' .
                        '<a href="' . $deleteUrl . '" class="text-danger ms-4 delete"><i class="fas fa-trash-alt text-danger"></i></a>';
                })
                ->rawColumns(['action', 'checkbox', 'status'])
                ->make(true);
        }
        return view('admin.pages.email-settings.index');
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
    }
}
