<?php
$captchaURL = BASE_URL_ROOT . '/captcha.php'; 

$currentUrl ="";
// Check if the request is HTTPS
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';

// Get the host (domain name)
$host = $_SERVER['HTTP_HOST'];

// Get the request URI (the path and query string)
$requestUri = $_SERVER['REQUEST_URI'];

// Construct the full URL
$currentUrl = $protocol . '://' . $host . $requestUri;

//echo $currentUrl;
?>

<!-- Modal form HTML with reCAPTCHA -->
<div class="modal fade" id="report_a_problem"  data-backdrop="static" data-keyboard="false" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="totalImportantDatesApplication">Report A Problem</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="report_problem_form" name="report_problem_form" action="Save_report_problem.php" method="post" onsubmit="return false;">
        <div class="modal-body text-center">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <th scope="row">Name</th>
                <td><input type="text" class="form-control" name="name" id="name"></td>
              </tr>
              <tr>
                <th scope="row">Email</th>
                <td><input type="text" class="form-control" name="email" id="email"></td>
              </tr>
              <tr>
                <th scope="row">Mobile</th>
                <td><input type="text" class="form-control" name="mobile" id="mobile" maxlength="10" onKeyPress="inputNumber(event,this.value,false);" inputmode="numeric"></td>
              </tr>
              <tr>
                <th scope="row">URL</th>
                <td><input type="text" class="form-control" name="report_problem_url" id="report_problem_url" value="<?php echo $currentUrl ?>"></td>
              </tr>
              <tr>
                <th scope="row">Description</th>
                <td><textarea class="form-control" name="report_problem_description" id="report_problem_description"></textarea></td>
              </tr>
              <tr>
                <th scope="row">Captcha</th>
                <td><img id="captchaImage" src="<?php echo $captchaURL;?>" alt="CAPTCHA Image"><i onclick="regenerateCaptcha()" class="fa fa-refresh" aria-hidden="true"></i></td>
              </tr>
              <tr>
                <th scope="row">Captcha</th>
                <td><input maxlength="6" type="text" id="captcha" name="captcha" placeholder="Enter the text from the image" ></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button class="btn btn-danger btn-sm" id="submit" name="submit" onClick="submitReportProblem();" tabindex="6">Save Data</button>
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $(document).on('click', '.reportAProblem', function() {
      var myModal = new bootstrap.Modal(document.getElementById('report_a_problem'), {
              backdrop: 'static',
              keyboard: false
          });
          
          // Show the modal
          myModal.show();
      });

  function regenerateCaptcha() {
      document.getElementById('captchaImage').src = '<?php echo $captchaURL;?>?' + Date.now();
  }
  function submitReportProblem() 
  { 
      if (!verifyInput()) return false;
      saveReportData();
  }

  function verifyInput() {


      if ($.trim($("#name").val()) == "") {
          toastr.error("Enter Your Name");
          $("#name").focus();
          return false;
      } 
      if($.trim($("#email").val())=="")
      {
          toastr.error("Enter Email Id.");
          $("#email").focus();
          return false;
      }
      else
      {
          var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
          if(!filter.test($.trim($("#email").val())))
          {
              
              toastr.error("Enter E-mail in valid format");
              $("#email").focus();
              return false;
          }
      }

      if($.trim($("#mobile").val())=="")

      {
        toastr.error("Enter Mobile Number");
        $("#mobile").focus();
        return false;
      }

      if($.trim($("#mobile").val())!="" ) 
      {
        var  mobno = $("#mobile").val().replaceAll(/\s/g,'') ;
        if(mobno.length!=10 ) { 
        toastr.error("Enter valid Mobile Number");
        $("#mobile").focus();
        return false;
        }
        
      }

      if ($.trim($("#report_problem_url").val()) == "") {
          toastr.error("Enter URL");
          $("#report_problem_url").focus();
          return false;
      } 
      if ($.trim($("#report_problem_description").val()) == "") {
          toastr.error("Please write your issue");
          $("#report_problem_description").focus();
          return false;
      }
      if ($.trim($("#captcha").val()) == "") {
          toastr.error("Enter Captcha");
          $("#captcha").focus();
          return false;
      }
      return true;
  }

  function saveReportData() {
      var form1 = $('#report_problem_form');
      $('#dvLoading').show();
      $.ajax({
          type: "post",
          async: false,
          url: "<?php echo BASE_URL;?>/Save_report_problem.php",
          data: form1.serialize(),
          dataType: "json",
          success: function(data) {
              // alert(JSON.stringify(data))
              if (data.status == 1) {
                  alert(data.msg);
                  regenerateCaptcha();
                  $('#dvLoading').hide();
                  toastr.success(data.msg);
                  $('#report_a_problem').modal('hide');
                  location.reload();
              } else {
                  $('#dvLoading').hide();
                  toastr.error(data.msg);
                  //alert(data.msg);
                  return false;
              }
          }
      });
  }

  function inputNumber(e,val,allowdecimal)
{
	
    var key=(window.event) ? event.keyCode : e.charCode || 0;
	
	if(allowdecimal==true)
	{
		if(key==0 || key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57))
	    {	
		    if(key==46)
		    {
			    if(val.indexOf(".")!=-1)
			    {
				    if(window.event)
				    {
					    event.returnValue=false
				    }
				    else
				    {
					    e.preventDefault()
				    }
			    }
		    }
	    }      
	    else
	    {
		    if(window.event)
		    {
			    event.returnValue=false
		    }
		    else
		    {
			    e.preventDefault()
		    }
	    }
	}
	else
	{
		if(key==0 || key == 8 || key == 9 || (key >= 48 && key <= 57))
		{	
			
		}      
		else
		{
			if(window.event)
			{
				event.returnValue=false
			}
			else
			{
				e.preventDefault()
			}
		}
	}
}
</script>