// to sort teams and players table
// define a variable to keep track of the previously selected header
var prevHeader = null;

function sortTable(column) {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementsByTagName("table")[0];
  switching = true;
  while (switching) {
    switching = false;
    rows = table.rows;
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("td")[column];
      y = rows[i + 1].getElementsByTagName("td")[column];
      if (Number(x.innerHTML) < Number(y.innerHTML)) {
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}


window.onload = function() {
  var headers = document.getElementsByTagName("th");
  for (var i = 0; i < headers.length; i++) {
    headers[i].addEventListener("click", function() {
      var index = this.cellIndex;
      // remove italic style from previous header, if there was one
      if (prevHeader != null) {
        prevHeader.style.fontStyle = "normal";
      }
      // set the font-style of the clicked header to italic
      this.style.fontStyle = "italic";
      // set the clicked header as the new previous header
      prevHeader = this;
      sortTable(index);
    });
    // set cursor to pointer for sortable headers
    headers[i].style.cursor = "pointer";
    // set the Shot Attempts header to italic by default
    if (headers[i].innerHTML == "Shot Attempts") {
      headers[i].style.fontStyle = "italic";
      prevHeader = headers[i];
    } else {
      headers[i].style.fontStyle = "normal";
    }
  }
};




