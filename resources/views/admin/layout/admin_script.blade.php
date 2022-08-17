<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<!-- <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpCVgZWPmJ40w0eN0VRWijvESnfsL-XhM&libraries=places&callback=initMap">
</script> -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link href="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css">
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.js"></script>
<script src="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script>
// 	function initialize() {
//   var input = document.getElementById('searchTextField');
//   new google.maps.places.Autocomplete(input);
// }

// google.maps.event.addDomListener(window, 'load', initialize);
</script>
<script type="text/javascript">
	function previewimgcomm(img)
	{
		
		// var filename = $("#profileimage").val();
		// var extension = filename.replace(/^.*\./, '');
		$('#previewimg').show();
		document.getElementById('previewimg').src = window.URL.createObjectURL(img.files[0]);
	}
	function previewcoverimg(img)
	{
		$('#previecoverwimg').show();
		document.getElementById('previecoverwimg').src = window.URL.createObjectURL(img.files[0]);
	}
</script>
<script>
var $modal = $('#covermodal');
var image = document.getElementById('coverimage');
var cropper;
$("body").on("change", ".coverimage", function(e){

var files = e.target.files;
var done = function (url) {
image.src = url;
$modal.modal('show');
};
var reader;
var file;
var url;
if (files && files.length > 0) {
file = files[0];
if (URL) {
done(URL.createObjectURL(file));
} else if (FileReader) {
reader = new FileReader();
reader.onload = function (e) {
done(reader.result);
};
reader.readAsDataURL(file);
}
}
});
$modal.on('shown.bs.modal', function () {
cropper = new Cropper(image, {
aspectRatio: 1,
viewMode: 3,
preview: '.coverpreview'
});
}).on('hidden.bs.modal', function () {
cropper.destroy();
cropper = null;
});
$("#covercrop").click(function(){
canvas = cropper.getCroppedCanvas({
width: 800,
height: 350,
});
canvas.toBlob(function(blob) {
url = URL.createObjectURL(blob);
var reader = new FileReader();
reader.readAsDataURL(blob); 
reader.onloadend = function() {
var base64datacover = reader.result;
$('#previecoverwimg').attr('src', base64datacover);
$('#coverimg').val(base64datacover);
$modal.modal('hide');
// var image = new Image();
// image.onload = function(){
//    console.log(image.width); // image is loaded and we have image width 
// }
// image.src = base64data;

// return false;
}
});
})
</script>
 <script type="text/javascript">
 $(function () {
     $('#datetimepicker1').datetimepicker({
			format: 'DD-MM-YYYY LT'
		});
 });
</script>
<script type="text/javascript">
 $(function () {
     $('#datetimepicker2').datetimepicker({
			format: 'DD-MM-YYYY LT'
		});
 });
</script>
<script>
$(document).ready(function() {
	
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
   
    $(".file-upload").on('change', function(){
        readURL(this);
    });
    
    $(".upload-button").on('click', function() {
       $(".file-upload").click();
    });
});	
</script>
<script type="text/javascript">
	$("#profile-btn").on('click',function(e)
	{
	    e.preventDefault();
	    if($('#filimg').val() != '')
	    {
	    	$('#profile-err').hide();
	    }else
	    {
	    	$('#profile-err').html('Please upload a pic');
	    	$('#profile-err').css('color','red');
	    }
	    if($('#filimg').val() != '')
	    {
		    $("#profile-form").submit();   	
	    } else
	    {
	    	return false;
	    }

    });
</script>
<script type="text/javascript">
	function add_community()
	{
		// alert('hii');
		var img=$('#profileimage').val(); 
		var title=$('#title').val(); 
		var coverimg=$('#coverimg').val(); 
		var description=$('#description').val();
		
		if(img=='')
		{
			$('#proimg').html('This field is required');
			$('#proimg').css('color','red');
		}else 
		{
			$('#proimg').hide();
		}
		if(title=='')
		{
			$('#commtitle').html('This field is required');
			$('#commtitle').css('color','red');
		}
		else 
		{
			$('#commtitle').hide();
		} 
		if(coverimg=='')
		{
			$('#coverimg').html('This field is required');
			$('#coverimg').css('color','red');
		} 
		else 
		{
			$('#coverimg').hide();
		}
		if(description=='')
		{
			$('#commdes').html('This field is required');
			$('#commdes').css('color','red');
		} 
		else 
		{
			$('#commdes').hide();
		}
		if(img!='' && description!='' && title!='' && coverimg!='')
		{
			$('#community_form').submit();
			
		}else
		{
			return false;
		}
	}
