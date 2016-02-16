  document.getElementById("textForm").onsubmit = validate;
  function validate ()
  {
    var elt = document.getElementById("textForm");
    if ((elt.userName.value.length < 6)||(10 < elt.userName.value.length))
    {
      // The user name must be between 6 and 10 characters long.
      window.alert ("Invalid Input: The user name must be between 6 and 10 characters long.");
      return false;
    } else if (elt.userName.value.search("^[a-z]") == -1 )
        {
        // The user name must begin with a letter.
        window.alert ("Invalid Input : The user name must begin with a letter");
        return false; 
    } else if (elt.userName.value.search("[^a-zA-Z0-9]") != -1)
        {
        // The user name must contain only letters and digits.
        window.alert ("Invalid Input: The user name must contain only letters and digits.");
        return false;
    } else if (elt.pass.value != elt.repass.value)
        {
        // The password and the repeat password must match.
        window.alert("Invalid Input: The password and the repeat password must match.");
        return false;
    } else if ((elt.pass.value.length < 6)||(10 < elt.pass.value.length))
        {
        // The password must be between 6 and 10 characters.
        window.alert("Invalid Input: The password must be between 6 and 10 characters.");
        return false;
    } else if (elt.pass.value.search("[^a-zA-Z0-9_]") != -1)
        {
        // The password can contain only letters, digits and underscores.
        window.alert("Invalid Input: The password can contain only letters, digits and underscores.");
        return false;
    } else if ((elt.pass.value.match("[0-9]") && elt.pass.value.match("[a-z]") && elt.pass.value.match("[A-Z]")) == null)
    {
      // must contain 1 upper, 1 lower, and 1 digit
      window.alert ("Invalid Input: The password must have at least one lower case letter, at least one upper case letter, and at least one digit.");
      return false;
    }
    window.alert("Passed Validation.")
    return true;
  }

