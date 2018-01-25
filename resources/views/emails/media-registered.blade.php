@component('mail::message')

    <h3>Added new media:</h3>


    <h4>Sender data:</h4>

    <table>
        <tr>
            <td>Email</td>
            <td>{{$media->email}}</td>
        </tr>
        <tr>
            <td>First Name</td>
            <td>{{$media->first_name}}</td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td>{{$media->last_name}}</td>
        </tr>
    </table>

    <br><br><br><br>
    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
