	
	<title>iStudyBooks - Sell and buy schoolbooks</title>
<div id="container">
	<h1>iStudyBooks</h1>
   <h2>Welcome <?php 
   $session_data = $this->session->userdata('logged_in');
   if(!empty($session_data['username'])){ echo $session_data['username']; } ?>!</h2>

	<div id="body">
		<p></p>
	</div>

</div>