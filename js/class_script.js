// handle on-click "join":
// add the event to the users Google calendar

function addTaiChi() {
    // AJAX used below
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Typical action to be performed when the   document is ready:
            console.log('Attempted to add event...');
            console.log(this.responseText);
        }
    };
    xhttp.open("POST", "POST_calenderEvent_example.php", true);
    xhttp.send();
}