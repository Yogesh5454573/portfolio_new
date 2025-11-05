<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Info, Skills, Experence, Service, Project, Contacts};
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function home()
    {
        $info = Info::first();
        $skills = Skills::whereIn('skill_type', ['languages', 'framework'])->get()->groupBy('skill_type');
        $skills_languages = $skills->get('languages', collect());
        $skills_frameworks = $skills->get('framework', collect());
        $experience = Experence::orderBy('id', 'asc')->get();
        $service = Service::where('status', 'active')->get();
        $project = Project::where('status', 'active')->get();
        // dd($skills_languages);
        return view('frontend.home', ['info' => $info, 'skills_languages' => $skills_languages, 'skills_frameworks' => $skills_frameworks, 'experience' => $experience, 'service' => $service, 'project' => $project]);
    }

    public function contact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:5',
        ]);
        Contacts::create($validated);
        Session::flash("success", "Your message has been sent successfully.");
        return redirect()->route('home');
    }

    public function openResumeFile($folder, $token)
    {
        try {
            $InfoData = Info::where(['token' => $token])->first();
            if ($folder == 'resume_files') {
                $destinationPath = "$folder/" . $InfoData->resume_file;
            }
            if (file_exists(Storage::disk('public')->path($destinationPath))) {
                return response()->file(Storage::disk('public')->path($destinationPath), [
                    'Pragma' => 'no-cache',
                    'Expires' => 'Fri, 01 Jan 1990 00:00:00 GMT',
                    'Cache-Control' => 'no-cache, must-revalidate, no-store, max-age=0, private'
                ]);
            }
        } catch (\Exception $e) {
            info('Error in openReportCmeFile(): ' . $e->getMessage());
            Session::flash('error', 'There was some error, please try again later.');
        }
    }

}
