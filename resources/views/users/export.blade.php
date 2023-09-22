<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Company</th>
            <th>DOB</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->company }}</td>
            <td>{{ $user->dob }}</td>
            <td>{{ date('d-m-Y', strtotime($user->created_at)) }}</td>
            <td>{{ date('d-m-Y', strtotime($user->updated_at)) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
