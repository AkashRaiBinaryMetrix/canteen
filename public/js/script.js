
function validateEmail($email) 
	{
	  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	  return emailReg.test( $email );
   }
  $("#register").on('click',function(e)
	{
	    e.preventDefault();
	    
	    if($('#username').val() != '')
	    {
	    	$('#snameerr').hide();
	    }else
	    {
	    	$('#snameerr').html('Username is required');
	    	$('#snameerr').css('color','red');
	    }
	    
	    if($('#emailid').val() != '')
	    {
	    	$('#semailerr').hide();
	    }else
	    {
	    	$('#semailerr').html('Email is required');
	    	$('#semailerr').css('color','red');
	    }

	    if($('#spassword').val() != '')
	    {
	    	$('#spasserr').hide();
	    }else
	    {
	    	$('#spasserr').html('Password is required');
	    	$('#spasserr').css('color','red');
	    }

	    if($('#scpassword').val() != '')
	    {
	    	$('#scpasserr').hide();
	    }else
	    {
	    	$('#scpasserr').html('Confirm Password is required');
	    	$('#scpasserr').css('color','red');
	    } 
	    
	    if(($('#username').val() != '') && ($('#emailid').val() != '') && ($('#spassword').val() != '') && ($('#scpassword').val() != ''))
	    {

		    if( !validateEmail($('#emailid').val())) 
		    { 
		    	$('#erroremail').html('Email is not valid');
		    	$('#erroremail').css('color','red');
		    	return false;
		    }
				if($('#spassword').val()!=$('#scpassword').val())
				{
					$('#errorshow').html('Password and Confirm Password not matched!');
					$('#errorshow').css('color','red');
					return false;
				}else
				{
					$('#errorshow').hide();
					
				}
		    if(($('#spassword').val().length!=8) && ($('#scpassword').val().length!=8))
		    {
		    	$('#passlength').html('Password length should be 8');
		    	$('#passlength').css('color','red');
		    	return false;
		    }else
		    {
		    	$('#passlength').hide();
		    }
		    	$("#registerform").submit();
		    	
	    } else
	    {
	    	return false;
	    }



    });

  