<table>
    <thead>
        <tr>
            <th>Client Id</th>
            <th>Role</th>
            <th>Full Name</th>
            <th>Contact Number</th>
            <th>Email</th>
            <th>Country</th>
            <th>State</th>
            <th>City</th>
            <th>Visa Status</th>
            <th>W2 Rate</th>
            <th>C2c Rate</th>
            <th>C2c Employer Name</th>
            <th>C2c Employer Email</th>
            <th>C2c Employer Contact</th>
            <th>Client Name</th>
            <th>End Client Name</th>
            <th>Submission to Client Rate</th>
            <th>Client Manager Name</th>
            <th>Acestack Manager Name</th>
            <th>Recruiter Name</th>
            <th>Update by Acestack Manager</th>
            <th>Update From Client</th>
            <th>Resume or Other Documents</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
    </thead>
    <tbody>
        @foreach($submissions as $submission)
        <tr>
            <td>{{$submission->client_id}}</td>
            <td>{{$submission->role}}</td>
            <td>{{$submission->full_name}}</td>
            <td>{{$submission->contact_number}}</td>
            <td>{{$submission->email}}</td>
            <td>{{$submission->country_obj ? $submission->country_obj->name : ''}}</td>
            <td>{{$submission->state_obj ? $submission->state_obj->name : ''}}</td>
            <td>{{$submission->city_obj ? $submission->city_obj->name : ''}}</td>
            <td>{{$submission->visa_status}}</td>
            <td>{{$submission->w2_rate}}</td>
            <td>{{$submission->c2c_rate}}</td>
            <td>{{$submission->c2c_employer_name}}</td>
            <td>{{$submission->c2c_employer_email}}</td>
            <td>{{$submission->c2c_employer_contact}}</td>
            <td>{{$submission->client ? $submission->client->name : ''}}</td>
            <td>{{$submission->end_client_name}}</td>
            <td>{{$submission->submission_to_client_rate}}</td>
            <td>{{$submission->client_manager_name}}</td>
            <td>{{$submission->acestack_manager_name && $submission->manager ? $submission->manager->name : ''}}</td>
            <td>{{$submission->recruiter_name && $submission->recruiter ? $submission->recruiter->name : ''}}</td>
            <td>{{$submission->update_by_acestack_manager}}</td>
            <td>{{$submission->update_from_client}}</td>
            <td>{{$submission->resume_or_other_documents}}</td>
            <td>{{ date('d-m-Y', strtotime($submission->created_at)) }}</td>
            <td>{{ date('d-m-Y', strtotime($submission->updated_at)) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
