
            // function submitdata() {
            //     event.preventDefault();
            //     if (!verifyInput()) return false;
            //     saveData();
            // }

            $('body').on('click', '#save-college-button', function (event) {
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
                    url: "Save_college.php",
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
                if ($.trim($("#college_name").val()) == "") {
                    toastr.error("Enter College Name");
                    $("#college_name").focus();
                    return false;
                }

                if ($.trim($("#university_id").val()) == "") {
                    toastr.error("Select University");
                    $("#university_id").focus();
                    return false;
                }

                if ($.trim($("#address").val()) == "") {
                    toastr.error("Enter Address");
                    $("#address").focus();
                    return false;
                }

                if ($.trim($("#country_id").val()) == "") {
                    toastr.error("Select Country");
                    $("#country_id").focus();
                    return false;
                }
                if ($.trim($("#state_id").val()) == "") {
                    toastr.error("Select State");
                    $("#state_id").focus();
                    return false;
                }
                if ($.trim($("#city_id").val()) == "") {
                    toastr.error("Select City");
                    $("#city_id").focus();
                    return false;
                }
                if ($.trim($("#district_id").val()) == "") {
                    toastr.error("Select District");
                    $("#district_id").focus();
                    return false;
                }

                if ($.trim($("#email").val()) == "") {
                    toastr.error("Enter Email ID 1");
                    $("#email").focus();
                    return false;
                }

                if ($.trim($("#folder_name").val()) == "") {
                    toastr.error("Enter Folder Name");
                    $("#folder_name").focus();
                    return false;
                }

                if ($.trim($("#file_name").val()) == "") {
                    toastr.error("Enter File Name");
                    $("#email").focus();
                    return false;
                }
                return true;
            }

            function saveData() {
                //var form1 = $('#frm1');
                var formData = new FormData(document.getElementById("frm1"));
                $('#dvLoading').show();
                $.ajax({
                    type: "post",
                    async: false,
                    contentType: false, 
                    url: "Save_college.php",
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
            }
            //DEACTIVE JOURNAL
            $(".status-change").click(function() {
                $('#dvLoading').show();
                var rid = $(this).attr("rid");
                var status = $(this).attr("status");
                $.ajax({
                    type: "get",
                    async: false,
                    url: "Save_college.php?statusid=" + rid + "&status=" + status,
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
            
            $('#college_name').on('keypress', function(event) {
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
                    url: "Save_college.php?eid=" + eid,
                    dataType: "json",
                    success: function(data) {
                        if (data.status == 1) {
                           // $('#dvLoading').hide();
                           // $('#banner_img').val(data.record.banner_img);
                           // $('#logo_img').val(data.record.logo_img);
                           var base_url = $('#base_url').val();
                            if(data.record.banner_img){
                                $("#banner_img_path").show();
                                $("#banner_img_path").attr("src",base_url+'/uploads/college/banner_image/'+data.record.banner_img);
                            }else{
                                $("#banner_img_path").hide();  
                            }
                            if(data.record.logo_img){
                                $("#logo_img_path").show();
                                $("#logo_img_path").attr("src",base_url+'/uploads/college/logo_image/'+data.record.logo_img);
                            }else{
                                $("#logo_img_path").hide();  
                            }
                           
                            
                            $('#college_name').val(data.record.college_name);
                            $('#short_name').val(data.record.short_name);
                            $('#college_code').val(data.record.college_code);
                            $('#other_name').val(data.record.other_name);
                            $('#eshtablish').val(data.record.eshtablish);
                            $('#college_type_id').val(data.record.college_type_id);
                            $('#undertaking_id').val(data.record.undertaking_id);
                            $('#university_id').val(data.record.university_id);
                            $('#university_id').select2({tags: true}).val(data.record.university_id)
                            $('#accreditation').val(data.record.accreditation);
                            $('#address').val(data.record.address);
                            $('#landmark').val(data.record.landmark);

                            getCity(data.record.state_id);
                            getDistrict(data.record.state_id);
                            $('#city_id').val(data.record.city_id);
                            $('#city_id').select2({tags: true}).val(data.record.city_id)
                            $('#district_id').val(data.record.district_id);
                            $('#district_id').select2({tags: true}).val(data.record.district_id)

                            getState(data.record.country_id)

                            $('#state_id').val(data.record.state_id);
                            $('#state_id').select2({tags: true}).val(data.record.state_id)
                            $('#country_id').val(data.record.country_id);
                            $('#country_id').select2({tags: true}).val(data.record.country_id)
                            $('#email').val(data.record.email);
                            $('#email2').val(data.record.email2);
                            $('#phone').val(data.record.phone);
                            $('#website_url').val(data.record.website_url);
                            $('#website_display').val(data.record.website_display);

                            var str_course_type =  data.record.course_type_id;
                            var course_type_arr = str_course_type.split(',');

                            $('#course_type_id').val(course_type_arr);
                            $("#course_type_id").multiselect('reload');

                            var str_course =  data.record.stream_id;
                            var course_arr = str_course.split(',');


                            $('#stream_id').val(course_arr);
                            $("#stream_id").multiselect('reload');
							
							$('#folder_name').val(data.record.folder_name);
							$('#file_name').val(data.record.file_name);

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
                
                $("#banner_img").val("");
                $("#banner_img_path").css("display","none");
                $("#logo_img").val("");
                $("#logo_img_path").css("display","none");
                $("#college_name").val("");
                $("#short_name").val("");
                $("#college_code").val("");
                $("#other_name").val("");
                $("#eshtablish").val("");
                $("#college_type_id").val("");
                $("#undertaking_id").val("");
                $("#university_id").val("");
                $('#university_id').select2({
                    tags: true
                  }).val("");
                $("#accreditation").val("");
                $("#address").val("");
                $("#landmark").val("");
                $("#country_id").val("");
                $('#country_id').select2({
                    tags: true
                  }).val("");
                $("#state_id").val("");
                $("#state_id").html('<option value="""> Select </option>');
                $('#state_id').select2({
                    tags: true
                  }).val("");
                $("#city_id").val("");
                $("#city_id").html('<option value="""> Select </option>');
                $('#city_id').select2({
                    tags: true
                  }).val("");
                $("#district_id").val("");
                $("#district_id").html('<option value="""> Select </option>');
                $('#district_id').select2({
                    tags: true
                  }).val("");
                $("#email").val("");
                $("#email2").val("");
                $("#phone").val("");
                $("#website_url").val("");
                $("#website_display").val("");
                $("#course_type_id").val("");
                $("#stream_id").val("");
				$("#folder_name").val("");
				$("#file_name").val("");
                
                $("#course_type_id").multiselect('reset');
                $("#stream_id").multiselect('reset');
                
            }

            function openModalForm() {
                resetdata();
                $("#action").val("add");
                $('#record_id').val("");
                $("#add_edit_form").modal();
            }


            function getState(country_id) {
                $('#dvLoading').show();	
				$.ajax({
                    type: "get",
                    async: false,
                    url: "get_location.php?getState=" + country_id,
                    dataType: "json",
                    success: function(data) {
                        $('#dvLoading').hide();	
                        if (data.status == 1) {
                            $('#state_id').html("");
                                var html = '';
                                if (data.record.length > 0) {
                                    html += '<option value="">Select</option>';
                                    for (let i = 0; i < data.record.length; i++) {
                                        html += '<option value="' + data.record[i].id + '">' + data.record[i].state_name + '</option>';
                                    }

                                    $('#state_id').html(html);
                                }
                                else {
                                    html += '<option value="">Select</option>';
                                    $('#state_id').html(html);

                                }
                        } else {
                            alert(data.msg);
                            return false;
                        }
                    }
                });
            }

            function getCity(state_id) {
                $('#dvLoading').show();	
				$.ajax({
                    type: "get",
                    async: false,
                    url: "get_location.php?getCity=" + state_id,
                    dataType: "json",
                    success: function(data) {
                        $('#dvLoading').hide();	
                        if (data.status == 1) {
                            $('#city_id').html("");
                                var html = '';
                                if (data.record.length > 0) {
                                    html += '<option value="">Select</option>';
                                    for (let i = 0; i < data.record.length; i++) {
                                        html += '<option value="' + data.record[i].id + '">' + data.record[i].city_name + '</option>';
                                    }

                                    $('#city_id').html(html);
                                }
                                else {
                                    html += '<option value="">Select</option>';
                                    $('#city_id').html(html);

                                }
                        } else {
                            alert(data.msg);
                            return false;
                        }
                    }
                });
            }
            
            function getDistrict(state_id) {
                $('#dvLoading').show();	
				$.ajax({
                    type: "get",
                    async: false,
                    url: "get_location.php?getDistrict=" + state_id,
                    dataType: "json",
                    success: function(data) {
                        $('#dvLoading').hide();	
                        if (data.status == 1) {
                            $('#district_id').html("");
                                var html = '';
                                if (data.record.length > 0) {
                                    html += '<option value="">Select </option>';
                                    for (let i = 0; i < data.record.length; i++) {
                                        html += '<option value="' + data.record[i].id + '">' + data.record[i].district_name + '</option>';
                                    }

                                    $('#district_id').html(html);
                                }
                                else {
                                    html += '<option value="">Select</option>';
                                    $('#district_id').html(html);

                                }
                        } else {
                            alert(data.msg);
                            return false;
                        }
                    }
                });
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
			
			function populateFolderName() 
			{
				var input_folderName = document.getElementsByName('folder_name')[0].value;
				var input_fileName = document.getElementsByName('file_name')[0];
				var var_fileName = concatenate(input_folderName, '.php');
				input_fileName.value = var_fileName;
			}			
			

            $("#course_type_id").multiselect(
                {
                    reload : true,
                    columns: 1,
                    texts: {
                        placeholder: 'Select Course',
                        search     : 'Type here to search'
                    },
                    search: true,
                    selectAll: true
                }
            );
            $("#stream_id").multiselect(
                {
                    reload : true,
                    columns: 1,
                    texts: {
                        placeholder: 'Select Stream',
                        search     : 'Type here to search'
                    },
                    search: true,
                    selectAll: true
                }
            );

            // $(document).ready(function() {
            //     $('.select-2-dropdown').select2({
            //         tags: true
            //       });
            // });

            //Add New University
            $(document).ready(function(){

                $('#university_id').select2({
                  placeholder:'Select University',
                  theme:'bootstrap4',
                  tags:true,
                }).on('select2:close', function(){
                  var element = $(this);
                  var new_university = $.trim(element.val());
              

              
                  if(new_university != '' && typeof new_university === 'string')
                  {
                    $.ajax({
                      type: "get",
                      async: false,
                      url: "get_location.php?newUniversity=" + new_university,
                      dataType: "json",
                      success:function(data)
                      {
                        if(data.status == 1)
                        {
                          element.append('<option value="'+data.insert_id+'">'+new_university+'</option>').val(data.insert_id);
                        }
                      }
                    })
                  }
              
                });
              
              });
            
            //Add New Country
            $(document).ready(function(){
                $('#country_id').select2({
                  placeholder:'Select Country',
                  theme:'bootstrap4',
                  tags:true,
                }).on('select2:close', function(){
                  var element = $(this);
                  var new_country = $.trim(element.val());
                  if(new_country != '' && typeof new_country === 'string')
                  {
                    $.ajax({
                      type: "get",
                      async: false,
                      url: "get_location.php?addCountry=" + new_country,
                      dataType: "json",
                      success:function(data)
                      {
                        if(data.status == 1)
                        {
                          element.append('<option value="'+data.insert_id+'">'+new_country+'</option>').val(data.insert_id);
                          getState(data.insert_id);
                        }else{
                            getState(new_country);
                        }
                      }
                    })
                  }
              
                });
              
              });

              //Add New State
            $(document).ready(function(){
                $('#state_id').select2({
                  placeholder:'Select Country',
                  theme:'bootstrap4',
                  tags:true,
                }).on('select2:close', function(){
                    var country_id = $('#country_id').val();
                if(country_id=='' || country_id==null || country_id=="undefined"){
                    alert("Please select country");
                    return false;
                }
                  var element = $(this);
                  var new_state = $.trim(element.val());
                  if(new_state != '' && typeof new_state === 'string')
                  {
                    $.ajax({
                      type: "get",
                      async: false,
                      url: "get_location.php?addState=" + new_state + "&country_id=" + country_id,
                      dataType: "json",
                      success:function(data)
                      {
                        if(data.status == 1)
                        {
                          element.append('<option value="'+data.insert_id+'">'+new_state+'</option>').val(data.insert_id);
                          getCity(data.insert_id);
                          getDistrict(data.insert_id);
                        }else{
                            getCity(new_state);
                            getDistrict(new_state);
                        }
                      }
                    })
                  }
              
                });
              
            });

            //Add New City
            $(document).ready(function(){
                $('#city_id').select2({
                  placeholder:'Select Country',
                  theme:'bootstrap4',
                  tags:true,
                }).on('select2:close', function(){
                    var country_id = $('#country_id').val();
                    if(country_id=='' || country_id==null || country_id=="undefined"){
                        alert("Please select country");
                        return false;
                    }
                    var state_id = $('#state_id').val();
                    if(state_id=='' || state_id==null || state_id=="undefined"){
                        alert("Please select state");
                        return false;
                    }
                  var element = $(this);
                  var new_city = $.trim(element.val());
                  if(new_city != '' && typeof new_city === 'string')
                  {
                    $.ajax({
                      type: "get",
                      async: false,
                      url: "get_location.php?addCity=" + new_city + "&country_id=" + country_id+ "&state_id=" + state_id,
                      dataType: "json",
                      success:function(data)
                      {
                        if(data.status == 1)
                        {
                          element.append('<option value="'+data.insert_id+'">'+new_city+'</option>').val(data.insert_id);
                          
                        }
                      }
                    })
                  }
              
                });
              
            });

            //Add New District
            $(document).ready(function(){
                $('#district_id').select2({
                  placeholder:'Select Country',
                  theme:'bootstrap4',
                  tags:true,
                }).on('select2:close', function(){
                    var country_id = $('#country_id').val();
                    if(country_id=='' || country_id==null || country_id=="undefined"){
                        alert("Please select country");
                        return false;
                    }
                    var state_id = $('#state_id').val();
                    if(state_id=='' || state_id==null || state_id=="undefined"){
                        alert("Please select state");
                        return false;
                    }
                  var element = $(this);
                  var new_district = $.trim(element.val());
                  if(new_district != '' && typeof new_district === 'string')
                  {
                    $.ajax({
                      type: "get",
                      async: false,
                      url: "get_location.php?addDistrict=" + new_district + "&country_id=" + country_id+ "&state_id=" + state_id,
                      dataType: "json",
                      success:function(data)
                      {
                        if(data.status == 1)
                        {
                          element.append('<option value="'+data.insert_id+'">'+new_district+'</option>').val(data.insert_id);
                          
                        }
                      }
                    })
                  }
              
                });
              
            });