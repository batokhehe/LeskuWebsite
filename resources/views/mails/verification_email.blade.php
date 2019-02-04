Hello <i>{{ $demo->receiver }}</i>,
<p>This is a demo email for testing purposes! Also, it's the HTML version.</p>
 
<p><u>Demo object values:</u></p>
 
<div>
<p><b>Name : </b>&nbsp;{{ $demo->name }}</p>
<p><b>Activation Code :</b>&nbsp;{{ url('/auth/verification?code=' . $demo->activation_code) }}</p>
</div>
 
Thank You,
<br/>
<i>{{ $demo->sender }}</i>