</script>
<script>
$(".toggle-password").click(function() 
{
  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
</script>


<script type="text/javascript">
// $(document).ready(function() {
//     $('#example').DataTable();
// } );
	function showpass() {
  var x = document.getElementById("passlogin");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

<script type="text/javascript">
function validateEmail($email) 
	{
	  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	  return emailReg.test( $email );
   }
  $("#register").on('click',function(e)
	{
	    e.preventDefault();
	    
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
	    
	    if(($('#emailid').val() != '') && ($('#spassword').val() != '') && ($('#scpassword').val() != ''))
	    {
		    if( !validateEmail($('#emailid').val())) 
		    { 
		    	$('#erroremail').html('Email is not valid');
		    	$('#erroremail').css('color','red');
		    	return false;
		    }else{
  				$('#erroremail').hide();
		    }
		    var paswd=  /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,15}$/;
						if($('#spassword').val().match(paswd)) 
						{ 
							
							$('.errorshow').hide();
						}
						else
						{ 
							
						$('.errorshow').html('Password should contain at least one numeric digit and a special character and length between 7 to 15 characters');
						$('.errorshow').css('color','red');
						return false;
						}
				if($('#spassword').val()!=$('#scpassword').val())
				{
					$('.pass-miss').html('Password and Confirm Password not matched!');
					$('.pass-miss').css('color','red');
					return false;
				}else
				{
					$('.pass-miss').hide();
				}
		
		    	$("#registerform").submit();
		    	
	    } else
	    {
	    	return false;
	    }

    });

  $("#loginbtn").on('click',function(e)
	{

	    e.preventDefault();
	    if($('#canteen').val() != '')
	    {
	    	$('#canteen-err').hide();
	    }else
	    {
	    	$('#canteen-err').html('Select Canteen First');
	    	$('#canteen-err').css('color','red');
	    }
	    if($('#emaillogin').val() != '')
	    {
	    	$('#emailloginerr').hide();
	    }else
	    {
	    	$('#emailloginerr').html('Username is required');
	    	$('#emailloginerr').css('color','red');
	    }

	    if($('#passlogin').val() != '')
	    {
	    	$('#passlerr').hide();
	    }else
	    {
	    	$('#passlerr').html('Password is required');
	    	$('#passlerr').css('color','red');
	    }

	    if(($('#emaillogin').val() != '') && ($('#passlogin').val() != '') && ($('#canteen').val() != ''))
	    {

		    // if( !validateEmail($('#emaillogin').val())) 
		    // { 
		    // 	$('#emailerr').html('Email is not valid');
		    // 	$('#emailerr').css('color','red');
		    // 	return false;
		    // }
		    $('#loginform').submit();
		    // if($('#customCheck').prop('checked') == true)
		    // {
	     //      $('#customCheck').attr('name','');
	     //      var remember = $('#customCheck').val();
	     //   }else{
	     //      $('#customCheck').attr('name','');
	     //      // var remember = $('#customCheck').val();
	     //      var remember =0;
	     //   }
		    	// $("#registerform").submit();
		    	
		}else{
 			 return false;
		}
		

	});

  
  $(document).ready(function () {
	$(".alert").fadeTo(5000, 1000).slideUp(1000, function(){
    $(".alert").slideUp(1000);
});
});

$("#forgotbtn").on('click',function(e)
{
    e.preventDefault();

    if($('#emaillidf').val() != '')
    {
    	if(!validateEmail($('#emaillidf').val())) 
		{ 
		    	$('#emailfierr').html('Email is not valid');
		    	$('#emailfierr').css('color','red');
		    	return false;
		}
    	$('#emailferr').hide();
    	$('#forgotform').submit();
    }else
    {
    	$('#emailferr').html('Email is required');
    	$('#emailferr').css('color','red');
    	return false;
    }
}); 

$("#changebtn").on('click',function(e)
	{
	    e.preventDefault();

	    if($('#passwordc').val() != '')
	    {
	    	$('#passcerr').hide();
	    }else
	    {
	    	$('#passcerr').html('Password is required');
	    	$('#passcerr').css('color','red');
	    }

	    if($('#passwordcp').val() != '')
	    {
	    	$('#cperr').hide();
	    }else
	    {
	    	$('#cperr').html('Confirm Password is required');
	    	$('#cperr').css('color','red');
	    } 
	    
	    if(($('#passwordc').val() != '') && ($('#passwordcp').val() != ''))
	    {
				if($('#passwordc').val()!=$('#passwordcp').val())
				{
					$('#passcperr').html('Password and Confirm Password not matched!');
					$('#passcperr').css('color','red');
					return false;
				}else
				{
					$('#passcperr').hide();
				}
		
		    	$("#changepform").submit();
		    	
	    } else
	    {
	    	return false;
	    }

    });

$("#otpbtn").on('click',function(e)
	{
	    e.preventDefault();

	    if($('#otp').val() != '')
	    {
	    	$('#otperr').hide();
	    	// $("#otpform").submit();
	    	var otp=$('#otp').val();
	    	var email=$('#email').val();
	    		$.ajax({
	           headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
	            url: "{{route('admin.checkotp')}}",
	            type: 'POST', 
		           data: {otp:otp, email:email},
		           success: function( data ) 
		           {
		           	  
		           	   if(data==2)
		           	   {
		           	   	    $('#otpinval').html('Invalid OTP');
			                $('#otpinval').css('color','red');
		           	   }else
		           	   {
		           	   		$('#otpinval').html('OTP verify successfully');
			                window.location.href= data.url;
		           	   }
		               
		           }
		       });
	    }else
	    {
	    	$('#otperr').html('OTP is required');
	    	$('#otperr').css('color','red');
	    	return false;
	    }
		    	
    });


</script>
<script type="text/javascript">
	
    function details(i)
     {
     	var title=$('#title'+i).val();
     	var description=$('#des'+i).val();
        $('#titlecom').html(title);
        $('#desall').html(description);
     }

     function imgopen(i)
     {
     	titlenew= $('#title'+i).val();
     	img= $('#img'+i).val();
        $('#titleimg').html(titlenew);
        $('#imges').html('<img src="'+img+'" style="width:250px;height:250px;">');
     }     
</script>

<script type="text/javascript">
	function previewimg(img)
	{
		var filename = $("#file").val();
		var extension = filename.replace(/^.*\./, '');
			$('#editor-sec').hide();
			$('#blah').show();
			$('#audid').hide();
			$('#videoid').hide();
			$('#imgsec').show();
			document.getElementById('blah').src = window.URL.createObjectURL(img.files[0]);
	}

	function descriptionadd() 
	{
		$('#image-add').hide();
	}
</script>
<script type="text/javascript">
$(document).ready(function () {

    $('#create-canteen').validate({ // initialize the plugin
        rules: {
            field1: {
                required: true,
                email: true
            },
            field2: {
                required: true,
                minlength: 5
            }
        }
    });

});

$(document).ready(function () {

    $('#create-department').validate({ // initialize the plugin
        rules: {
            field1: {
                required: true,
                email: true
            },
            field2: {
                required: true,
                minlength: 5
            }
        }
    });

});

$(document).ready(function () {

    $('#create-division').validate({ // initialize the plugin
        rules: {
            field1: {
                required: true,
                email: true
            },
            field2: {
                required: true,
                minlength: 5
            }
        }
    });

});

$(document).ready(function () {

    $('#create-employee-category').validate({ // initialize the plugin
        rules: {
            field1: {
                required: true,
                email: true
            },
            field2: {
                required: true,
                minlength: 5
            }
        }
    });

});

$(document).ready(function () {

    $('#create-item').validate({ // initialize the plugin
        rules: {
            field1: {
                required: true,
                email: true
            },
            // field2: {
            //     required: true,
            //     minlength: 5
            // }
        }
    });

});

$(document).ready(function () {
    $('#item-rate').keyup(function() {
       itemrate= $(this).val();
       empcontribute=$('#empl-rate').val();
       console.log(empcontribute);
        
       if(empcontribute!='')
       {
       	var comrate=itemrate-empcontribute;
			if(empcontribute > itemrate)
	       	 {
	       	 	// alert('Employee rate can not be greater than item rate');
	       	 	$('#employ-rate-error').show();
		       	$('#employ-rate-error').html('Employee rate can not be greater than or eqal to item rate');
		       	$('#employ-rate-error').css('color','red');
		       	return false;
		     }else if(empcontribute < itemrate)
		     {
		       	$('#employ-rate-error').hide();
		     }
		     $('#company-rate').val(comrate);      
       		$('#company-rate-max').val(comrate);
       }
             
       // console.log(itemrate-empcontribute);
    });

});

$(document).ready(function () {
    $('#empl-rate').mouseleave(function() {
       empcontributtion= $(this).val();
       itemrates=$('#item-rate').val();
       
       
       if(itemrates!='')
       {
       	var comcontribution=itemrates-empcontributtion;
       	 if(empcontributtion >= itemrates)
       	 {
       	 	// alert('Employee rate can not be greater than item rate');
       	 	$('#employ-rate-error').show();
	       	$('#employ-rate-error').html('Employee rate can not be greater than or eqal to item rate');
	       	$('#employ-rate-error').css('color','red');
	       	return false;
	     }else if(empcontributtion < itemrates)
	     {
	     	console.log(empcontribute);
	       	$('#employ-rate-error').hide();
	     }
       		$('#company-rate').val(comcontribution);
            $('#company-rate-max').val(comcontribution);
       }
        
    });

});

$(document).ready(function () {

    $('#create-card').validate({ // initialize the plugin
        rules: {
            field1: {
                required: true,
                email: true
            },
            field2: {
                required: true,
                minlength: 5
            }
        }
    });

});

$(document).ready(function () {

    $('#create-user-role').validate({ // initialize the plugin
        rules: {
            field1: {
                required: true,
                email: true
            },
            field2: {
                required: true,
                minlength: 5
            }
        }
    });

});





$(document).ready(function () {
    $('#user-mobile').keypress(function() {
       usermobile= $('#user-mobile').val();
       if(!preg_match('/^[6-9][0-9]{9}$/',usermobile))
       {
	       $('#mobile-error').html('Invalid Mobile number');
	       $('#mobile-error').css('color','red');
       }else
       {
       	   $('#mobile-error').hide();
       }
    });

});

$(document).ready(function(){
$("#selectallview").click(function(){
        if(this.checked){
            $('.checkboxallview').each(function(){
                $(".checkboxallview").prop('checked', true);
            })
        }else{
            $('.checkboxallview').each(function(){
                $(".checkboxallview").prop('checked', false);
            })
        }
    });
});

$(document).ready(function(){
$("#selectalladd").click(function(){
        if(this.checked){
            $('.checkboxalladd').each(function(){
                $(".checkboxalladd").prop('checked', true);
            })
        }else{
            $('.checkboxalladd').each(function(){
                $(".checkboxalladd").prop('checked', false);
            })
        }
    });
});

$(document).ready(function(){
$("#selectallmanage").click(function(){
        if(this.checked){
            $('.checkboxallmanage').each(function(){
                $(".checkboxallmanage").prop('checked', true);
            })
        }else{
            $('.checkboxallmanage').each(function(){
                $(".checkboxallmanage").prop('checked', false);
            })
        }
    });
});

$(document).ready(function(){
$("#selectalledit").click(function(){
        if(this.checked){
            $('.checkboxalledit').each(function(){
                $(".checkboxalledit").prop('checked', true);
            })
        }else{
            $('.checkboxalledit').each(function(){
                $(".checkboxalledit").prop('checked', false);
            })
        }
    });
});

$(document).ready(function(){
$("#selectalldelete").click(function(){
        if(this.checked){
            $('.checkboxalldelete').each(function(){
                $(".checkboxalldelete").prop('checked', true);
            })
        }else{
            $('.checkboxalldelete').each(function(){
                $(".checkboxalldelete").prop('checked', false);
            })
        }
    });
});
</script>
<script type="text/javascript">
	function validateEmail($email) 
{
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}

$(document).ready(function () {
$.validator.setDefaults({
submitHandler: function () {
// $("#user-add").on('click',function(e)
// {
	var useremailid=$('#user-email').val();
	if(typeof useremailid === "undefined")
	{
	}else
	{
		if(!validateEmail($('#user-email').val()))
	    {
	    	$('#email-error').html('Email is not valid');
	    	$('#email-error').css('color','red');
	    	return false;
	    	
	    }else
	    {
	    	$('#email-error').hide();
	    }
	}
    
    var paswd=  /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,15}$/;
				if($('#password').val().match(paswd)) 
				{ 
					$('.errorshow').hide();
				}
				else
				{ 
				$('.errorshow').html('Password should contain at least one numeric digit and a special character and length between 7 to 15 characters');
				$('.errorshow').css('color','red');
				return false;
				}
		if($('#password').val()!=$('#confirmpassword').val())
		{
			$('#pass-conpass-error').html('Password and Confirm Password not matched');
			$('#pass-conpass-error').css('color','red');
			return false;
	    }else
	    {
	    	$('#pass-conpass-error').hide();
	    }
    	$("#add-users").submit();

    }
    });
    });
$(document).ready(function () {

    $('#add-users').validate({ // initialize the plugin
        rules: {
            field1: {
                required: true,
                email: true
            },
            field2: {
                required: true,
                minlength: 5
            }
        }
    });

});
</script>
<script type="text/javascript">
	$(document).ready(function () {
$.validator.setDefaults({
submitHandler: function () {
// $("#user-add").on('click',function(e)
// {    
    var paswd=  /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,15}$/;
				if($('#NewPassword').val().match(paswd)) 
				{ 
					$('.errorshow').hide();
				}
				else
				{ 
				$('.errorshow').html('Password should contain at least one numeric digit and a special character and length between 7 to 15 characters');
				$('.errorshow').css('color','red');
				return false;
				}
		if($('#NewPassword').val()!=$('#NewPasswordConfirm').val())
		{
			$('#pass-conpass-error').html('Password and Confirm Password not matched');
			$('#pass-conpass-error').css('color','red');
			return false;
	    }else
	    {
	    	$('#pass-conpass-error').hide();
	    }
    	$("#change-password-form").submit();

    }
    });
    });
	$(document).ready(function () {

    $('#change-password-form').validate({ // initialize the plugin
        rules: {
            field1: {
                required: true,
                email: true
            },
            field2: {
                required: true,
                minlength: 5
            }
        }
    });

});

</script>


  