/* CSE3026 : Web Application Development
 * Lab 09 - Maze
 */

"use strict";

var loser = null; // whether the user has hit a wall

window.onload = function() {
  var divs = $$(".boundary");
  for (var i = 0; i < divs.length; i++) {
    divs[i].onmouseover = overBoundary;
  }
  $("end").onmouseover = overEnd;
  $("start").onclick = startClick;
  $("maze").onmouseout = overBody;
  document.body.observe("mousemove", overBody);
};

// called when mouse enters the walls;
// signals the end of the game with a loss
function overBoundary(event) {
  var divs = $$(".boundary");
  for (var i = 0; i < divs.length; i++) {
    divs[i].addClassName("youlose");
  }
  loser = true;
  overEnd();
}

// called when mouse is clicked on Start div;
// sets the maze back to its initial playable state
function startClick() {
  var divs = $$(".boundary");
  for (var i = 0; i < divs.length; i++) {
    divs[i].removeClassName("youlose");
  }
  $("status").innerHTML = "Maze Start!";
  loser = false;
}

// called when mouse is on top of the End div.
// signals the end of the game with a win
function overEnd() {
  if (loser) {
    $("status").innerHTML = "You lose! :( ";
  } else {
    $("status").innerHTML = "You Win! :)";
  }
}

// test for mouse being over document.body so that the player
// can't cheat by going outside the maze
function overBody(event) {
  if (loser === false) {
    if (event.target.getAttribute("id") === null) {
      overBoundary();
    }
  }
}
