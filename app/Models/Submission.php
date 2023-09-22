<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'role',
        'full_name',
        'current_location',
        'contact_number',
        'email',
        'visa_status',
        'w2_rate',
        'c2c_rate',
        'c2c_employer_name',
        'c2c_employer_email',
        'c2c_employer_contact',
        'client_name',
        'end_client_name',
        'submission_to_client_rate',
        'client_manager_name',
        'acestack_manager_name',
        'recruiter_name',
        'update_by_acestack_manager',
        'update_from_client',
        'resume_or_other_documents',
        'country',
        'state',
        'city',
        'candidate_status'
    ];

    public function country_obj()
    {
        return $this->belongsTo(Country::class, 'country');
    }
    public function state_obj()
    {
        return $this->belongsTo(State::class, 'state');
    }
    public function city_obj()
    {
        return $this->belongsTo(City::class, 'city');
    }
    public function client()
    {
        // return $this->belongsTo(Client::class, 'client_manager_name');
        return $this->belongsTo(Client::class, 'client_name');
    }
    public function manager()
    {
        return $this->belongsTo(Manager::class, 'acestack_manager_name');
    }
    public function recruiter()
    {
        return $this->belongsTo(Recruiter::class, 'recruiter_name');
    }
}
