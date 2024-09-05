<?php include('settings.php'); include("connection.php");include("function.php"); ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<title><?php echo SITE_NAME;?> - <?php echo SITE_TAGLINE;?></title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta property="og:title" content="">
<meta property="og:description" content="">
<meta property="og:image" content="">
<meta property="og:url" content="">
<?php echo OTHER_META_TAGS;?>
<?php include("head_includes.php");?>

<style>
    /* Hide the loading GIF by default */
    #loadingGif {
        display: none;
    }

    .shimmer-container {
            width: 100%;
            /* max-width: 600px; */
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .shimmer {
            position: relative;
            height: 100px;
            margin-bottom: 20px;
            background: #c0c0c0;;
            border-radius: 4px;
            overflow: hidden;
        }

        .shimmer::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.5) 50%, rgba(255, 255, 255, 0) 100%);
            animation: shimmer 1.5s infinite;
        }

        @keyframes shimmer {
            0% {
                left: -100%;
            }
            100% {
                left: 100%;
            }
        }

        /* Additional styles for loading content */
        .shimmer-title {
            height: 20px;
            /* width: 60%; */
            margin-bottom: 10px;
        }
        .shimmer-img {
        height: 40px;
        width: 40px;
        margin-bottom: 10px;
        margin-right: 10px;
        }

        .shimmer-text {
            height: 15px;
            width: 100%;
        }
</style>
<style>
        .search-container {
            position: relative;
            width: 100%;
        }

        .search-input {
            width: 100%;
            padding: 10px 30px 10px 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .clear-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            visibility: hidden;
            font-size: 18px;
        }

        .search-input:not(:placeholder-shown) + .clear-icon {
            visibility: visible;
        }
    </style>
