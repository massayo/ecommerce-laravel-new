<p>Dear {{ $seller->name; }}</p>
<p>
    We have received a request to reset the password for Laravecom account
    associated with {{ $seller->email }} .
    You can reset the password by clicking the button below:
    <br>
    <a href="{{ $actionLink }}" target="_blank" style="color:#fff; border-color:#22bc66
    ;border-style:solid;border-with:5px 10px;background-color:#22bc66;display:inline-block;
    text-decoration:none;border-radius:3px;box-shadow:0 2px 3px rgba(0,0,0,0.16);
    -webkit-text-size-adjust:none;box-sizing:border-box;">Reset password
    </a>
    <br>
    <b>NB:</b> The above link is valid 15 minutes.
    <br>
    If you did not request a password reset, please ignore this email.
</p>