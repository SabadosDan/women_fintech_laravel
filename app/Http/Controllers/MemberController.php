<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MemberController extends Controller
{

    public function index(Request $request)
    {
        $query = Member::query();

        if ($request->filled('first_name')) {
            $query->where('first_name', 'like', '%' . $request->first_name . '%');
        }

        if ($request->filled('profession')) {
            $query->where('profession', 'like', '%' . $request->profession . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        $members = $query->paginate(10);
        return view('members.index', compact('members'));
    }


    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:members',
            'profession' => 'required',
            'linkedin_profile' => 'nullable|url',
        ]);

        Member::create($request->all());
        return redirect()->route('members.index')->with('success', 'Member created successfully.');
    }

    public function show($id)
    {
        $member = Member::findOrFail($id);
        return view('members.show', compact('member'));
    }

    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:members,email,' . $id,
            'profession' => 'required',
            'linkedin_profile' => 'nullable|url',
        ]);

        $member = Member::findOrFail($id);
        $member->update($request->all());
        return redirect()->route('members.index')->with('success', 'Member updated successfully.');
    }

    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Member deleted successfully.');
    }

    public function export()
    {
        $members = Member::all();

        // $response = new StreamedResponse(function () use ($members) {
        //     $handle = fopen('php://output', 'w');
        //     fputcsv($handle, ['First Name', 'Last Name', 'Email', 'Profession']);

        //     foreach ($members as $member) {
        //         fputcsv($handle, [
        //             $member->first_name,
        //             $member->last_name,
        //             $member->email,
        //             $member->profession,
        //         ]);
        //     }

        //     fclose($handle);
        // });

        // $response->headers->set('Content-Type', 'text/csv');
        // $response->headers->set('Content-Disposition', 'attachment; filename="members.csv"');

        // return $response;
        $csv = fopen('php://output', 'w');
        fputcsv($csv, ['Name', 'Email', 'Profession', 'Company', 'Status']);
        foreach ($members as $member) {
            fputcsv($csv, [
                $member->first_name,
                $member->last_name,
                $member->email,
                $member->profession,
            ]);
        }
        fclose($csv);
        return response()->streamDownload(function () use ($csv) {}, 'members.csv');
    }
}
