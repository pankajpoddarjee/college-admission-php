/* Encode string to slug */
function convertToSlug() {
    var str = $('#notice_title').val();
    //replace all special characters | symbols with a space
    str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
        .toLowerCase();

    // trim spaces at start and end of string
    str = str.replace(/^\s+|\s+$/gm, '');

    // replace space with dash/hyphen
    str = str.replace(/\s+/g, '-');
    //document.getElementById("slug-text").innerHTML = str;
    //return str;

    $('#slug').val(str);
}

function tags_with_space() {
    var notice_title = $('#notice_title').val();
    notice_title = notice_title.toLowerCase();
    $('#tags').tagsinput('add', notice_title);



    var university_name = $('#university_id option:selected').text().trim();
    if (university_name && university_name != 'Select' && university_name != 'select') {
        university_name = university_name.toLowerCase();
        $('#tags').tagsinput('add', university_name);
    }



}

function tags_with_hyphen() {

    var notice_title = $('#notice_title').val();

    notice_title = notice_title.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
        .toLowerCase();
    notice_title = notice_title.replace(/^\s+|\s+$/gm, '');

    notice_title = notice_title.replace(/\s+/g, '-');

    $('#tags').tagsinput('add', notice_title);


    var university_name = $('#university_id option:selected').text().trim();
    if (university_name && university_name != 'Select' && university_name != 'select') {
        university_name = university_name.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
            .toLowerCase();
        university_name = university_name.replace(/^\s+|\s+$/gm, '');

        university_name = university_name.replace(/\s+/g, '-');
        $('#tags').tagsinput('add', university_name);
    }


}

function convertToTags() {

    tags_with_space();
    tags_with_hyphen();
    var str = '';
    var notice_title = $('#notice_title').val();
    var university_name = $('#university_id option:selected').text().trim();

    if (notice_title) {
        str += notice_title;
    }

    if (university_name && university_name != 'Select' && university_name != 'select') {
        str += " " + university_name;
    }

    //var str = $('#notice_title').val();
    //replace all special characters | symbols with a space
    str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
        .toLowerCase();

    // trim spaces at start and end of string
    str = str.replace(/^\s+|\s+$/gm, '');

    // replace space with dash/hyphen
    str = str.replace(/\s+/g, ',');
    //document.getElementById("slug-text").innerHTML = str;
    //return str;

    $('#tags').tagsinput('add', str);
}

$('body').on('click', '#save-notice-button', function(event) {
    event.preventDefault();
    if (!verifyInput()) {
        return false;
    }

    $('#dvLoading').show();
    $('#save-notice-button').attr('disabled', 'disabled');

    var formData = new FormData(document.getElementById("frm1"));
    $('#dvLoading').show();
    $.ajax({
        type: "post",
        contentType: false,
        processData: false,
        cache: false,
        url: "Save_notice_university.php",
        data: formData,
        dataType: "json",
        success: function(data) {
            // alert(JSON.stringify(data))
            if (data.status == 1) {
                alert(data.msg);
                resetdata();
                $('#dvLoading').hide();
                $('#save-notice-button').attr('disabled', '');
                toastr.success(data.msg);
                location.reload();
            } else {
                $('#dvLoading').hide();
                $('#save-notice-button').attr('disabled', '');
                toastr.error(data.msg);
                //alert(data.msg);
                return false;
            }
        }
    });
});

