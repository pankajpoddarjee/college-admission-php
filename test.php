<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Simple Tabs Example</title>
<style>
    /* Tab container styling */
    .tab-container {
        display: flex;
        border-bottom: 2px solid #ccc;
    }

    /* Tab buttons styling */
    .tab-button {
        padding: 10px 20px;
        cursor: pointer;
        border: none;
        outline: none;
        background-color: #f1f1f1;
        color: #333;
        font-size: 16px;
    }

    /* Active tab styling */
    .tab-button.active {
        background-color: #007bff;
        color: white;
        border-bottom: 2px solid #007bff;
    }

    /* Tab content styling */
    .tab-content {
        display: none;
        padding: 20px;
        border: 1px solid #ccc;
    }

    /* Show active tab content */
    .tab-content.active {
        display: block;
    }
</style>
</head>
<body>

<h2>HTML Tabs Example</h2>

<!-- Tab container -->
<div class="tab-container">
    <button class="tab-button active" onclick="openTab(event, 'Tab1')">Tab 1</button>
    <button class="tab-button" onclick="openTab(event, 'Tab2')">Tab 2</button>
    <button class="tab-button" onclick="openTab(event, 'Tab3')">Tab 3</button>
</div>

<!-- Tab content sections -->
<div id="Tab1" class="tab-content active">
    <h3>Tab 1 Content</h3>
    <p>This is the content for Tab 1.</p>
</div>

<div id="Tab2" class="tab-content">
    <h3>Tab 2 Content</h3>
    <p>This is the content for Tab 2.</p>
</div>

<div id="Tab3" class="tab-content">
    <h3>Tab 3 Content</h3>
    <p>This is the content for Tab 3.</p>
</div>

<script>
// JavaScript function to open tabs
function openTab(event, tabName) {
    // Hide all tab contents
    var tabContents = document.getElementsByClassName("tab-content");
    for (var i = 0; i < tabContents.length; i++) {
        tabContents[i].classList.remove("active");
    }

    // Remove the "active" class from all buttons
    var tabButtons = document.getElementsByClassName("tab-button");
    for (var i = 0; i < tabButtons.length; i++) {
        tabButtons[i].classList.remove("active");
    }

    // Show the current tab and add the "active" class to the clicked button
    document.getElementById(tabName).classList.add("active");
    event.currentTarget.classList.add("active");
}
</script>

</body>
</html>
