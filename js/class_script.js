// handle on-click "join":
// add the event to the users Google calendar
function addTaiChi() {
  executeAJAX('tai_chi', 'Tai Chi');
}

function addStudyStretch() {
  executeAJAX('study_stretch', 'Study Stretch');
}

function addWeekendRecovery() {
  executeAJAX('weekend_recovery', 'Weekend Recovery');
}

function addCTC() {
  executeAJAX('ctc', 'Cross-Train Challenge');
}

function addMuiTaiKickboxing() {
  executeAJAX('mui_tai_kickboxing', 'Mui Thai Kick Boxing');
}

function addLadiesWhoLift() {
  executeAJAX('ladies_who_lift', 'Ladies Who Lift');
}


// Custom tailored AJAX so it can be used for any recreation by yours truly, Daren 'the back end coder' Capacio.
function executeAJAX(theClass, msg) {
  // AJAX used below
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      // Typical action to be performed when the   document is ready:
      console.log('Attempted to add event...');
      console.log(this.responseText);

      // Change the feedback here (maybe alert, maybe jump to next page)
      var alertMsg = msg + ' has been added to your schedule!';
      alert(alertMsg);
    }
  };
  // Form data so it knows which one to add.
  var data = new FormData();
  data.append('class', theClass);
  xhttp.open("POST", "POST_calenderEvent.php", true);
  xhttp.send(data);
}