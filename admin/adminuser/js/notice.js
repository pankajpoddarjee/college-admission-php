
            /* Encode string to slug */
            function convertToSlug() {
                var str = $('#notice_title').val();
                //replace all special characters | symbols with a space
                str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                        .toLowerCase();
                
                // trim spaces at start and end of string
                str = str.replace(/^\s+|\s+$/gm,'');
                
                // replace space with dash/hyphen
                str = str.replace(/\s+/g, '-');   
                //document.getElementById("slug-text").innerHTML = str;
                //return str;

                $('#slug').val(str);
            }
            function tags_with_space(){
                var notice_title = $('#notice_title').val();
                notice_title = notice_title.toLowerCase();
                $('#tags').tagsinput('add', notice_title);

                var college_name = $('#college_id option:selected').text().trim();
                if(college_name && college_name!='Select' && college_name!='select'){
                    college_name = college_name.toLowerCase();
                    $('#tags').tagsinput('add', college_name);
                }

                var university_name = $('#university_id option:selected').text().trim();
                if(university_name && university_name!='Select' && university_name!='select'){
                    university_name = university_name.toLowerCase();
                    $('#tags').tagsinput('add', university_name);
                }

                var exam_name = $('#exam_id option:selected').text().trim();
                if(exam_name && exam_name!='Select' && exam_name!='select'){
                    exam_name = exam_name.toLowerCase();
                    $('#tags').tagsinput('add', exam_name);
                }
               
            }
            function tags_with_hyphen(){

                var notice_title = $('#notice_title').val();

                notice_title = notice_title.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                        .toLowerCase();
                notice_title = notice_title.replace(/^\s+|\s+$/gm,'');

                notice_title = notice_title.replace(/\s+/g, '-'); 

                $('#tags').tagsinput('add', notice_title);

               

                var college_name = $('#college_id option:selected').text().trim();
                if(college_name && college_name!='Select' && college_name!='select'){
                    college_name = college_name.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                        .toLowerCase();
                    college_name = college_name.replace(/^\s+|\s+$/gm,'');

                    college_name = college_name.replace(/\s+/g, '-'); 
                    $('#tags').tagsinput('add', college_name);
                }

                var university_name = $('#university_id option:selected').text().trim();
                if(university_name && university_name!='Select' && university_name!='select'){
                    university_name = university_name.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                        .toLowerCase();
                    university_name = university_name.replace(/^\s+|\s+$/gm,'');

                    university_name = university_name.replace(/\s+/g, '-'); 
                    $('#tags').tagsinput('add', university_name);
                }

                var exam_name = $('#exam_id option:selected').text().trim();
                if(exam_name && exam_name!='Select' && exam_name!='select'){
                    exam_name = exam_name.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                        .toLowerCase();
                    exam_name = exam_name.replace(/^\s+|\s+$/gm,'');

                    exam_name = exam_name.replace(/\s+/g, '-'); 
                    $('#tags').tagsinput('add', exam_name);
                }

               
              
            }
            function convertToTags() { 

                tags_with_space();
                tags_with_hyphen();
                var str ='';
                var notice_title = $('#notice_title').val();
                var college_name = $('#college_id option:selected').text().trim();
                var university_name = $('#university_id option:selected').text().trim();
                var exam_name = $('#exam_id option:selected').text().trim();
                
                if(notice_title){
                    str += notice_title;
                }
                if(college_name && college_name!='Select' && college_name!='select'){
                    str += " "+college_name;
                }
                if(university_name && university_name!='Select' && university_name!='select'){
                    str += " "+university_name;
                }
                if(exam_name && exam_name!='Select' && exam_name!='select'){
                    str += " "+exam_name;
                }
                //var str = $('#notice_title').val();
                //replace all special characters | symbols with a space
                str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                        .toLowerCase();
                
                // trim spaces at start and end of string
                str = str.replace(/^\s+|\s+$/gm,'');
                
                // replace space with dash/hyphen
                str = str.replace(/\s+/g, ',');   
                //document.getElementById("slug-text").innerHTML = str;
                //return str;

                $('#tags').tagsinput('add', str);
            }

            $('body').on('click', '#save-notice-button', function (event) {
                event.preventDefault();
                if (!verifyInput()) {
                    return false;
                }

                $('#dvLoading').show();

                var formData = new FormData(document.getElementById("frm1"));
                $('#dvLoading').show();
                $.ajax({
                    type: "post",
                    contentType: false,
                    processData: false,
                    cache: false, 
                    url: "Save_notice.php",
                    data: formData,
                    dataType: "json",
                    success: function(data) {
                        // alert(JSON.stringify(data))
                        if (data.status == 1) {
                            alert(data.msg);
                            resetdata();
                            $('#dvLoading').hide();
                            toastr.success(data.msg);
                            location.reload();
                        } else {
                            $('#dvLoading').hide();
                            toastr.error(data.msg);
                            //alert(data.msg);
                            return false;
                        }
                    }
                });
            });

            function verifyInput() {
                if ($.trim($("#notice_title").val()) == "") {
                    toastr.error("Enter Notice Title");
                    $("#notice_title").focus();
                    return false;
                }                

                if ($.trim($("#notice_for").val()) == "") {
                    toastr.error("Enter Notice For");
                    $("#notice_for").focus();
                    return false;
                }
                
                if ($.trim($("#notice_for").val()) == 1) {
                    if ($.trim($("#college_id").val()) == "") {
                        toastr.error("Select College");
                        $("#college_id").focus();
                        return false;
                    }
                }
                if ($.trim($("#notice_for").val()) == 2) {
                    if ($.trim($("#university_id").val()) == "") {
                        toastr.error("Select University");
                        $("#university_id").focus();
                        return false;
                    }
                }
                if ($.trim($("#notice_for").val()) == 3) {
                    if ($.trim($("#exam_id").val()) == "") {
                        toastr.error("Select Exam");
                        $("#exam_id").focus();
                        return false;
                    }
                }

                if ($.trim($("#notice_date").val()) == "") {
                    toastr.error("Notice Date is Required");
                    $("#notice_date").focus();
                    return false;
                }

                if ($.trim($("#slug").val()) == "") {
                    toastr.error("Slug is Required");
                    $("#slug").focus();
                    return false;
                }

                
                return true;
            }

            
            //DEACTIVE Notice
            $(".status-change").click(function() {
                $('#dvLoading').show();
                var rid = $(this).attr("rid");
                var status = $(this).attr("status");
                $.ajax({
                    type: "get",
                    async: false,
                    url: "Save_notice.php?statusid=" + rid + "&status=" + status,
                    dataType: "json",
                    success: function(data) {
                        if (data.status == 1) {
                            alert(data.msg);
                            toastr.success(data.msg);
                            location.reload();
                        } else {
                            alert(data.msg);
                            return false;
                        }
                    }
                });
            });
            
            $('#notice_title').on('keypress', function(event) {
                var regex = new RegExp("^[a-zA-Z () .]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
               
                if (!regex.test(key)) {
                    event.preventDefault();
                    return false;
                }
            });


            //GET SINGLE RECORD
           // $(".get-record").click(function() {
            $('body').on('click', '.get-record', function (event) {
                    event.preventDefault();
                $('#dvLoading').show();
                var eid = $(this).attr("eid");
                $.ajax({
                    type: "get",
                   // async: false,
                    url: "Save_notice.php?eid=" + eid,
                    dataType: "json",
                    success: function(data) {
                        if (data.status == 1) {
                          
                            $('#notice_title').val(data.record.notice_title);
                            $('#notice_for').val(data.record.notice_for);
                            $('#notice_date').val(data.record.notice_date);

                            $('#college_id').val(data.record.college_id);
                            $('#college_id').select2({tags: true}).val(data.record.college_id)

                            $('#university_id').val(data.record.university_id);
                            $('#university_id').select2({tags: true}).val(data.record.university_id)

                            $('#exam_id').val(data.record.exam_id);
                            $('#exam_id').select2({tags: true}).val(data.record.exam_id)
                           

                            

                            $('#tags').tagsinput('destroy'); // Destroy the tagsinput
                            $('#tags').val(data.record.tags); // Clear the value
                            $('#tags').tagsinput('add', data.record.tags)
                            
                            $('#slug').val(data.record.slug);
                            $('#is_new').val(data.record.is_new);
                            $('#description').val(data.record.description);

                            $('#record_id').val(data.record.id);
                            $('#action').val("edit");
                            $('#dvLoading').hide();
                            $("#add_edit_form").modal();

                            
                        } else {
                            alert(data.msg);
                            return false;
                        }
                    }
                });
            });

            function resetdata() {
                
                $("#notice_title").val("");
                $("#notice_for").val("");
                $("#notice_date").val("");

                $("#is_new").val("1");
                $("#description").val("");

                $("#exam_id").val("");
                $('#exam_id').select2({
                    tags: true
                  }).val("");
                
                $("#college_id").val("");
                $('#college_id').select2({
                    tags: true
                  }).val("");
                $("#university_id").val("");
                $('#university_id').select2({
                    tags: true
                  }).val("");
               
                $("#slug").val("");
                $('#tags').tagsinput('destroy'); // Destroy the tagsinput
                $('#tags').val(''); // Clear the value
                $('#tags').tagsinput();
				
                
            }

            function openModalForm() {
                resetdata();
                $("#action").val("add");
                $('#record_id').val("");
                $("#add_edit_form").modal();
            }


            
			function concatenate(string_one, string_two, with_space) 
			{
				if (with_space===true) 
				{
				 return string_one+string_two;
				}
				else 
				{
				 return string_one+string_two;
				}
			}
			

            $(document).ready(function() {
                $('#tags').tagsinput({
                    maxTags: 10,
                    placeholder: 'Add a tag'
                });
            });

            function clearTag() { 
                $('#tags').tagsinput('destroy'); // Destroy the tagsinput
                $('#tags').val(''); // Clear the value
                $('#tags').tagsinput('');
            }

            function showHideInput(){
                var id =  $('#notice_for').val();
                $('#university_id').val('');
                $('#college_id').val('');
                $('#exam_id').val('');
                if(id==1){
                    
                    $('#exam_id_div').hide();
                    $('#university_id_div').hide();

                    $("#college_id").val("");
                    $('#college_id').select2({
                        tags: true
                    }).val("");
                    $('#college_id_div').show();
                }
                if(id==2){
                    $('#exam_id_div').hide();
                    $('#university_id_div').show();
                    $('#college_id_div').hide();
                }
                if(id==3){
                    $('#exam_id_div').show();
                    $('#university_id_div').hide();
                    $('#college_id_div').hide();
                }
            }