function hello() {
  alert("Hello, World!");
}

// function modifyArea1() {
//   var textarea = document.getElementById("area1");
//   textarea.style.fontSize = "24pt";
// }

function pageLoad() {
  document.getElementById("pimp").onclick = timer;
  document.getElementById("check1").onclick = bling;
  document.getElementById("snoopify").onclick = snoopify;
  document.getElementById("igpay").onclick = igpay;
  document.getElementById("malkovitch").onclick = malkovitch;
}

function bling() {
  var textarea = document.getElementById("area1");
  var checkbox = document.getElementById("check1");
  if (checkbox.checked == true) {
    textarea.style.fontWeight = "bold";
    textarea.style.color = "green";
    textarea.style.textDecoration = "underline";
    document.body.style.backgroundImage =
      "url(https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/8/hundred.jpg)";
  } else {
    textarea.style.fontWeight = "normal";
    textarea.style.color = "black";
    textarea.style.textDecoration = "none";
    document.body.style.backgroundImage = "none";
  }
}

function snoopify() {
  var textarea = document.getElementById("area1");
  textarea.value = textarea.value.toUpperCase();
  textarea.value = textarea.value.split(".").join("-izzle");
}

function modifyArea1() {
  var textarea = document.getElementById("area1");
  if (textarea.style.fontSize == false) {
    textarea.style.fontSize = "12pt";
  } else {
    textarea.style.fontSize = parseInt(textarea.style.fontSize) + 2 + "pt";
  }
}

function timer() {
  setInterval(modifyArea1, 500);
}

function pigLatin(str) {
  var textarea = document.getElementById("area1");
  str = textarea.value;
  str = str.toLowerCase();
  const vowels = ["a", "e", "i", "o", "u"];
  let vowelIndex = 0;
  if (vowels.includes(str[0])) {
    return str + "ay";
  } else {
    for (let char of str) {
      if (vowels.includes(char)) {
        vowelIndex = str.indexOf(char);
        break;
      }
    }
    return str.slice(vowelIndex) + str.slice(0, vowelIndex) + "ay";
  }
}

function igpay() {
  var textarea = document.getElementById("area1");
  var str = textarea.value;
  var result = str;
  var i, j;
  for (i = 0; i < str.length; i++) {
    for (j = i; j < str.length; j++);
    result = result.replace(str.slice(i, j), pigLatin(str.slice(i, j)));
    i = j;
  }
  textarea.value = result;
}

function malkovitch() {
  var textarea = document.getElementById("area1");
  var str = textarea.value;
  var result = str;
  var i, j;
  for (i = 0; i < str.length; i++) {
    for (j = i; j < str.length; j++) {
      if (j - i >= 5) {
        result = result.replace(str.slice(i, j), "Malkovitch");
      }
    }
    i = j;
  }
  textarea.value = result;
}

window.onload = pageLoad;
