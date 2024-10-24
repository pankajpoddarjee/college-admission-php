/* Encode string to slug */
function convertToSlug() {
    var str = $('#page_title').val();
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
    var page_title = $('#page_title').val();
    page_title = page_title.toLowerCase();
    $('#tags').tagsinput('add', page_title);



    var university_name = $('#university_id option:selected').text().trim();
    if (university_name && university_name != 'Select' && university_name != 'select') {
        university_name = university_name.toLowerCase();
        $('#tags').tagsinput('add', university_name);
    }



}

function tags_with_hyphen() {

    var page_title = $('#page_title').val();

    page_title = page_title.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
        .toLowerCase();
    page_title = page_title.replace(/^\s+|\s+$/gm, '');

    page_title = page_title.replace(/\s+/g, '-');

    $('#tags').tagsinput('add', page_title);


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
    var page_title = $('#page_title').val();
    var university_name = $('#university_id option:selected').text().trim();

    if (page_title) {
        str += page_title;
    }

    if (university_name && university_name != 'Select' && university_name != 'select') {
        str += " " + university_name;
    }

    //var str = $('#page_title').val();
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






$('body').on('click', '#save-university-page-button', function(event) {
    event.preventDefault();
    if (!verifyInput()) {
        return false;
    }

    $('#dvLoading').show();
    $('#save-university-page-button').attr('disabled', 'disabled');

    var formData = new FormData(document.getElementById("frm1"));
    $('#dvLoading').show();
    $.ajax({
        type: "post",
        contentType: false,
        processData: false,
        cache: false,
        url: "Save_university_page.php",
        data: formData,
        dataType: "json",
        success: function(data) {
            // alert(JSON.stringify(data))
            if (data.status == 1) {
                alert(data.msg);
                resetdata();
                $('#dvLoading').hide();
                $('#save-university-page-button').attr('disabled', '');
                toastr.success(data.msg);
                location.reload();
            } else {
                $('#dvLoading').hide();
                $('#save-university-page-button').attr('disabled', '');
                toastr.error(data.msg);
                //alert(data.msg);
                return false;
            }
        }
    });
});

function verifyInput() {


    if ($.trim($("#page_title").val()) == "") {
        toastr.error("Enter Page Title");
        $("#page_title").focus();
        return false;
    }

    if ($.trim($("#university_id").val()) == "") {
        toastr.error("Select university");
        $("#university_id").focus();
        return false;
    }

    if ($.trim($("#record_id").val()) == "") {

        if($.trim($("#html_page").val()) == ""){
            toastr.error("Select html page");
            $("#html_page").focus();
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
        url: "Save_university_page.php?statusid=" + rid + "&status=" + status,
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

// $('#page_title').on('keypress', function(event) {
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
        url: "Save_university_page.php?eid=" + eid,
        dataType: "json",
        success: function(data) {
            if (data.status == 1) {

                var base_url = $('#base_url').val();
                var base_url_upload = $('#base_url_upload').val();

                $('#page_title').val(data.record.page_title);

                if(data.record.html_page){ 

                    var path = base_url + "/" + data.record.slug;

                    var download_path = base_url_upload + "/" + data.record.html_page;
                    $("#html_page_path").show();
                    $("#html_page_path_download").show();

                    $("#html_page_path").attr("href", path);

                    $("#html_page_path_download").attr("href", download_path);
                    $("#html_page_path_download").attr("download", download_path);


                   
                }else{
                    $("#html_page_path").hide();  
                    $("#html_page_path_download").show();
                }

                $('#university_id').val(data.record.university_id);
                $('#university_id').select2({
                    tags: true
                }).val(data.record.university_id);

                $('#description').val(data.record.description);
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

    $("#page_title").val("");
   

    $("#university_id").val("");
    $('#university_id').select2({
        tags: true
    }).val("");

    $("#description").val("");
    $('#tags').tagsinput('destroy'); // Destroy the tagsinput
    $('#tags').val(''); // Clear the value
    $('#tags').tagsinput();

    $("#slug").val("");
   
    $("#page_link_path").hide();
    $("#page_link_path_download").hide();


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







