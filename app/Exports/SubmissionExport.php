<?php

namespace App\Exports;

use App\Models\Submission;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class SubmissionExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Submission::all();
    // }

    public function view(): View
    {
        return view('submission.export', [
            'submissions' => Submission::with('country_obj', 'state_obj', 'city_obj', 'client', 'manager', 'recruiter')->get()
        ]);
    }
}
