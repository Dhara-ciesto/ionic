<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Image</th>
            <th>Video</th>
            <th>University</th>
            <th>Education</th>
            <th>Other Qualification</th>
            <th>Roles</th>
            <th>CV</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
        <tr>
            <td>{{$item->name}}</td>
            <td>{{$item->email}}</td>
            <td>{{$item->phone}}</td>
            <td>{{$item->image}}</td>
            <td>{{$item->video}}</td>
            <td>{{$item->university}}</td>
            <td>{{$item->education}}</td>
            <td>{{$item->other_qualification}}</td>
            <td>{{$item->roles}}</td>
            <td>{{$item->cv}}</td>
            <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
            <td>{{ date('d-m-Y', strtotime($item->updated_at)) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

