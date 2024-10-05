<p>Dear {{ $seller->name; }}</p>
<br>
<p>
    Your password was successfully changed. Here are your credentials:
    <br>
    <b>Login ID: </b> {{ $seller->username }}  or  {{ $seller->email }}
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