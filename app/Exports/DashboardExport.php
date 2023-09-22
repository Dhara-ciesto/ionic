<?php

namespace App\Exports;

use App\Models\Profile;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
class DashboardExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Profile::all();
    }

    // public function view(): View
    // {
    //     return view('export', [
    //         'data' => Profile::get()
    //     ]);

    // }
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone',
            'University',
            'Education',
            'Roles',
            'Created At',
            'Updated At'
        ];
    }

    public function map($profile): array
    {

        return [
            $profile->name,
            $profile->email,
            $profile->phone,
            $this->formatUniverisity($profile->university),
            $this->formatEducation($profile->education),
            $this->formatRoles($profile->roles),
            $profile->created_at,
            $profile->updated_at,
        ];
    }

    public function formatUniverisity($data){
        $str = "";

        $data = json_decode($data);

        foreach($data as $value){
            foreach($value as $k=>$v){
                if($k == 'university'){
                    $str .= 'University:'.$v.",";
                }
                if($k == 'grades_achieved'){
                    $str .= 'Grades Achieved:'.$v.",";
                }
                if($k == 'degree'){
                    $str .= 'Degree:'.$v.",";
                }
            }
            $str = rtrim($str,",");
            $str .= ";";
        }

        return $str;
    }
    public function formatEducation($data){
        $str = "";

        $data = json_decode($data);

        foreach($data as $value){
            foreach($value as $k=>$v){
                if($k == 'education_institutional'){
                    $str .= 'Education Institution:'.$v.",";
                }
                if($k == 'education_level'){
                    $str .= 'Education Level:'.$v.",";
                }
                if($k == 'grades_achieved2'){
                    $str .= 'Grades Achieved:'.$v.",";
                }
            }
            $str = rtrim($str,",");
            $str .= ";";
        }

        return $str;
    }
    public function formatRoles($data){
        $str = "";

        $data = json_decode($data);

        foreach($data as $value){
            foreach($value as $k=>$v){
                if($k == 'city'){
                    $str .= 'City:'.$v.",";
                }
                if($k == 'industry'){
                    $str .= 'Industry:'.$v.",";
                }
                if($k == 'job_type'){
                    $str .= 'Job Type:'.$v.",";
                }
            }
            $str = rtrim($str,",");
            $str .= ";";
        }

        return $str;
    }
}
