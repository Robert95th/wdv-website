<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MailingList;
use Illuminate\Http\Request;

class MailingListController extends Controller
{
    public function index()
    {
        $recipients = MailingList::latest()->get();
        return view('admin.mailing-list.index', compact('recipients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:mailing_lists,email',
        ]);

        MailingList::create([
            'name' => $request->name,
            'email' => $request->email,
            'is_active' => true,
        ]);

        return back()->with('success', 'Recipient added successfully.');
    }

    public function toggle(MailingList $mailingList)
    {
        $mailingList->update(['is_active' => !$mailingList->is_active]);
        return back()->with('success', 'Status updated.');
    }

    public function destroy(MailingList $mailingList)
    {
        $mailingList->delete();
        return back()->with('success', 'Recipient removed.');
    }
}
