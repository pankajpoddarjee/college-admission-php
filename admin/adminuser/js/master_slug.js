
            /* Encode string to slug */
            function convertToSlug() {
                var str = $('#title').val();
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
                var title = $('#title').val();
                title = title.toLowerCase();
                $('#tags').tagsinput('add', title);

                // var short_name = $('#short_name').val();
                // short_name = short_name.toLowerCase();
                // $('#tags').tagsinput('add', short_name);

                var country_id = $('#country_id option:selected').text().trim();
                if(country_id && country_id!='Select' && country_id!='select'){
                    country_id = country_id.toLowerCase();
                    $('#tags').tagsinput('add', country_id);
                }

                var state_id = $('#state_id option:selected').text().trim();
                if(state_id && state_id!='Select' && state_id!='select'){
                    state_id = state_id.toLowerCase();
                    $('#tags').tagsinput('add', state_id);
                }

                var city_id = $('#city_id option:selected').text().trim();
                if(city_id && city_id!='Select' && city_id!='select'){
                    city_id = city_id.toLowerCase();
                    $('#tags').tagsinput('add', city_id);
                }

                var district_id = $('#district_id option:selected').text().trim();
                if(district_id && district_id!='Select' && district_id!='select'){
                    district_id = district_id.toLowerCase();
                    $('#tags').tagsinput('add', district_id);
                }

                var course_type_id = $('#course_type_id option:selected').text().trim();
                if(course_type_id && course_type_id!='Select' && course_type_id!='select'){
                    course_type_id = course_type_id.toLowerCase();
                    $('#tags').tagsinput('add', course_type_id);
                }
               
            }
            function tags_with_hyphen(){

                var title = $('#title').val();

                title = title.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                        .toLowerCase();
                title = title.replace(/^\s+|\s+$/gm,'');

                title = title.replace(/\s+/g, '-'); 

                $('#tags').tagsinput('add', title);

                // var short_name = $('#short_name').val();

                // short_name = short_name.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                //         .toLowerCase();
                // short_name = short_name.replace(/^\s+|\s+$/gm,'');

                // short_name = short_name.replace(/\s+/g, '-'); 

                // $('#tags').tagsinput('add', short_name);

                
                // var exam_type_name = $('#exam_type_name option:selected').text().trim();
                // if(exam_type_name && exam_type_name!='Select' && exam_type_name!='select'){
                //     exam_type_name = exam_type_name.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                //     .toLowerCase();
                //     exam_type_name = exam_type_name.replace(/^\s+|\s+$/gm,'');

                //     exam_type_name = exam_type_name.replace(/\s+/g, '-');
                //     $('#tags').tagsinput('add', exam_type_name);
                // }

                // var exam_category_name = $('#exam_category_name option:selected').text().trim();
                // if(exam_category_name && exam_category_name!='Select' && exam_category_name!='select'){
                //     exam_category_name = exam_category_name.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                //     .toLowerCase();
                //     exam_category_name = exam_category_name.replace(/^\s+|\s+$/gm,'');

                //     exam_category_name = exam_category_name.replace(/\s+/g, '-');
                //     $('#tags').tagsinput('add', exam_category_name);
                // }

                var country_id = $('#country_id option:selected').text().trim();
                if(country_id && country_id!='Select' && country_id!='select'){
                    country_id = country_id.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                    .toLowerCase();
                    country_id = country_id.replace(/^\s+|\s+$/gm,'');

                    country_id = country_id.replace(/\s+/g, '-');
                    $('#tags').tagsinput('add', country_id);
                }

                var state_id = $('#state_id option:selected').text().trim();
                if(state_id && state_id!='Select' && state_id!='select'){
                    state_id = state_id.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                    .toLowerCase();
                    state_id = state_id.replace(/^\s+|\s+$/gm,'');

                    state_id = state_id.replace(/\s+/g, '-');
                    $('#tags').tagsinput('add', state_id);
                }

                var city_id = $('#city_id option:selected').text().trim();
                if(city_id && city_id!='Select' && city_id!='select'){
                    city_id = city_id.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                    .toLowerCase();
                    city_id = city_id.replace(/^\s+|\s+$/gm,'');

                    city_id = city_id.replace(/\s+/g, '-');
                    $('#tags').tagsinput('add', city_id);
                }

                var district_id = $('#district_id option:selected').text().trim();
                if(district_id && district_id!='Select' && district_id!='select'){
                    district_id = district_id.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                    .toLowerCase();
                    district_id = district_id.replace(/^\s+|\s+$/gm,'');

                    district_id = district_id.replace(/\s+/g, '-');
                    $('#tags').tagsinput('add', district_id);
                }

                var course_type_id = $('#course_type_id option:selected').text().trim();
                if(course_type_id && course_type_id!='Select' && course_type_id!='select'){
                    course_type_id = course_type_id.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                    .toLowerCase();
                    course_type_id = course_type_id.replace(/^\s+|\s+$/gm,'');

                    course_type_id = course_type_id.replace(/\s+/g, '-');
                    $('#tags').tagsinput('add', course_type_id);
                }


                
            }
            function convertToTags() { 

                tags_with_space();
                tags_with_hyphen();
                var str ='';
                var title = $('#title').val();
                // var short_name = $('#short_name').val();
                // var exam_type_name = $('#exam_type_name option:selected').text().trim();
                // var exam_category_name = $('#exam_category_name option:selected').text().trim();
                var country_id = $('#country_id option:selected').text().trim();
                var state_id = $('#state_id option:selected').text().trim();
                var city_id = $('#city_id option:selected').text().trim();
                var district_id = $('#district_id option:selected').text().trim();
                var course_type_id = $('#course_type_id option:selected').text().trim();
                
                
                if(title){
                    str += title;
                }
                // if(short_name){
                //     str += " "+short_name;
                // }
                // if(exam_type_name && exam_type_name!='Select' && exam_type_name!='select'){
                //     str += " "+exam_type_name;
                // }
                // if(exam_category_name && exam_category_name!='Select' && exam_category_name!='select'){
                //     str += " "+exam_category_name;
                // }
                if(country_id && country_id!='Select' && country_id!='select'){
                    str += " "+country_id;
                }
                if(state_id && state_id!='Select' && state_id!='select'){
                    str += " "+state_id;
                }
                if(city_id && city_id!='Select' && city_id!='select'){
                    str += " "+city_id;
                }
                if(district_id && district_id!='Select' && district_id!='select'){
                    str += " "+district_id;
                }
                if(course_type_id && course_type_id!='Select' && course_type_id!='select'){
                    str += " "+course_type_id;
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

            $('body').on('click', '#save-slug-button', function (event) {
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
                    url: "Save_master_slug.php",
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
                if ($.trim($("#response_from").val()) == "") {
                    toastr.error("Select Type");
                    $("#response_from").focus();
                    return false;
                }

                if ($.trim($("#title").val()) == "") {
                    toastr.error("Enter Slug title");
                    $("#title").focus();
                    return false;
                }

                

                // if ($.trim($("#country_id").val()) == "") {
                //     toastr.error("Select Country");
                //     $("#country_id").focus();
                //     return false;
                // }
                // if ($.trim($("#state_id").val()) == "") {
                //     toastr.error("Select State");
                //     $("#state_id").focus();
                //     return false;
                // }
                // if ($.trim($("#city_id").val()) == "") {
                //     toastr.error("Select City");
                //     $("#city_id").focus();
                //     return false;
                // }
                // if ($.trim($("#district_id").val()) == "") {
                //     toastr.error("Select District");
                //     $("#district_id").focus();
                //     return false;
                // }

               

                if ($.trim($("#slug").val()) == "") {
                    toastr.error("Slug is Required");
                    $("#slug").focus();
                    return false;
                }

                
                return true;
            }

            // function saveData() {
            //     //var form1 = $('#frm1');
            //     var formData = new FormData(document.getElementById("frm1"));
            //     $('#dvLoading').show();
            //     $.ajax({
            //         type: "post",
            //         async: false,
            //         contentType: false, 
            //         url: "Save_master_slug.php",
            //         data: formData,
            //         dataType: "json",
            //         success: function(data) {
            //             // alert(JSON.stringify(data))
            //             if (data.status == 1) {
            //                 alert(data.msg);
            //                 resetdata();
            //                 $('#dvLoading').hide();
            //                 toastr.success(data.msg);
            //                 location.reload();
            //             } else {
            //                 $('#dvLoading').hide();
            //                 toastr.error(data.msg);
            //                 //alert(data.msg);
            //                 return false;
            //             }
            //         }
            //     });
            // }
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
            
            $('#title').on('keypress', function(event) {
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
                    url: "Save_master_slug.php?eid=" + eid,
                    dataType: "json",
                    success: function(data) {
                        if (data.status == 1) {
                          
                           
                            console.log(data.record);
                            $('#title').val(data.record.title);
                            $('#response_from').val(data.record.response_from);
                            //$('#course_type_id').val(data.record.course_type_id);
                            //$('#stream_id').val(data.record.stream_id);
                            if(data.record.university_id !=0){
                                $('#university_id').val(data.record.university_id);
                                $('#university_id').select2({tags: true}).val(data.record.university_id);
                            }else{
                                $('#university_id').val("");
                                $('#university_id').select2({tags: true}).val("");
                            }
                            if(data.record.course_type_id !=0){
                                $('#course_type_id').val(data.record.course_type_id);
                            }else{
                                $('#course_type_id').val("");
                            }
                            // if(data.record.stream_id !=0){
                            //     $('#stream_id').val(data.record.stream_id);
                            // }else{
                            //     $('#stream_id').val("");
                            // }
                            $('#stream_id').val(data.record.stream_id);
                            $('#stream_id').select2({
                                placeholder: "Select Stream",
                                allowClear: true
                            }).val(data.record.stream_id)
                            $('#stream_id').val(data.record.stream_id.split(',')).trigger('change');
                            if(data.record.college_type_id !=0){
                                $('#college_type_id').val(data.record.college_type_id);
                            }else{
                                $('#college_type_id').val("");
                            }
                            if(data.record.undertaking_id !=0){
                                $('#undertaking_id').val(data.record.undertaking_id);
                            }else{
                                $('#undertaking_id').val("");
                            }

                            if(data.record.exam_level_id !=0){
                                $('#exam_level_id').val(data.record.exam_level_id);
                            }else{
                                $('#exam_level_id').val("");
                            }

                            if(data.record.exam_type_id !=0){
                                $('#exam_type_id').val(data.record.exam_type_id);
                            }else{
                                $('#exam_type_id').val("");
                            }

                            if(data.record.exam_category_id !=0){
                                $('#exam_category_id').val(data.record.exam_category_id);
                            }else{
                                $('#exam_category_id').val("");
                            }

                            getCity(data.record.state_id);
                            getDistrict(data.record.state_id);

                            if(data.record.city_id !=0){
                                $('#city_id').val(data.record.city_id);
                                $('#city_id').select2({tags: true}).val(data.record.city_id);
                            }else{
                                $('#city_id').val("");
                                $('#city_id').select2({tags: true}).val("");
                            }

                            if(data.record.district_id !=0){
                                $('#district_id').val(data.record.district_id);
                                $('#district_id').select2({tags: true}).val(data.record.district_id);
                            }else{
                                $('#district_id').val(""); 
                                $('#district_id').select2({tags: true}).val("");
                            }
                            getState(data.record.country_id);

                            if(data.record.state_id !=0){
                                $('#state_id').val(data.record.state_id);
                                $('#state_id').select2({tags: true}).val(data.record.state_id);
                            }else{
                                $('#state_id').val("");
                                $('#state_id').select2({tags: true}).val("");
                            }

                            if(data.record.country_id !=0){
                                $('#country_id').val(data.record.country_id);
                                $('#country_id').select2({tags: true}).val(data.record.country_id);
                            }else{
                                $('#country_id').val("");
                                $('#country_id').select2({tags: true}).val("");
                            }
                            $('#tags').tagsinput('destroy'); // Destroy the tagsinput
                            $('#tags').val(data.record.tags); // Clear the value
                            $('#tags').tagsinput('add', data.record.tags)

                            $('#slug').val(data.record.slug);

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
                
              
                $("#title").val("");
                $("#response_from").val(""); 
                $("#course_type_id").val("");
                //$("#stream_id").val("");
                $("#stream_id").val("");
                $('#stream_id').select2({
                    placeholder: "Select Stream",
                    allowClear: true
                }).val("");
                $("#college_type_id").val("");
                $("#undertaking_id").val("");
                $("#university_id").val("");                
                $('#university_id').select2({
                    tags: true
                  }).val("");
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
                $("#course_type_id").val("");
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
			
						
			

            // $("#course_type_id").multiselect(
            //     {
            //         reload : true,
            //         columns: 1,
            //         texts: {
            //             placeholder: 'Select Course',
            //             search     : 'Type here to search'
            //         },
            //         search: true,
            //         selectAll: true
            //     }
            // );
            // $("#stream_id").multiselect(
            //     {
            //         reload : true,
            //         columns: 1,
            //         texts: {
            //             placeholder: 'Select Stream',
            //             search     : 'Type here to search'
            //         },
            //         search: true,
            //         selectAll: true
            //     }
            // );

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

            $(document).ready(function() {
                $('#tags').tagsinput({
                    maxTags: 10,
                    placeholder: 'Add a tag'
                });
            
                // Adding a tag programmatically
                // $('#tags-input').tagsinput('add', 'Example Tag');
            });