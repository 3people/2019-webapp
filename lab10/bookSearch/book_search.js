window.onload = function() {
  $("b_xml").onclick = function() {
    new Ajax.Request("books.php", {
      method: "get",
      parameters: { category: getCheckedRadio($$("#category input")) },
      onSuccess: showBooks_XML,
      onFailure: ajaxFailed,
      onException: ajaxFailed
    });
  };
  $("b_json").onclick = function() {
    new Ajax.Request("books_json.php", {
      method: "get",
      parameters: { category: getCheckedRadio($$("#category input")) },
      onSuccess: showBooks_JSON,
      onFailure: ajaxFailed,
      onException: ajaxFailed
    });
  };
};

function getCheckedRadio(radio_button) {
  for (var i = 0; i < radio_button.length; i++) {
    if (radio_button[i].checked) {
      return radio_button[i].value;
    }
  }
  return undefined;
}

function showBooks_XML(ajax) {
  var xmlDom = ajax.responseXML;
  var elms = xmlDom.getElementsByTagName("book");
  var output = "";
  for (var i = 0; i < elms.length; i++) {
    output +=
      "<li>" +
      elms[i].getElementsByTagName("title")[0].innerHTML +
      ", by" +
      elms[i].getElementsByTagName("author")[0].innerHTML +
      "(" +
      elms[i].getElementsByTagName("year")[0].innerHTML +
      ")</li>";
  }
  $("books").innerHTML = output;
}

function showBooks_JSON(ajax) {
  var data = JSON.parse(ajax.responseText).books;
  var output = "";
  for (var i = 0; i < data.length; i++) {
    output +=
      "<li>" +
      data[i].title +
      ", by" +
      data[i].author +
      "(" +
      data[i].year +
      ")</li>";
  }
  $("books").innerHTML = output;
  //   alert(ajax.responseText);
}

function ajaxFailed(ajax, exception) {
  var errorMessage = "Error making Ajax request:\n\n";
  if (exception) {
    errorMessage += "Exception: " + exception.message;
  } else {
    errorMessage +=
      "Server status:\n" +
      ajax.status +
      " " +
      ajax.statusText +
      "\n\nServer response text:\n" +
      ajax.responseText;
  }
  alert(errorMessage);
}
