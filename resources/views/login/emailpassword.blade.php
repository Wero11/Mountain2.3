<!DOCTYPE html>
 <html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
       <div>
             Dear <?php echo $first_name.' ',$last_name; ?><br/>           
             We received a request for resend your Username/Password ,Please find the details below.<br />
             UserName: <?php echo $user_name;?>.<br />
             Password: <?php echo $password;?>
 			<br />         
		  Best regards,<br />
		  The Mountain Team
        </div>
    </body>
</html>


