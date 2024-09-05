
            /* Encode string to slug */
            function convertToSlug() {
                var str = $('#exam_name').val();
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
                var exam_name = $('#exam_name').val();
                exam_name = exam_name.toLowerCase();
                $('#tags').tagsinput('add', exam_name);

                var short_name = $('#short_name').val();
                short_name = short_name.toLowerCase();
                $('#tags').tagsinput('add', short_name);

               
            }
            function tags_with_hyphen(){

                var exam_name = $('#exam_name').val();

                exam_name = exam_name.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                        .toLowerCase();
                exam_name = exam_name.replace(/^\s+|\s+$/gm,'');

                exam_name = exam_name.replace(/\s+/g, '-'); 

                $('#tags').tagsinput('add', exam_name);

                var short_name = $('#short_name').val();

                short_name = short_name.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                        .toLowerCase();
                short_name = short_name.replace(/^\s+|\s+$/gm,'');

                short_name = short_name.replace(/\s+/g, '-'); 

                $('#tags').tagsinput('add', short_name);


                
            }
            function convertToTags() { 

                tags_with_space();
                tags_with_hyphen();
                var str ='';
                var exam_name = $('#exam_name').val();
                var short_name = $('#short_name').val();
                
                if(exam_name){
                    str += exam_name;
                }
                if(short_name){
                    str += " "+short_name;
                }
                //var str = $('#exam_name').val();
                //replace all special characters | symbols with a space
                str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                        .toLowerCase();
                
                // trim spaces at start and end of string
                str = str.replace(/^\s+|\s+$/gm,'');
                
                // replace space with dash/hyphen
                str = str.replace(/\s+/g, ',');   

                str = str.replace(/'/g, '');  
                //document.getElementById("slug-text").innerHTML = str;
                //return str;

                $('#tags').tagsinput('add', str);
            }

            $('body').on('click', '#save-exam-button', function (event) {
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
                    url: "Save_exam.php",
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
                if ($.trim($("#exam_name").val()) == "") {
                    toastr.error("Enter Exam Name");
                    $("#exam_name").focus();
                    return false;
                }
                if ($.trim($("#slug").val()) == "") {
                    toastr.error("Slug is Required");
                    $("#slug").focus();
                    return false;
                }
                return true;
            }

            
            //DEACTIVE JOURNAL
            $(".status-change").click(function() {
                $('#dvLoading').show();
                var rid = $(this).attr("rid");
                var status = $(this).attr("status");
                $.ajax({
                    type: "get",
                    async: false,
                    url: "Save_exam.php?statusid=" + rid + "&status=" + status,
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
            
            $('#exam_name').on('keypress', function(event) {
                var regex = new RegExp("^[a-zA-Z ]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
               
                if (!regex.test(key)) {
                    event.preventDefault();
                    return false;
                }
            });


            //GET SINGLE RECORD
            $(".get-record").click(function() {
                $('#dvLoading').show();
                var eid = $(this).attr("eid");
                $.ajax({
                    type: "get",
                    async: false,
                    url: "Save_exam.php?eid=" + eid,
                    dataType: "json",
                    success: function(data) {
                        if (data.status == 1) {

                            var base_url_upload = $('#base_url_upload').val();
                            if(data.record.banner_img){
                                $("#banner_img_path").show();
                                $("#banner_img_path").attr("src",base_url_upload+'/exam/banner_image/'+data.record.banner_img);
                            }else{
                                $("#banner_img_path").hide();  
                            }
                            if(data.record.logo_img){
                                $("#logo_img_path").show();
                                $("#logo_img_path").attr("src",base_url_upload+'/exam/logo_image/'+data.record.logo_img);
                            }else{
                                $("#logo_img_path").hide();  
                            }
                            $('#exam_name').val(data.record.exam_name);
                            $('#short_name').val(data.record.short_name);
                            $('#slug').val(data.record.slug);
                            $('#record_id').val(data.record.id);
                            $('#tags').tagsinput('destroy'); // Destroy the tagsinput
                            $('#tags').val(data.record.tags); // Clear the value
                            $('#tags').tagsinput('add', data.record.tags)
                            
                            $('#action').val("edit");
                            $("#add_edit_form").modal();
                            $('#dvLoading').hide();
                        } else {
                            alert(data.msg);
                            return false;
                        }
                    }
                });
            });

            function resetdata() {
                $("#exam_name").val("");
                $("#banner_img").val("");
                $("#banner_img_path").css("display","none");
                $("#logo_img").val("");
                $("#logo_img_path").css("display","none");
                $("#short_name").val("");
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

            function clearTag() { 
                $('#tags').tagsinput('destroy'); // Destroy the tagsinput
                $('#tags').val(''); // Clear the value
                $('#tags').tagsinput('');
            }
