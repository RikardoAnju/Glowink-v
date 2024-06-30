<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        return view('profiles.index', compact('profile'));
    }

    public function create()
    {
        return view('profiles.create');
    }

    public function store(Request $request)
{
    try {
        $request->validate([
            'nama_member' => 'required',
            'tanggal_lahir' => 'required|date',
            'email' => 'required|email|unique:profiles',
            'jenis_kelamin' => 'required',
            'pekerjaan' => 'required',
            'alamat' => 'required',
            'foto_profile' => 'nullable|image',
        ]);

        $data = $request->all();
        $data['member_id'] = auth()->user()->id; // Assign member_id to logged in user's ID

        if ($request->hasFile('foto_profile')) {
            $data['foto_profile'] = $request->file('foto_profile')->store('profile_pictures', 'public');
        }

        Profile::create($data);

        return redirect()->route('profiles.index')->with('success', 'Profile successfully created.');
    } catch (\Exception $e) {
        Log::error('Error creating profile: ' . $e->getMessage());
        return back()->withInput()->with('error', 'Failed to create profile. ' . $e->getMessage());
    }
}


    public function edit(Profile $profile)
    {
        return view('profiles.edit', compact('profile'));
    }

    public function update(Request $request, $id)
{
    try {
        $profile = Profile::findOrFail($id);

        $request->validate([
            'nama_member' => 'required',
            'tanggal_lahir' => 'required|date',
            'email' => 'required|email|unique:profiles,email,' . $profile->id,
            'jenis_kelamin' => 'required',
            'pekerjaan' => 'required',
            'alamat' => 'required',
            'foto_profile' => 'nullable|image',
        ]);

        $data = $request->all();
        $data['member_id'] = auth()->user()->id; // Ensure member_id stays with logged in user's ID

        if ($request->hasFile('foto_profile')) {
            $data['foto_profile'] = $request->file('foto_profile')->store('profile_pictures', 'public');
        } else {
            unset($data['foto_profile']); // To prevent overwriting with null if no new file uploaded
        }

        $profile->update($data);

        return redirect()->route('profiles.index')->with('success', 'Profile successfully updated.');
    } catch (\Exception $e) {
        Log::error('Error updating profile: ' . $e->getMessage());
        return back()->withInput()->with('error', 'Failed to update profile. ' . $e->getMessage());
    }
}


    public function destroy(Profile $profile)
    {
        try {
            // Hapus foto profile jika ada
            if ($profile->foto_profile) {
                Storage::delete('public/' . $profile->foto_profile);
            }

            $profile->delete();

            Log::info('Profile deleted: ' . json_encode($profile));

            return redirect()->route('profiles.index')->with('success', 'Profile deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting profile: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete profile. ' . $e->getMessage());
        }
    }
}
