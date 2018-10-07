<table>
    <thead>
    <tr> 
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <!-- <th>Password</th>
        <th>Encrypted</th> -->
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr> 
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <!-- <td>{{ substr($user->email, 0, 3).substr(md5($user->id), -12) }}</td>
            <td>{{ bcrypt(substr($user->email, 0, 3).substr(md5($user->id), -12)) }}</td> -->
        </tr>
    @endforeach
    </tbody>
</table>