</head>
<body>
      
	<?php include("header.php");?>
    <?php include("menu.php");?>
 
    <section>
        <div class="container pt-5 pb-5">
            
            <div class="row">
                <div class="col-md-12">
                	<h4 class="text-dark" style="font-family:Oswald">SEARCH: COLLEGES, EXAM, RESULTS, MERIT LIST, ETC.</h4>
                </div>
                <div class="col-md-12">
                    <div class="input-group mb-1 search-container">
                        <input type="text" class="search-input rounded p-3 bg-secondary bg-opacity-10 border border-dark-subtle" id="searchQuery" name="search_query" placeholder="Search for colleges, universities, courses, notices..." style="font-family:Oswald">
                        <span class="clear-icon" onclick="clearSearch()">&#10006;</span>
                    </div>
                </div>
                <div class="col-md-12">
                    <script>
                        function clearSearch() {
                        const input = document.getElementById('searchQuery');
                        input.value = '';
                        input.focus();
                        }
                    </script>
                </div>
                <div class="col-md-12">
                    <div class="shadow" id="loadingGif">
                        <div class="row align-items-center m-0 p-2">
                            <div class="shimmer shimmer-img rounded-circle col-md-2"></div><div class="shimmer shimmer-title col-md-9"></div>
                        </div>
                        <div class="row align-items-center m-0 p-2">
                            <div class="shimmer shimmer-img rounded-circle col-md-3"></div><div class="shimmer shimmer-title col-md-9"></div>
                        </div>
                        <div class="row align-items-center m-0 p-2">
                            <div class="shimmer shimmer-img rounded-circle col-md-3"></div><div class="shimmer shimmer-title col-md-9"></div>
                        </div>
                        <div class="row align-items-center m-0 p-2">
                            <div class="shimmer shimmer-img rounded-circle col-md-3"></div><div class="shimmer shimmer-title col-md-9"></div>
                        </div>
                        <div class="row align-items-center m-0 p-2">
                            <div class="shimmer shimmer-img rounded-circle col-md-3"></div><div class="shimmer shimmer-title col-md-9"></div>
                        </div>
                        <div class="row align-items-center m-0 p-2">
                            <div class="shimmer shimmer-img rounded-circle col-md-3"></div><div class="shimmer shimmer-title col-md-9"></div>
                        </div>
                       
                    </div>
                    <div id="suggestions"></div>
                </div>
            </div>
        </div>
    </section>

    <!--<section>
        <div class="container pt-5 pb-5">
            <div class="row">
                <div class="col-md-12">
                    <form id="searchForm" method="GET" action="">
                        <input type="text" id="searchQuery" name="search_query" placeholder="Search for colleges, universities, courses, notices...">
                        <button type="submit">Search</button>
                        <div id="suggestions"></div>
                    </form>
                </div>
                
            </div>
        </div>
    </section>-->
    
    <section class="bg-light mt-4">
        <div class="container-fluid">
        	<div class="row justify-content-center">   
            	<div class="col-md-2">
                    <a class="btn btn-danger btn-block pt-3 pb-3" href="javascript:void(0)">
                    	<i class="fas fa-chalkboard-teacher" style="font-size:20px"></i><br>
                        <span class="faa-flash animated">APPLY NOW / FORM FILLUP</span><br>
                        for Admission <?php echo CURRENT_YEAR;?>
                    </a>
                    <a class="btn btn-primary btn-block pt-3 pb-3" href="javascript:void(0)">
                    	<i class="fas fa-tasks" style="font-size:20px"></i><br>
                        <span class="faa-flash animated">MERIT / ADMISSION LIST</span><br>
                        for Admission <?php echo CURRENT_YEAR;?>
                    </a>
                    <a class="btn btn-success btn-block pt-3 pb-3" href="javascript:void(0)">
                    	<i class="fas fa-newspaper" style="font-size:20px"></i><br>
                        <span class="faa-flash animated">ADMISSION NOTIFICATION</span><br>
                        for Admission <?php echo CURRENT_YEAR;?>
                    </a>
                </div>
                <div class="col-md-8">
                    <?php include("latest_updates.php");?>
                </div>                
            	<div class="col-md-2">
                    <a class="btn btn-info btn-block pt-3 pb-3" href="javascript:void(0)">
                    	<i class="fas fa-file-alt" style="font-size:20px"></i><br>
                        EXAMINATION SCHEDULE<br>
                        for <?php echo CURRENT_YEAR;?>
                    </a>
                    <a class="btn btn-dark btn-block pt-3 pb-3" href="javascript:void(0)">
                    	<i class="fas fa-book-open" style="font-size:20px"></i><br>
                        EXAMINATION RESULTS<br>
                        for <?php echo CURRENT_YEAR;?>
                    </a>
                    <a class="btn btn-warning btn-block pt-3 pb-3" href="javascript:void(0)">
                    	<i class="fas fa-bell faa-tada animated" style="font-size:20px"></i><br>
                        NOTIFICATIONS<br>
                        for <?php echo CURRENT_YEAR;?>
                    </a>
                </div>
            </div>
        </div>
    </section>
    
	<?php include("footer.php");?>
    <?php include("report_problem.php");?>
    <?php include("footer_includes.php");?>
    <?php $dbConn =NULL; ?>


    <script>

    // function debounce(func, wait) {
    //     let timeout;

    //     return function(...args) {
    //         const context = this;

    //         clearTimeout(timeout);
    //         timeout = setTimeout(() => func.apply(context, args), wait);
    //     };
    // }

    // $(document).ready(function() {
    //     $('#searchQuery').on('input', function() {
    //         var query = $(this).val();
    //         if (query.length >= 3) { // Trigger suggestions for queries of length 3 or more
    //             $.ajax({
    //                 url: 'suggestions.php',
    //                 method: 'GET',
    //                 data: { search_query: query },
    //                 success: function(data) {
    //                     $('#suggestions').html(data);
    //                 }
    //             });
    //         } else {
    //             $('#suggestions').empty();
    //         }
    //     });

    //     $(document).on('click', '.suggestion-item', function() {
    //         $('#searchQuery').val($(this).text());
    //         $('#suggestions').empty();
    //     });
    // });



    // Debounce function
function debounce(func, delay) {
    let debounceTimer;
    return function(...args) {
        const context = this;
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => func.apply(context, args), delay);
    };
}

// Search function
function search(query) {
    $('#loadingGif').show();

    $.ajax({
        url: 'suggestions.php',
        method: 'GET',
        data: { search_query: query },
        success: function(data) {
            $('#loadingGif').hide();
            $('#suggestions').html(data); // Display results in the #results container
        }
    });
}

// Attach the debounced search function to the input event
$('#searchQuery').on('input', debounce(function() {
    const query = $(this).val();
    if (query.length >= 3) { // Only search if the query length is 3 or more
        search(query);
    } else {
        $('#suggestions').empty(); // Clear results if the query is too short
    }
}, 300)); // 300ms delay

$(document).on('click', '.suggestion-item', function() {
            $('.list-type').text("");
            //$('#searchQuery').val($(this).text());
            $('#searchQuery').val('');
            $('#suggestions').empty();
        });
    </script>
</body>
</html>