function shareURL() {
        return URL;

}

function reqListener () {
        console.log(this.responseText);
      }
  function phpCall() {
      var oReq = new XMLHttpRequest(); // New request object
      oReq.onload = function() {
          // This is where you handle what to do with the response.
          // The actual data is found on this.responseText
          console.log(this.responseText); // Will alert: 42
      };
      oReq.open("get", "get-data.php", true);
      //                               ^ Don't block the rest of the execution.
      //                                 Don't wait until the request finishes to
      //                                 continue.
      oReq.send();
}