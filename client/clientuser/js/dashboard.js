
// function getClickDetails(ad_id){
  
//     $('#dvLoading').show(); 

//     $.ajax({
//       url: "client_dashboard.php?getClickDetail=" + ad_id,
//       type: 'GET',
//       success: function(response) { 
//         $('#clickDetailTable').html("")
//           $('#clickDetailTable').html(response)
//           $("#click-detail-info").modal();
//           $('#dvLoading').hide();
//       }
//     });
// }


function getClickDetails(ad_id) {
  $('#dvLoading').show();

  $.ajax({
      url: "client_dashboard.php?getClickDetail=" + ad_id,
      type: 'GET',
      success: function(response) {
          // Update the table body with the response
          $('#clickDetailTable').html(response); 

          // Destroy any existing DataTable instance if present
          if ($.fn.DataTable.isDataTable('#master-table')) {
              $('#master-table').DataTable().destroy();
          }

          // Initialize DataTable on the updated table
          $('#master-table').DataTable({
              "paging": true, // Enable pagination
              "searching": true, // Enable searching
              "ordering": true, // Enable sorting
              "pageLength": 10, // Set default number of items to display
              "destroy": true // Allow reinitialization of DataTable
          });

          // Show the modal with updated table data
          $("#click-detail-info").modal('show'); 
          $('#dvLoading').hide();
      },
      error: function(xhr, status, error) {
          console.error("Error occurred: " + error);
          $('#dvLoading').hide();
      }
  });
}

function getImpressionDetails(ad_id) { 
    $('#dvLoading').show();
  
    $.ajax({
        url: "client_dashboard.php?getImpressionDetail=" + ad_id,
        type: 'GET',
        success: function(response) {
            // Update the table body with the response
            $('#impressionDetailTable').html(response); 
  
            // Destroy any existing DataTable instance if present
            if ($.fn.DataTable.isDataTable('#master-table')) {
                $('#master-table-impression').DataTable().destroy();
            }
  
            // Initialize DataTable on the updated table
            $('#master-table-impression').DataTable({
                "paging": true, // Enable pagination
                "searching": true, // Enable searching
                "ordering": true, // Enable sorting
                "pageLength": 10, // Set default number of items to display
                "destroy": true // Allow reinitialization of DataTable
            });
  
            // Show the modal with updated table data
            $("#impression-detail-info").modal('show'); 
            $('#dvLoading').hide();
        },
        error: function(xhr, status, error) {
            console.error("Error occurred: " + error);
            $('#dvLoading').hide();
        }
    });
  }


       