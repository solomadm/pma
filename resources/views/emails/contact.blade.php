@component('mail::message')

    <h3>{{$sender->first_name}} send message:</h3>

    @component('mail::panel')
        "{{$sender->comments}}"
    @endcomponent

    <h4>Sender data:</h4>

    <table>
        <tr>
            <td>Email</td>
            <td>{{$sender->email}}</td>
        </tr>
        <tr>
            <td>First Name</td>
            <td>{{$sender->first_name}}</td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td>{{$sender->last_name}}</td>
        </tr>
        <tr>
            <td>Nature Of Enquiry</td>
            <td>{{$sender->nature_of_enquiry}}</td>
        </tr>
        <tr>
            <td>Company</td>
            <td>{{$sender->company}}</td>
        </tr>
    </table>

    <br><br><br><br>
    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
