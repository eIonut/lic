const password = "239909";

window.addEventListener("load", function () {
  var passwordAnswer = this.prompt("Enter admin password to access this page!");

  if (passwordAnswer === password) {
    this.alert("Welcome!");
  } else {
    this.prompt("Enter admin password to access this page!");
  }

  while (passwordAnswer !== password) {
    var passwordAnswer = this.prompt(
      "Enter admin password to access this page!"
    );
  }
});
