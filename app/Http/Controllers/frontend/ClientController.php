<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Info, Skills, Experence, Service, Project};

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
        return view('frontend.home', ['info' => $info, 'skills_languages' => $skills_languages, 'skills_frameworks' => $skills_frameworks, 'experience' => $experience, 'service' => $service, 'project' => $project]);
    }
}
