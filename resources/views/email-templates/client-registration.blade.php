<p>Dear {{ $client->name; }}</p>
<br>
<p>
    Thank you for registering. Here are your credentials:
    <br>
    <b>Login ID: </b> {{ $client->username }}  or  {{ $client->email }}
    <br>
    <b>Password: </b>{{ $new_password }}
</p>
<br>
Please keep your credentials confidential. Never share them with somebody else.
<p>
    We will not be liable for any mis use of your credentials.
</p>
<br>
-----------------------------------------------------------------
<p>
    This email was automatically sent by Laravecom system. Do not reply it
</p>