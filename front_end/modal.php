<div class="modal fade" id="ImportantDatesApplication" tabindex="-1" role="dialog" aria-labelledby="ImportantDatesApplicationTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="totalImportantDatesApplication">Important Dates <?php echo CURRENT_YEAR;?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <!--<p class="text-left text-danger font-weight-bold"><i class="fa fa-calendar"></i> Phase 1 Important Dates <i class="fa fa-hand-o-down"></i></p>-->
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">Particulars</th>
              <th scope="col">Dates</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">Online application begins on</th>
              <td>August 02, 2021<br>(10:00 AM)</td>
            </tr>
            <tr>
              <th scope="row">Online Application Ends</th>
              <td>August 27, 2021<br>(11:00 PM)</td>
            </tr>
            <!--<tr>
              <th scope="row">Online Payment Starts from</th>
              <td>10.08.2020</td>
            </tr>
            <tr>
              <th scope="row">Last date of Online Payment</th>
              <td>TBA</td>
            </tr>-->
            <tr>
              <th scope="row">Merit list will be published on</th>
              <td>August 29, 2021<br>(02:00 PM)</td>
            </tr>
            <tr>
              <th scope="row">Online admission begins on</th>
              <td>September 01, 2021<br>(10:00 AM)</td>
            </tr>
            <tr>
              <th scope="row">Online admission ends on</th>
              <td>September 30, 2021<br>(11:00 PM)</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="helpline" tabindex="-1" role="dialog" aria-labelledby="helplineTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="helplineModalLongTitle">Helpline Numbers <?php echo CURRENT_YEAR;?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <!--<p style="margin-bottom:30px">
            <h5><i class="fa fa-phone"></i> College Helpline</h5>
            +91 33 2241 8887, +91 33 2241 8889<br>
            <a href="mailto:office@vcfw.org" target="_blank">office@vcfw.org</a>
        </p>
        <hr>-->
        <p>
            <h5><i class="fa fa-headphones"></i> Technical Helpline</h5>
            <strong>Technical Query :</strong> +91 98301 68755 (11 AM. to 4 PM.)<!--<br>
            <i class="fa fa-envelope-o"></i> <a href="mailto:collegeadmissionwb@gmail.com" target="_blank">collegeadmissionwb@gmail.com</a>--><br><br>
            <strong>Payment related issue :</strong><br>
            Call us at : 033 4006 8755 (11 AM. to 4 PM.)<br><br>
            <!--<i class="fa fa-envelope-o"></i> <a href="mailto:payments.collegeadmission@gmail.com" target="_blank">payments.collegeadmission@gmail.com</a>-->
            <strong>Remote Support :</strong><br>
            Before calling us, please download the AnyDesk software by clicking on the Download link provided below.<br>
            <a class="btn btn-danger btn-sm mt-2" href="https://www.collegeadmission.in/AnyDesk.exe" target="_blank"><i class="fa fa-cloud-download"></i> Download</a>
        </p>
        <hr>
        <p>
            <h5><i class="fa fa-headphones"></i> College Helpline</h5>
            Call us at : <!--+91 70036 69465 / -->+91 98305 36921<br>
            <i class="fa fa-envelope-o"></i> <a href="mailto:admissiontogc@gmail.com" target="_blank">admissiontogc@gmail.com</a><br>
            <i class="fa fa-long-arrow-down"></i><br>While sending an e-mail please mention the following details: name, subject, category, student ID, form number, merit rank, contact phone number and the difficulty encountered.
        </p>
        <!--<hr>
        <p>
            <h5><i class="fa fa-whatsapp"></i> Whatsapp Chat</h5>
            <a class="fixedbutton btn btn-danger" href="https://wa.me/919830168755?text=*Vidyasagar College for Women*<?php echo BR;?>Welcome Ankit. Tell me how can I help you." target="_blank">
                Chat Now
            </a>
        </p>-->
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

    <div class="modal fade" id="ValidationAlert" tabindex="-1" role="dialog" aria-labelledby="ValidationAlertTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-danger" id="ShowValidationAlert"><?php echo MODAL_VALIDATION_TEXT;?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-left" id="msgcontent">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
<style>
.lds-roller {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
.lds-roller div {
  animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
  transform-origin: 40px 40px;
}
.lds-roller div:after {
  content: " ";
  display: block;
  position: absolute;
  width: 7px;
  height: 7px;
  border-radius: 50%;
  margin: -4px 0 0 -4px;
}
.lds-roller div:nth-child(1) {
  animation-delay: -0.036s; background:#F00;
}
.lds-roller div:nth-child(1):after {
  top: 63px;
  left: 63px; background: #007bff;
}
.lds-roller div:nth-child(2) {
  animation-delay: -0.072s;
}
.lds-roller div:nth-child(2):after {
  top: 68px;
  left: 56px; background: #6c757d;
}
.lds-roller div:nth-child(3) {
  animation-delay: -0.108s;
}
.lds-roller div:nth-child(3):after {
  top: 71px;
  left: 48px; background: #F36;
}
.lds-roller div:nth-child(4) {
  animation-delay: -0.144s;
}
.lds-roller div:nth-child(4):after {
  top: 72px;
  left: 40px; background: #28a745;
}
.lds-roller div:nth-child(5) {
  animation-delay: -0.18s;
}
.lds-roller div:nth-child(5):after {
  top: 71px;
  left: 32px; background: #dc3545;
}
.lds-roller div:nth-child(6) {
  animation-delay: -0.216s;
}
.lds-roller div:nth-child(6):after {
  top: 68px;
  left: 24px; background: #ffc107;
}
.lds-roller div:nth-child(7) {
  animation-delay: -0.252s;
}
.lds-roller div:nth-child(7):after {
  top: 63px;
  left: 17px; background: #17a2b8;
}
.lds-roller div:nth-child(8) {
  animation-delay: -0.288s;
}
.lds-roller div:nth-child(8):after {
  top: 56px;
  left: 12px; background: #B68F49;
}
@keyframes lds-roller {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>
    <!-- LOADER START-->    
    <div id="dvLoading" style="display:none; position:fixed; top:0; left:0; background:rgba(0,0,0,0.8); width:100%; height:100%; padding:0; margin:0 auto; z-index:9999999999">
        <div class="lds-roller" style="padding:5px; border-radius:5px;height:100px;width:100px; position:absolute; top:50%; left:50%;margin-left:-50px;    margin-top:-50px; display:block;">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="text-white" style="padding:5px; border-radius:5px;height:100px;width:100px; position:absolute; top:50%; left:50%;margin-left:-50px; margin-top:30px; display:block;">Please wait...</div>
    </div>
    <!-- LOADER ENDS-->
    
    <div class="modal fade" id="subjectHelpline" tabindex="-1" role="dialog" aria-labelledby="subjectHelplineTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="subjectHelplineModalLongTitle">Request for Subject Addition</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center">
            <p>
                If you do not find your Subject in the list, please send us the detail in the following email id along with the College Name and your contact details or call us at Technical Helpline number provided below.
            </p>
            <hr>
            <p>
                <h5><i class="fa fa-headphones"></i> Technical Helpline</h5>
                <i class="fa fa-phone"></i> Call us at : <a class="text-dark" href="tel:+913340068755">(033) 4006 8755</a><br>
                <i class="fa fa-envelope-o"></i> <a href="mailto:subjects.collegeadmission@gmail.com" target="_blank">subjects.collegeadmission@gmail.com</a>
            </p>
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    
<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Launch demo modal
</button>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>-->