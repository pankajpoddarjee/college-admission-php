document.addEventListener('DOMContentLoaded', function() { 
  var slug = $("#slug").val();
  
  var loading = false;
  var page = 1;
  loadMoreContent();
  function loadMoreContent() {
      if (loading) return;
      loading = true;
      document.getElementById('dvLoading').style.display = 'block';

      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'college_listing-load-data.php?page=' + page+'&slug='+ slug, true);
      xhr.onreadystatechange = function () {
          if (xhr.readyState == 4 && xhr.status == 200) {
              document.getElementById('result').innerHTML += xhr.responseText;
              loading = false;
              document.getElementById('dvLoading').style.display = 'none';
              page++;
           
              
          }
      };
      xhr.send();
  }

  function checkScroll() {
      // Use window.innerHeight instead of document.documentElement.clientHeight
      var scrollPosition = window.scrollY || document.documentElement.scrollTop;
      var documentHeight = document.body.scrollHeight || document.documentElement.scrollHeight;
      var viewportHeight = window.innerHeight;

      if ((viewportHeight + scrollPosition) >= documentHeight - 50) {
          loadMoreContent();
      }
  }
  let debounceTimer;
  // Attach the scroll event listener for both desktop and mobile
  window.addEventListener('scroll', function() {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(function() {
        checkScroll();
    }, 200);
});
  window.addEventListener('touchmove', function() {
    checkScroll();
  });
});






  