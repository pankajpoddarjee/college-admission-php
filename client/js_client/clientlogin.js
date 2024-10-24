function verifyLogin()
{	
	if($.trim($('#txtusername').val())=="")	
	{  
		$("#msgcontent").html("Enter User name.");
			//$("#ValidationAlert").modal.(show);
			$('#ValidationAlert').modal();
		$('#txtusername').focus()
		return false;
	}
	if($.trim($('#txtpassword').val())=="")	
	{
		$("#msgcontent").html("Enter Password.");
			$("#ValidationAlert").modal();
		$('#txtpassword').focus()
		return false;
	}
		
		 
		var form = $("#frmuser");
		var csrfToken = $('meta[name="csrf-token"]').attr('content');
		$.ajax({                                      
		  url:'verifyuser.php',                     
		   type:'POST',
		   data: "username="+$('#txtusername').val()+"&password="+$('#txtpassword').val(),
		   dataType: 'json',
		   headers: {
			'X-CSRF-Token': csrfToken
			},
		  success: function(data)
		  {
		  //alert(JSON.stringify(data));
 				if(data.status==0)
				{
					$("#msgcontent").html(data.msg);
					$("#ValidationAlert").modal();
					return false
				}
				else
				{
					$("#frmlogin").attr('action', data.actionurl); 
					$("#frmlogin").submit();
				}
				
			}
		});

		
	
}

function generate_token(){
	location.reload();
}