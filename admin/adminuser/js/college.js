
            /* Encode string to slug */
            function convertToSlug() {
                var str = $('#college_name').val();
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
                var college_name = $('#college_name').val();
                college_name = college_name.toLowerCase();
                $('#tags').tagsinput('add', college_name);

                var other_name = $('#other_name').val();
                other_name = other_name.toLowerCase();
                $('#tags').tagsinput('add', other_name);

                var university_name = $('#university_id option:selected').text().trim();
                if(university_name && university_name!='Select' && university_name!='select'){
                    university_name = university_name.toLowerCase();
                    $('#tags').tagsinput('add', university_name);
                }
                var undertaking_name = $('#undertaking_id option:selected').text().trim();
                if(undertaking_name && undertaking_name!='Select' && undertaking_name!='select'){
                    undertaking_name = undertaking_name.toLowerCase();
                    $('#tags').tagsinput('add', undertaking_name);
                }

                var college_type_name = $('#college_type_id option:selected').text().trim();
                if(college_type_name && college_type_name!='Select' && college_type_name!='select'){
                    college_type_name = college_type_name.toLowerCase();
                    $('#tags').tagsinput('add', college_type_name);
                }

                var country_name = $('#country_id option:selected').text().trim();
                if(country_name && country_name!='Select' && country_name!='select'){
                    country_name = country_name.toLowerCase();
                    $('#tags').tagsinput('add', country_name);
                }

                var state_name = $('#state_id option:selected').text().trim();
                if(state_name && state_name!='Select' && state_name!='select'){
                    state_name = state_name.toLowerCase();
                    $('#tags').tagsinput('add', state_name);
                }

                var city_name = $('#city_id option:selected').text().trim();
                if(city_name && city_name!='Select' && city_name!='select'){
                    city_name = city_name.toLowerCase();
                    $('#tags').tagsinput('add', city_name);
                }

                var district_name = $('#district_id option:selected').text().trim();
                if(district_name && district_name!='Select' && district_name!='select'){
                    district_name = district_name.toLowerCase();
                    $('#tags').tagsinput('add', district_name);
                }
            }
            function tags_with_hyphen(){

                var college_name = $('#college_name').val();

                college_name = college_name.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                        .toLowerCase();
                college_name = college_name.replace(/^\s+|\s+$/gm,'');

                college_name = college_name.replace(/\s+/g, '-'); 

                $('#tags').tagsinput('add', college_name);

                var other_name = $('#other_name').val();

                other_name = other_name.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                        .toLowerCase();
                other_name = other_name.replace(/^\s+|\s+$/gm,'');

                other_name = other_name.replace(/\s+/g, '-'); 

                $('#tags').tagsinput('add', other_name);


                var university_name = $('#university_id option:selected').text().trim();
                if(university_name && university_name!='Select' && university_name!='select'){
                    university_name = university_name.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                        .toLowerCase();
                    university_name = university_name.replace(/^\s+|\s+$/gm,'');

                    university_name = university_name.replace(/\s+/g, '-'); 
                    $('#tags').tagsinput('add', university_name);
                }

                var undertaking_name = $('#undertaking_id option:selected').text().trim();
                if(undertaking_name && undertaking_name!='Select' && undertaking_name!='select'){
                    undertaking_name = undertaking_name.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                        .toLowerCase();
                    undertaking_name = undertaking_name.replace(/^\s+|\s+$/gm,'');

                    undertaking_name = undertaking_name.replace(/\s+/g, '-');
                    $('#tags').tagsinput('add', undertaking_name);
                }

                var college_type_name = $('#college_type_id option:selected').text().trim();
                if(college_type_name && college_type_name!='Select' && college_type_name!='select'){
                    college_type_name = college_type_name.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                        .toLowerCase();
                    college_type_name = college_type_name.replace(/^\s+|\s+$/gm,'');

                    college_type_name = college_type_name.replace(/\s+/g, '-');
                    $('#tags').tagsinput('add', college_type_name);
                }

                var country_name = $('#country_id option:selected').text().trim();
                if(country_name && country_name!='Select' && country_name!='select'){
                    country_name = country_name.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                    .toLowerCase();
                    country_name = country_name.replace(/^\s+|\s+$/gm,'');

                    country_name = country_name.replace(/\s+/g, '-');
                    $('#tags').tagsinput('add', country_name);
                }

                var state_name = $('#state_id option:selected').text().trim();
                if(state_name && state_name!='Select' && state_name!='select'){
                    state_name = state_name.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                    .toLowerCase();
                    state_name = state_name.replace(/^\s+|\s+$/gm,'');

                    state_name = state_name.replace(/\s+/g, '-');
                    $('#tags').tagsinput('add', state_name);
                }

                var city_name = $('#city_id option:selected').text().trim();
                if(city_name && city_name!='Select' && city_name!='select'){
                    city_name = city_name.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                    .toLowerCase();
                    city_name = city_name.replace(/^\s+|\s+$/gm,'');

                    city_name = city_name.replace(/\s+/g, '-');
                    $('#tags').tagsinput('add', city_name);
                }

                var district_name = $('#district_id option:selected').text().trim();
                if(district_name && district_name!='Select' && district_name!='select'){
                    district_name = district_name.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                    .toLowerCase();
                    district_name = district_name.replace(/^\s+|\s+$/gm,'');

                    district_name = district_name.replace(/\s+/g, '-');
                    $('#tags').tagsinput('add', district_name);
                }
            }
            function convertToTags() { 

                tags_with_space();
                tags_with_hyphen();
                var str ='';
                var college_name = $('#college_name').val();
                var short_name = $('#short_name').val();
                var other_name = $('#other_name').val();
                var country_name = $('#country_id option:selected').text().trim();
                var state_name = $('#state_id option:selected').text().trim();
                var city_name = $('#city_id option:selected').text().trim();
                var district_name = $('#district_id option:selected').text().trim();
                var undertaking_name = $('#undertaking_id option:selected').text().trim();
                var college_type_name = $('#college_type_id option:selected').text().trim();
                var university_name = $('#university_id option:selected').text().trim();
                
                if(college_name){
                    str += college_name;
                }
                if(short_name){
                    str += " "+short_name;
                }
                if(other_name){
                    str += " "+other_name;
                }
                if(country_name && country_name!='Select' && country_name!='select'){
                    str += " "+country_name;
                }
                if(state_name && state_name!='Select' && state_name!='select'){
                    str += " "+state_name;
                }
                if(city_name && city_name!='Select' && city_name!='select'){
                    str += " "+city_name;
                }
                if(district_name && district_name!='Select' && district_name!='select'){
                    str += " "+district_name;
                }
                if(undertaking_name && undertaking_name!='Select' && undertaking_name!='select'){
                    str += " "+undertaking_name;
                }
                if(college_type_name && college_type_name!='Select' && college_type_name!='select'){
                    str += " "+college_type_name;
                }
                if(university_name && university_name!='Select' && university_name!='select'){
                    str += " "+university_name;
                }
                //var str = $('#college_name').val();
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

            // function verifyInput() {
            //     if ($.trim($("#college_name").val()) == "") {
            //         toastr.error("Enter College Name");
            //         $("#college_name").focus();
            //         return false;
            //     }

            //     if ($.trim($("#university_id").val()) == "") {
            //         toastr.error("Select University");
            //         $("#university_id").focus();
            //         return false;
            //     }

            //     if ($.trim($("#address").val()) == "") {
            //         toastr.error("Enter Address");
            //         $("#address").focus();
            //         return false;
            //     }

            //     if ($.trim($("#country_id").val()) == "") {
            //         toastr.error("Select Country");
            //         $("#country_id").focus();
            //         return false;
            //     }
            //     if ($.trim($("#state_id").val()) == "") {
            //         toastr.error("Select State");
            //         $("#state_id").focus();
            //         return false;
            //     }
            //     if ($.trim($("#city_id").val()) == "") {
            //         toastr.error("Select City");
            //         $("#city_id").focus();
            //         return false;
            //     }
            //     if ($.trim($("#district_id").val()) == "") {
            //         toastr.error("Select District");
            //         $("#district_id").focus();
            //         return false;
            //     }

            //     // if ($.trim($("#email").val()) == "") {
            //     //     toastr.error("Enter Email ID 1");
            //     //     $("#email").focus();
            //     //     return false;
            //     // }

            //     if ($.trim($("#slug").val()) == "") {
            //         toastr.error("Slug is Required");
            //         $("#slug").focus();
            //         return false;
            //     }

                
            //     return true;
            // }

            function verifyInput() {
                // Validate static fields
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
            
                if ($.trim($("#slug").val()) == "") {
                    toastr.error("Slug is Required");
                    $("#slug").focus();
                    return false;
                }
            
                // Validate dynamic rows
                let isValid = true;
                $("#addressTable tr").each(function (index, row) {
                    // Skip the header row
                    if (index === 0) return;
            
                    const addressType = $(row).find('input[name="additional_address_type[]"]');
                    const address = $(row).find('input[name="additional_address[]"]');
                    const email = $(row).find('input[name="additional_email[]"]');
                    const phone = $(row).find('input[name="additional_phone[]"]');
            
                    // Validate each field in the dynamic row
                    if ($.trim(addressType.val()) === "") {
                        toastr.error("Additional Address Type is required");
                        addressType.focus();
                        isValid = false;
                        return false; // Break the loop
                    }
            
                    if ($.trim(address.val()) === "") {
                        toastr.error("Additional Address is required");
                        address.focus();
                        isValid = false;
                        return false;
                    }
            
                    if ($.trim(email.val()) !== "" && !validateEmail(email.val())) {
                        toastr.error("Enter a valid Email");
                        email.focus();
                        isValid = false;
                        return false;
                    }
            
                    if ($.trim(phone.val()) !== "" && !validatePhone(phone.val())) {
                        toastr.error("Enter a valid Phone Number");
                        phone.focus();
                        isValid = false;
                        return false;
                    }
                });
            
                return isValid;
            }
            
            // Helper function to validate email
            function validateEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }
            
            // Helper function to validate phone number (10 digits)
            function validatePhone(phone) {
                const phoneRegex = /^[0-9]{10}$/;
                return phoneRegex.test(phone);
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
                    $('#addressTable tr:gt(0)').remove();
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
                           //var base_url = $('#base_url').val();
						   var base_url_upload = $('#base_url_upload').val();
                            if(data.record.banner_img){
                                $("#banner_img_path").show();
                                $("#banner_img_path").attr("src",base_url_upload+'/college/banner_image/'+data.record.banner_img);
                            }else{
                                $("#banner_img_path").hide();  
                            }
                            if(data.record.logo_img){
                                $("#logo_img_path").show();
                                $("#logo_img_path").attr("src",base_url_upload+'/college/logo_image/'+data.record.logo_img);
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
                            $('#university_id').select2({
                                placeholder: "Select University",
                                allowClear: true
                            }).val(data.record.university_id)
                            $('#university_id').val(data.record.university_id.split(',')).trigger('change');
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

                            $('#tags').tagsinput('destroy'); // Destroy the tagsinput
                            $('#tags').val(data.record.tags); // Clear the value
                            $('#tags').tagsinput('add', data.record.tags)
                            
                            $('#slug').val(data.record.slug);


                            if(data.additional_contact.length > 0){
                                console.log("data exist");
                                $(".collapse").not(".show").addClass("show");
                                $("#addressTable").children("tr").not(":first").remove();
                                var i = 1;
                                var rows = data.additional_contact;
                                rows.forEach(function (row) {
                                    $("#addressTable").append(
                                        `<tr id="row${i}">
                                            <td><input type="text" class="form-control" placeholder="Address Type" name="additional_address_type[]" value="${row.additional_address_type}" id="additional_address_type${i}"/></td>
                                            <td><input type="text" class="form-control" placeholder="Address" name="additional_address[]" value="${row.additional_address}" id="additional_address${i}"/></td>
                                            <td><input type="text" class="form-control" placeholder="Email ID" name="additional_email[]" value="${row.additional_email}" id="additional_email${i}"/></td>
                                            <td><input type="text" class="form-control" placeholder="Phone Number" name="additional_phone[]" value="${row.additional_phone}" id="additional_phone${i}"/></td>
                                            <td><input type="text" class="form-control" placeholder="Website" name="additional_website[]" value="${row.additional_website}" id="additional_website${i}"/></td>
                                            <td><input type="text" class="form-control" placeholder="Dispaly Website" name="additional_website_display[]" value="${row.additional_website_display}" id="additional_website_display${i}"/></td>
                                            <td><button type="button" name="remove" id="${i}" class="btn btn-danger btn_remove">X</button></td>
                                        </tr>`
                                    );
                                    i++;
                                });
                            }
                            else{
                                $(".collapse").removeClass("show");
                            }




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
                $('#addressTable tr:gt(0)').remove();
                $(".collapse").removeClass("show");
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
                $("#undertaking_id").val("0");
                $("#university_id").val("");
                $('#university_id').select2({
                    placeholder: "Select University",
                    allowClear: true
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
                $("#slug").val("");
                //$("#tags").tagsinput('add',"");

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
            $(document).ready(function () {
                $('#country_id').select2({
                    placeholder: 'Select Country',
                    theme: 'bootstrap4',
                    tags: true,
                }).on('select2:close', function () {
                    $('#dvLoading').show(); // Show loader
                    var element = $(this);
                    var new_country = $.trim(element.val());
            
                    if (new_country !== '' && typeof new_country === 'string') {
                        $.ajax({
                            type: "get",
                            url: "get_location.php?addCountry=" + encodeURIComponent(new_country),
                            dataType: "json",
                            success: function (data) {
                                if (data.status == 1) {
                                    // Add new option only if it doesn't already exist
                                    if (element.find("option[value='" + data.insert_id + "']").length === 0) {
                                        element.append('<option value="' + data.insert_id + '">' + new_country + '</option>').val(data.insert_id);
                                    }
                                    getState(data.insert_id); // Update state list
                                } else {
                                    getState(new_country);
                                }
                            },
                            error: function () {
                                console.error('Error in AJAX request');
                            },
                            complete: function () {
                                $('#dvLoading').hide(); // Always hide the loader
                            }
                        });
                    } else {
                        $('#dvLoading').hide(); // Hide loader if no valid input
                    }
                });
            });
            

              //Add New State
              $(document).ready(function () {
                $('#state_id').select2({
                    placeholder: 'Select State',
                    theme: 'bootstrap4',
                    tags: true,
                }).on('select2:close', function () {
                    var country_id = $('#country_id').val();
            
                    if (country_id == '' || country_id == null || country_id == "undefined") {
                        alert("Please select a country");
                        return false;
                    }
            
                    var element = $(this);
                    var new_state = $.trim(element.val());
            
                    if (new_state !== '' && typeof new_state === 'string') {
                        $.ajax({
                            type: "get",
                            url: "get_location.php?addState=" + encodeURIComponent(new_state) + "&country_id=" + encodeURIComponent(country_id),
                            dataType: "json",
                            beforeSend: function () {
                                // Show the loader before sending the request
                                $('#dvLoading').show();
                            },
                            success: function (data) {
                                if (data.status == 1) {
                                    // Add the new state to the dropdown only if it doesn't exist
                                    if (element.find("option[value='" + data.insert_id + "']").length === 0) {
                                        element.append('<option value="' + data.insert_id + '">' + new_state + '</option>').val(data.insert_id);
                                    }
                                    getCity(data.insert_id); // Update cities
                                    getDistrict(data.insert_id); // Update districts
                                } else {
                                    getCity(new_state);
                                    getDistrict(new_state);
                                }
                            },
                            error: function () {
                                alert("An error occurred while adding the state.");
                            },
                            complete: function () {
                                // Hide the loader after the request completes
                                $('#dvLoading').hide();
                            }
                        });
                    }
                });
            });
            

            //Add New City
            $(document).ready(function () {
                $('#city_id').select2({
                    placeholder: 'Select City',
                    theme: 'bootstrap4',
                    tags: true,
                }).on('select2:close', function () {
                    var country_id = $('#country_id').val();
                    if (country_id == '' || country_id == null || country_id == "undefined") {
                        alert("Please select a country");
                        return false;
                    }
                    
                    var state_id = $('#state_id').val();
                    if (state_id == '' || state_id == null || state_id == "undefined") {
                        alert("Please select a state");
                        return false;
                    }
            
                    var element = $(this);
                    var new_city = $.trim(element.val());
            
                    if (new_city != '' && typeof new_city === 'string') {
                        $.ajax({
                            type: "get",
                            url: "get_location.php?addCity=" + encodeURIComponent(new_city) + "&country_id=" + encodeURIComponent(country_id) + "&state_id=" + encodeURIComponent(state_id),
                            dataType: "json",
                            beforeSend: function () {
                                // Show the loader before the AJAX request starts
                                $('#dvLoading').show();
                            },
                            success: function (data) {
                                if (data.status == 1) {
                                    // Add the new city if not already in the list
                                    if (element.find("option[value='" + data.insert_id + "']").length === 0) {
                                        element.append('<option value="' + data.insert_id + '">' + new_city + '</option>').val(data.insert_id);
                                    }
                                }
                            },
                            error: function () {
                                alert("An error occurred while adding the city.");
                            },
                            complete: function () {
                                // Hide the loader once the request completes (whether success or failure)
                                $('#dvLoading').hide();
                            }
                        });
                    }
                });
            });
            

            //Add New District
            $(document).ready(function () {
                $('#district_id').select2({
                    placeholder: 'Select District',
                    theme: 'bootstrap4',
                    tags: true,
                }).on('select2:close', function () {
                    var country_id = $('#country_id').val();
                    if (country_id == '' || country_id == null || country_id == "undefined") {
                        alert("Please select a country");
                        return false;
                    }
            
                    var state_id = $('#state_id').val();
                    if (state_id == '' || state_id == null || state_id == "undefined") {
                        alert("Please select a state");
                        return false;
                    }
            
                    var element = $(this);
                    var new_district = $.trim(element.val());
            
                    if (new_district != '' && typeof new_district === 'string') {
                        $.ajax({
                            type: "get",
                            url: "get_location.php?addDistrict=" + encodeURIComponent(new_district) + "&country_id=" + encodeURIComponent(country_id) + "&state_id=" + encodeURIComponent(state_id),
                            dataType: "json",
                            beforeSend: function () {
                                // Show the loader before the AJAX request starts
                                $('#dvLoading').show();
                            },
                            success: function (data) {
                                if (data.status == 1) {
                                    // Add the new district if not already in the list
                                    if (element.find("option[value='" + data.insert_id + "']").length === 0) {
                                        element.append('<option value="' + data.insert_id + '">' + new_district + '</option>').val(data.insert_id);
                                    }
                                }
                            },
                            error: function () {
                                alert("An error occurred while adding the district.");
                            },
                            complete: function () {
                                // Hide the loader after the request completes (whether success or failure)
                                $('#dvLoading').hide();
                            }
                        });
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

            function clearTag() { 
                $('#tags').tagsinput('destroy'); // Destroy the tagsinput
                $('#tags').val(''); // Clear the value
                $('#tags').tagsinput('');
            }


            $(document).ready(function () {
                // Initialize counter based on existing rows in edit mode
                //var i = $("#addressTable tr").length; // Counts current rows, including header row
                var i = $("#additional_contact_max_id").val();
                // Add a new row
                $("#addRow").click(function () {
                    $("#addressTable").append(
                        '<tr id="row' +
                            i +
                            '"><td><input required type="text" placeholder="Address Type" class="form-control" name="additional_address_type[]" id="additional_address_type' +
                            i +
                            '"/></td><td><input type="text" class="form-control" placeholder="Address" name="additional_address[]" id="additional_address' +
                            i +
                            '"/></td><td><input type="text" class="form-control" placeholder="Email ID" name="additional_email[]" id="additional_email' +
                            i +
                            '"/></td><td><input type="text" class="form-control" placeholder="Phone Number" name="additional_phone[]" id="additional_phone' +
                            i +
                            '"/></td><td><input type="text" class="form-control" placeholder="Website" name="additional_website[]" id="additional_website' +
                            i +
                            '"/></td><td><input type="text" class="form-control" placeholder="Display Website" name="additional_website_display[]" id="additional_website_display' +
                            i +
                            '"/></td><td><button type="button" name="remove" id="' +
                            i +
                            '" class="btn btn-danger btn_remove">X</button></td></tr>'
                    );
                    i++; // Increment the counter for the next row
                });
            
                // Remove a row
                $(document).on("click", ".btn_remove", function () {
                    var button_id = $(this).attr("id"); // Get the ID of the remove button
                    $("#row" + button_id).remove(); // Remove the corresponding row
                });
            });
            