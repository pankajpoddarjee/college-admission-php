
            // function submitdata() {
            //     event.preventDefault();
            //     if (!verifyInput()) return false;
            //     saveData();
            // }

            $('body').on('click', '#save-course-assign-button', function (event) {
                event.preventDefault();
                if (!verifyInput()) {
                    return false;
                }

                $('#dvLoading').show();

                var formData = new FormData(document.getElementById("frm1"));
                var college_id = $("#college_id").val();
                $('#dvLoading').show();
                $.ajax({
                    type: "post",
                    contentType: false,
                    processData: false,
                    cache: false, 
                    url: "Save_assign_courses.php",
                    data: formData,
                    dataType: "json",
                    success: function(data) {
                        // alert(JSON.stringify(data))
                        if (data.status == 1) {
                            alert(data.msg);

                            var course_complete_status_html = "";
                            var course_complete_status = $('#course_complete_status').val();
                            if(course_complete_status == 1){
                                course_complete_status_html = '<span class="text-success"><i class="fa-regular fa-circle-check"></i> Assigned </span>';
                            }else if(course_complete_status == 2){
                                course_complete_status_html = '<span class="text-danger"><i class="fa-solid fa-triangle-exclamation"></i></i>Pending</span>';
                            }else if(course_complete_status == 3){
                                course_complete_status_html = '<span class="text-warning"><i class="fa-solid fa-triangle-exclamation"></i> Partially Assigned </span>';
                            }
                            
                            $('#td_course_complete_status'+college_id).html(course_complete_status_html);

                            resetdata();
                            $('#dvLoading').hide();
                            toastr.success(data.msg);
                            //location.reload();
                            getCourseDetail(college_id);
                            

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
                // if ($.trim($("#college_name").val()) == "") {
                //     toastr.error("Enter College Name");
                //     $("#college_name").focus();
                //     return false;
                // }

                if ($.trim($("#course_type_id").val()) == "") {
                    toastr.error("Select Course Type");
                    $("#course_type_id").focus();
                    return false;
                }

                if ($.trim($("#subject_id").val()) == "") {
                    toastr.error("Select Subject");
                    $("#subject_id").focus();
                    return false;
                }

                if ($.trim($("#course_complete_status").val()) == "") {
                    toastr.error("Select Complete Status");
                    $("#course_complete_status").focus();
                    return false;
                }

               
                return true;
            }

           
            

            //GET SINGLE RECORD
           // $(".get-record").click(function() {
            // $('body').on('click', '.get-record', function (event) {
            //         event.preventDefault();
            //     $('#dvLoading').show();
            //     var eid = $(this).attr("eid");
              

            //     $.ajax({
            //       url: "Save_assign_courses.php?eid=" + eid,
            //       type: 'GET',
            //       success: function(response) { 
            //           resetdata();
            //           $('#course-edit-table').html(response);
            //           $("#add_edit_form").modal();
            //           $('#dvLoading').hide();
            //       }
            //     });
            // });
            function getCourseDetail(college_id,college_name){
                $("#selected-course_type_name").text("")
                $("#edit-college-name").text(college_name)
                $('#dvLoading').show();
              

                $.ajax({
                  url: "Save_assign_courses.php?getCourseDetail=" + college_id,
                  type: 'GET',
                  success: function(response) { 
                      resetdata();
                      $('#record_id').val("");
                      $("#action").val("add");
                      $("#college_id").val(college_id);
                      $('#course-edit-table').html(response);
                      getTagsOfCollege(college_id)
                      $("#add_edit_form").modal();
                      $('#dvLoading').hide();
                  }
                });
            }

            function getTagsOfCollege(college_id){
                $.ajax({
                  url: "Save_assign_courses.php?getTagsOfCollege=" + college_id,
                  type: 'GET',
                  dataType: "json",
                  success: function(response) { 
                        $('#tags').tagsinput('destroy'); // Destroy the tagsinput
                        $('#tags').val(response.record.tags); // Clear the value
                        $('#tags').tagsinput('add', response.record.tags)
                  }
                });
            }

            function resetdata() {    
                $('#record_id').val("");            
                $("#course_type_id").val("");
                $("#stream_id").val("");
                $("#subject_id").val("");
                $("#course_complete_status").val("");
                $("#action").val("add");
                $("#subject_id").multiselect('reset');
            }

            // function openModalForm() {
            //     resetdata();
            //     $("#action").val("add");
            //     $('#record_id').val("");
            //     $("#add_edit_form").modal();
            // }


            function getStream(course_type_id) {
                var selectedText = $('#course_type_id option:selected').text();
                $('#selected-course_type_name').text('['+selectedText+']');
                $('#dvLoading').show();	
				          $.ajax({
                                type: "get",
                                async: false,
                                url: "Save_assign_courses.php?getStream=" + course_type_id,
                                dataType: "json",
                                success: function(data) {
                                    $('#dvLoading').hide();	
                                    if (data.status == 1) {
                                        $('#stream_id').html("");
                                            var html = '';
                                            if (data.record.length > 0) {
                                                html += '<option value="">Select</option>';
                                                for (let i = 0; i < data.record.length; i++) {
                                                    html += '<option value="' + data.record[i].id + '">' + data.record[i].stream_name + '</option>';
                                                }

                                                $('#stream_id').html(html);
                                            }
                                            else {
                                                html += '<option value="">Select</option>';
                                                $('#stream_id').html(html);

                                            }
                                    } else {
                                        alert(data.msg);
                                        return false;
                                    }
                                }
                            });
            }

            function getSingleCourseDetail(college_course_detail_id){

              $('#dvLoading').show();
              

              $.ajax({
                url: "Save_assign_courses.php?getSingleCourseDetail=" + college_course_detail_id,
                type: 'GET',
                dataType: "json",
                success: function(data) { 
                 
                    $('#record_id').val(data.record.id);
                    $("#action").val("edit");
                    $("#course_type_id").val(data.record.course_type_id);
                    getStream(data.record.course_type_id);
                    $("#stream_id").val(data.record.stream_id);
                    $("#course_complete_status").val(data.record.course_complete_status);
                    var subject_value_string = data.record.subject_id;
                    var subjectArr = subject_value_string.split(',');
                    $("#subject_id").val(subjectArr);
                    $("#subject_id").multiselect('reload');
                    //moveSelectedOptionsToTop();
                    $('#dvLoading').hide();
                }
              });
            }

            function removeSingleCourseDetail(college_course_detail_id){

                if(!confirm('Are you sure ?')){
                    //e.preventDefault();
                    return false;
                }

                $('#dvLoading').show();
                
  
                $.ajax({
                  url: "Save_assign_courses.php?removeSingleCourseDetail=" + college_course_detail_id,
                  type: 'GET',
                  dataType: "json",
                  success: function(data) { 
                       toastr.success(data.msg);
                       getCourseDetail(data.college_id,data.college_name);
                       
                      $('#dvLoading').hide();
                  }
                });
              }
 
            $("#subject_id").multiselect(
                {
                    reload : true,
                    columns: 1,
                    texts: {
                        placeholder: 'Select Subject',
                        search     : 'Type here to search'
                    },
                    search: true,
                    selectAll: true
                }
            );


            function moveSelectedOptionsToTop() { alert("hh");
              let $select = $('#subject_id');
              let $selected = $select.find('class:selected').clone();
              let $unselected = $select.find('class:not(:selected)').clone();
              console.log($selected);
              $select.empty().append($selected).append($unselected);
              $select.multiselect('reload');
          }

          $(document).ready(function() {
            $('#tags').tagsinput({
                maxTags: 10,
                placeholder: 'Add a tag'
            });
        });

        function tags_with_space(){            

            var course_type_name = $('#course_type_id option:selected').text().trim();
            if(course_type_name && course_type_name!='Select' && course_type_name!='select'){
                course_type_name = course_type_name.toLowerCase();
                $('#tags').tagsinput('add', course_type_name);
            }

            var stream_name = $('#stream_id option:selected').text().trim();
            if(stream_name && stream_name!='Select' && stream_name!='select'){
                stream_name = stream_name.toLowerCase();
                $('#tags').tagsinput('add', stream_name);
            }

            // var subject_name = $('#subject_id option:selected').text().trim();
            // if(subject_name && subject_name!='Select Subject' && subject_name!='select subject'){
            //     subject_name = subject_name.toLowerCase();
            //     $('#tags').tagsinput('add', subject_name);
            // }
        }
        function tags_with_hyphen(){           

            var course_type_name = $('#course_type_id option:selected').text().trim();
            if(course_type_name && course_type_name!='Select' && course_type_name!='select'){
                course_type_name = course_type_name.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                .toLowerCase();
                course_type_name = course_type_name.replace(/^\s+|\s+$/gm,'');

                course_type_name = course_type_name.replace(/\s+/g, '-');
                $('#tags').tagsinput('add', course_type_name);
            }

            var stream_name = $('#stream_id option:selected').text().trim();
            if(stream_name && stream_name!='Select' && stream_name!='select'){
                stream_name = stream_name.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                .toLowerCase();
                stream_name = stream_name.replace(/^\s+|\s+$/gm,'');

                stream_name = stream_name.replace(/\s+/g, '-');
                $('#tags').tagsinput('add', stream_name);
            }

            // var subject_name = $('#subject_id option:selected').text().trim();
            // if(subject_name && subject_name!='Select Subject' && subject_name!='select subject'){
            //     subject_name = subject_name.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
            //     .toLowerCase();
            //     subject_name = subject_name.replace(/^\s+|\s+$/gm,'');

            //     subject_name = subject_name.replace(/\s+/g, '-');
            //     $('#tags').tagsinput('add', subject_name);
            // }
        }
        function convertToTags() { 

            tags_with_space();
            tags_with_hyphen();
            var str ='';
           
            
            var course_type_name = $('#course_type_id option:selected').text().trim();
            var stream_name = $('#stream_id option:selected').text().trim();
            var subject_name = $('#subject_id option:selected').text().trim();
            
            
            if(course_type_name && course_type_name!='Select' && course_type_name!='select'){
                str += " "+course_type_name;
            }
            if(stream_name && stream_name!='Select' && stream_name!='select'){
                str += " "+stream_name;
            }
            if(subject_name && subject_name!='Select Subject' && subject_name!='select subject'){
                //var spanText = $('#subject_id').find('#mySpan').text();
                var selectedLabels = $('#subject_id option:selected').map(function() {
                    return $(this).text();
                }).get().join(', ');

                console.log(selectedLabels);
                //console.log(subject_name);
                str += " "+selectedLabels;
            }
           
            //var str = $('#college_name').val();
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

        function clearTag() { 
            $('#tags').tagsinput('destroy'); // Destroy the tagsinput
            $('#tags').val(''); // Clear the value
            $('#tags').tagsinput('');
        }


     
      