function verifyInput() {

    if ($.trim($("#course_for").val()) == "") {
        toastr.error("Select Course For");
        $("#course_for").focus();
        return false;
    }
    if ($.trim($("#notice_category").val()) == "") {
        toastr.error("Select Notice Category");
        $("#notice_category").focus();
        return false;
    }

    if ($.trim($("#notice_type").val()) == "") {
        toastr.error("Select Notice Type");
        $("#notice_type").focus();
        return false;
    }

    if ($.trim($("#notice_title").val()) == "") {
        toastr.error("Enter Notice Title");
        $("#notice_title").focus();
        return false;
    }



    if ($.trim($("#notice_type").val()) == 'page' && $("#action").val() != 'edit') {
        if ($("#page_link").val() === "") {
            toastr.error("Upload Notice Page");
            $("#page_link").focus();
            return false;
        }
    }
    if ($.trim($("#notice_type").val()) == 'url') {
        if ($.trim($("#url_link").val()) == "") {
            toastr.error("Enter Notice URL");
            $("#url_link").focus();
            return false;
        }
    }

    if ($.trim($("#university_id").val()) == "") {
        toastr.error("Select University");
        $("#university_id").focus();
        return false;
    }

    if ($.trim($("#has_attachment").val()) == "") {
        toastr.error("Select has attachment?");
        $("#has_attachment").focus();
        return false;
    }


    if ($.trim($("#notice_date").val()) == "") {
        toastr.error("Notice Date is Required");
        $("#notice_date").focus();
        return false;
    }
    if ($.trim($("#notice_type").val()) == 'page') {
        if ($.trim($("#slug").val()) == "") {
            toastr.error("Slug is Required");
            $("#slug").focus();
            return false;
        }
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
        url: "Save_notice_university.php?statusid=" + rid + "&status=" + status,
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

// $('#notice_title').on('keypress', function(event) {
//     var regex = new RegExp("^[a-zA-Z () .]+$");
//     var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);

//     if (!regex.test(key)) {
//         event.preventDefault();
//         return false;
//     }
// });


//GET SINGLE RECORD
// $(".get-record").click(function() {
$('body').on('click', '.get-record', function(event) {
    event.preventDefault();
    $('#dvLoading').show();
    var eid = $(this).attr("eid");
    $.ajax({
        type: "get",
        // async: false,
        url: "Save_notice_university.php?eid=" + eid,
        dataType: "json",
        success: function(data) {
            if (data.status == 1) {

                $('#notice_title').val(data.record.notice_title);
                $('#course_for').val(data.record.course_for);
                $('#notice_category').val(data.record.notice_category);
                $('#notice_type').val(data.record.notice_type);



                if (data.record.notice_type == 'page') {

                    var base_url_upload = $('#base_url_upload').val();
                    var base_url = $('#base_url').val();
                    $('#notice_url_div').hide();
                    $('#notice_page_div').show();
                    // $('#slug_div').show();

                    if (data.record.notice_type == "page") {
                        var path = base_url + "/" + data.record.slug;

                        var download_path = base_url_upload + "/notices/" + data.record.page_link;
                        $("#page_link_path").show();
                        $("#page_link_path_download").show();

                        $("#page_link_path").attr("href", path);

                        $("#page_link_path_download").attr("href", download_path);
                        $("#page_link_path_download").attr("download", download_path);
                    }

                }

                if (data.record.notice_type == 'url') {
                    $('#notice_page_div').hide();
                    $('#notice_url_div').show();
                    // $('#slug_div').hide();    
                    // $('#slug').val("");   
                    $('#url_link').val(data.record.url_link);
                }

                $("#has_attachment").val(data.record.has_attachment);
                $('#notice_date').val(data.record.notice_date);



                $('#university_id').val(data.record.university_id);
                $('#university_id').select2({
                    tags: true
                }).val(data.record.university_id)


                $('#tags').tagsinput('destroy'); // Destroy the tagsinput
                $('#tags').val(data.record.tags); // Clear the value
                $('#tags').tagsinput('add', data.record.tags)

                $('#slug').val(data.record.slug);
                $('#is_new').val(data.record.is_new);
                $('#is_active').val(data.record.is_active);
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
    $("#notice_date").val("");
    $('#course_for').val("");
    $('#notice_category').val("");
    $("#is_new").val("1");
    $("#is_active").val("1");
    $("#description").val("");

    $("#university_id").val("");
    $('#university_id').select2({
        tags: true
    }).val("");

    $("#has_attachment").val("");
    $("#slug").val("");
    $('#tags').tagsinput('destroy'); // Destroy the tagsinput
    $('#tags').val(''); // Clear the value
    $('#tags').tagsinput();
    $("#page_link_path").hide();
    $("#page_link_path_download").hide();


}

function openModalForm() {
    resetdata();
    $("#action").val("add");
    $('#record_id').val("");
    $("#add_edit_form").modal();
}



function concatenate(string_one, string_two, with_space) {
    if (with_space === true) {
        return string_one + string_two;
    } else {
        return string_one + string_two;
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



function showHideAsPerNoticeType() {
    var notice_type = $('#notice_type').val();
    $('#url_link').val('');
    $('#page_link').val('');
    if (notice_type == 'page') {

        $('#notice_url_div').hide();
        $('#notice_page_div').show();
        // $('#slug_div').show();
    }
    if (notice_type == 'url') {
        $('#notice_page_div').hide();
        $('#notice_url_div').show();
        // $('#slug_div').hide();    
        //$('#slug').val("");                
    }
}



$('body').on('click', '.get-attachment-record', function(event) {
    event.preventDefault();
    $('#frm2')[0].reset();
    //$('#dvLoading').show();
    var cid = $(this).attr("cid");
    var nid = $(this).attr("nid");
    var cname = $(this).attr("cname");
    $('#attch_university_id').val(cid);
    $('#attch_notice_id').val(nid);
    $('#university_name').val(cname);
    $('#directoryContainer').html("");
    $('#attachments_file_list').html("");

    // $('#new_directory').val("");
    $('#new_directory').select2({
        tags: true
    }).val("");
    fetchDirectoryStructure(cid);
    fetchOnlyDirectoryStructure(cid);
    //  fetchSubDirectoryStructure(cid);
    $("#base_directory").val('../../uploads/notices/university/' + cid);
    $("#add_edit_attachment_form").modal();

});

function fetchOnlyDirectoryStructure(cid) {
    $.ajax({
        url: "getOnlyDirectory.php?id=" + cid + "&from=university",
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log(data);

            var html = '';
            if (data.length > 0) {
                html += '<option value="">Select</option>';
                for (let i = 0; i < data.length; i++) {
                    html += '<option value="' + data[i] + '">' + data[i] + '</option>';
                }

                $('#year_directory').html(html);
                $('#year_directory').select2({
                    tags: true
                });
            } else {
                html += '<option value="">Select</option>';
                $('#year_directory').html(html);
                $('#year_directory').select2({
                    tags: true
                });

            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching directory structure:', error);
        }
    });
}

function fetchSubDirectoryStructure(dir) {
    var cid = $('#attch_university_id').val();
    var dir = dir;
    $.ajax({
        url: "getSubDirectory.php?id=" + cid + "&from=university&dir=" + dir,
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log(data);

            var html = '';
            if (data.length > 0) {
                html += '<option value="">Select</option>';
                for (let i = 0; i < data.length; i++) {
                    html += '<option value="' + data[i] + '">' + data[i] + '</option>';
                }

                $('#new_directory').html(html);
            } else {
                html += '<option value="">Select</option>';
                $('#new_directory').html(html);

            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching directory structure:', error);
        }
    });
}

function fetchFilenameOfDirectory(dir) {
    var notice_id = $('#attch_notice_id').val();
    var university_id = $('#attch_university_id').val();
    var year_directory = $('#year_directory').val();

    $.ajax({
        url: "getAttachmentFile.php?notice_id=" + notice_id + "&from=university&id=" + university_id + "&year_directory=" + year_directory + "&dir=" + dir,
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log(data);
            var html = '';

            if (data.length > 0) {
                for (let i = 0; i < data.length; i++) {
                    var filePath = data[i].link; // The link to the file
                    var fileName = data[i].path.split('/').pop(); // Get the file name from the path
                    var dirPath = data[i].path;
                    var id = data[i].id;
                    html += '<li>' +
                        '<a href="' + filePath + '" target="_blank">' + fileName + '</a>' +
                        ' <a href="javascript:void(0)"onclick="removeAttachmentFile(\'' + dirPath + '\', \'' + dir + '\', \'' + id + '\')">' +
                        '<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>' +
                        '</li>';
                }

                $('#attachments_file_list').html(html);
            } else {
                $('#attachments_file_list').html("No files found.");
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching directory structure:', error);
        }
    });
}


function fetchDirectoryStructure(cid) {
    $.ajax({
        url: "getDirectory.php?id=" + cid + "&from=university",
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            displayDirectory(data, $('#directoryContainer')); // Display the directory structure
        },
        error: function(xhr, status, error) {
            console.error('Error fetching directory structure:', error);
        }
    });
}

// Function to display directory structure recursively
function displayDirectory(directoryData, container) {
    $.each(directoryData, function(index, item) {
        const itemDiv = $('<div></div>').addClass('directory-item');

        if (item.type === 'directory') {
            const folderIcon = $('<span></span>').text('📁').addClass('directory-icon'); // Folder icon
            itemDiv.append(folderIcon);
            itemDiv.append('<strong>' + item.name + '</strong>');

            itemDiv.on('click', function(event) {
                $(this).children('.directory-content').first().toggle(); // Toggle only the first child div
                event.stopPropagation(); // Prevent triggering parent clicks
            });

            // Recursively add children (subdirectories and files)
            if (item.children && item.children.length > 0) {
                const subContainer = $('<div class="directory-content"></div>'); // Container for children
                displayDirectory(item.children, subContainer);
                itemDiv.append(subContainer); // Append the container with all children
            }
        } else if (item.type === 'file') {
            const fileIcon = $('<span></span>').text('📄').addClass('directory-icon'); // File icon
            const fileLink = $('<a></a>')
                .addClass('directory-link')
                .attr('href', item.path) // File path for download
                .attr('download', '') // Prompt for download
                .append(fileIcon)
                .append(item.name);
            itemDiv.addClass('file-item');
            itemDiv.append(fileLink);
        }

        container.append(itemDiv);
    });
}

$('body').on('click', '#save-attachment-notice-button', function(event) {
    event.preventDefault();
    if (!verifyInputAttachment()) {
        return false;
    }

    $('#dvLoading').show();
    $('#save-attachment-notice-button').attr('disabled', true);

    var formData = new FormData(document.getElementById("frm2"));
    var notice_id = $('#attch_notice_id').val();
    var university_id = $('#attch_university_id').val();
    var new_directory = $('#new_directory').val();
    $('#dvLoading').show();
    $.ajax({
        type: "post",
        contentType: false,
        processData: false,
        cache: false,
        //url: "Save_attachments.php",
        url: "Save_attachments.php?notice_id=" + notice_id + "&from=university&id=" + university_id,
        data: formData,
        dataType: "json",
        success: function(data) {
            // alert(JSON.stringify(data))
            console.log(data);
            if (data.status == 1) {
                alert(data.msg);
                //  resetdata();
                $('#dvLoading').hide();

                toastr.success(data.msg);
                $('#directoryContainer').html("");
                fetchFilenameOfDirectory(new_directory);
                fetchDirectoryStructure(university_id);
                $('#save-attachment-notice-button').attr('disabled', false);
                // location.reload();
            } else {
                alert("no");
                $('#dvLoading').hide();
                $('#save-attachment-notice-button').attr('disabled', false);
                toastr.error(data.msg);
                //alert(data.msg);
                return false;
            }
        }
    });
});

function verifyInputAttachment() {

    if ($.trim($("#year_directory").val()) == "") {
        toastr.error("Select university Directory");
        $("#year_directory").focus();
        return false;
    }
    if ($.trim($("#new_directory").val()) == "") {
        toastr.error("Select New Directory");
        $("#new_directory").focus();
        return false;
    }

    if ($.trim($("#attachments").val()) == "") {
        toastr.error("Select Attachments");
        $("#attachments").focus();
        return false;
    }
    return true;
}


//Add New University
$(document).ready(function() {

    $('#new_directory').select2({
        placeholder: 'Select Directory',
        theme: 'bootstrap4',
        tags: true,
    }).on('select2:close', function() {
        var element = $(this);
        var new_directory = $.trim(element.val());

        var university_id = $('#attch_university_id').val();
        var year_directory = $('#year_directory').val();

        if (year_directory) {
            if (new_directory != '' && typeof new_directory === 'string') {
                $.ajax({
                    type: "get",
                    async: false,
                    url: "Save_attachments.php?newDirectory=" + new_directory + "&from=university&id=" + university_id + "&year_directory=" + year_directory,
                    dataType: "json",
                    success: function(data) {
                        if (data.status == 1) {
                            // Check if the option already exists to avoid duplication
                            if ($("#new_directory option[value='" + new_directory + "']").length === 0) {
                                element.append('<option value="' + new_directory + '">' + new_directory + '</option>');
                            }
                            element.val(new_directory);  // Select the newly added option
                            $('#directoryContainer').html("");
                            fetchDirectoryStructure(university_id);
                        }
                    }
                })
            }
        } else {
            toastr.error("Select university Directory");
        }

    });

});


$(document).ready(function() {

    $('#year_directory').select2({
        placeholder: 'Select Directory',
        theme: 'bootstrap4',
        tags: true,
    }).on('select2:close', function() {
        var element = $(this);
        var year_directory = $.trim(element.val());

        var university_id = $('#attch_university_id').val();

        if (year_directory) {
            if (year_directory != '' && typeof year_directory === 'string') {
                $.ajax({
                    type: "get",
                    async: false,
                    url: "Save_attachments.php?newYearDirectory=" + year_directory + "&from=university&id=" + university_id,
                    dataType: "json",
                    success: function(data) {
                        if (data.status == 1) {
                            // Check if the option already exists to avoid duplication
                            if ($("#year_directory option[value='" + year_directory + "']").length === 0) {
                                element.append('<option value="' + year_directory + '">' + year_directory + '</option>');
                            }
                            element.val(year_directory); // Select the newly added option
                            $('#directoryContainer').html("");
                            fetchDirectoryStructure(university_id);
                        }
                    }
                })
            }
        } else {
            toastr.error("Select university Directory");
        }

    });

});


function removeAttachmentFile(file_path, dir, id) {
    if(!confirm('Are you sure you want to delete the file from server?')){
        e.preventDefault();
        return false;
    }
    $('#dvLoading').show();
    $.ajax({
        type: "get",
        contentType: false,
        processData: false,
        cache: false,
        //url: "Save_attachments.php",
        url: "Save_attachments.php?removeAttachmentFile=" + file_path + "&from=university&dir=" + dir,
        // data: formData,
        dataType: "json",
        success: function(data) {
            // alert(JSON.stringify(data))
            if (data.status == 1) {
                alert(data.msg);
                resetdata();
                $('#dvLoading').hide();
                fetchFilenameOfDirectory(data.dir_name);
                $('#directoryContainer').html("");
                fetchDirectoryStructure(id);
                toastr.success(data.msg);
                //location.reload();
            } else {
                $('#dvLoading').hide();

                toastr.error(data.msg);
                //alert(data.msg);
                return false;
            }
        }
    });
}