
// message when you login either success or error 
function setFormMessage(formElement, type, message) {
  const messageElement = formElement.querySelector(".form__message");

  messageElement.textContent = message;
  messageElement.classList.remove(
    "form__message--success",
    "form__message--error"
  );

  // here we set the message dynamically to show which one error message or logged in
  messageElement.classList.add(`form__message--${type}`);
}

//on the indivualion fields themselfs
function setInputError(inputElement, message) {
  inputElement.classList.add("form__input--error");
  inputElement.parentElement.querySelector(
    ".form__input-error-message"
  ).textContent = message;
}

// to clear out the message by inputElement eventlistner where we check every field
function clearInputError(inputElement) {
  inputElement.classList.remove("form__input--error");
  inputElement.parentElement.querySelector(
    ".form__input-error-message"
  ).textContent = "";
}


// here is saying once the document is ready to work with it will load this function
document.addEventListener("DOMContentLoaded", () => {

  //here are the reference for the login form
  const loginForm = document.querySelector("#login");

  //here is for creating an account 
  const createAccountForm = document.querySelector("#createAccount");

  //when you click on create account link, here we hide the login form and show the create account form
  document
    .querySelector("#linkCreateAccount")
    .addEventListener("click", (e) => {
      e.preventDefault();
      loginForm.classList.add("form--hidden");
      createAccountForm.classList.remove("form--hidden");
    });

    //here when you press on the login in the (create your account) it will show the login form again
  document.querySelector("#linkLogin").addEventListener("click", (e) => {
    e.preventDefault();
    loginForm.classList.remove("form--hidden");
    createAccountForm.classList.add("form--hidden");
  });



  // here we add our ajax/fetch login from the backend
  loginForm.addEventListener("submit", (e) => {

    // so we don't refresh the page when submitted
    e.preventDefault();



    // Perform your AJAX/Fetch login
    
    fetchingData().then(function(response){
      const [data] = response

    })


    //here we going to change error(2) to the type either success or error and (3) parametar to what message we want to display 
    setFormMessage(loginForm, "error", "Invalid username/password combination");
  });


  // to check for every field if they put in the right information like lenght of the password or an email 
  document.querySelectorAll(".form__input").forEach((inputElement) => {
    inputElement.addEventListener("blur", (e) => {
      if (
        e.target.id === "signupUsername" &&
        e.target.value.length > 0 &&
        e.target.value.length < 10
      ) {
        setInputError(
          inputElement,
          "Username must be at least 10 characters in length"
        );
      }
    });

    //here when the user decide to write something it will clear the error it was shown inputElement event listener
    inputElement.addEventListener("input", (e) => {
      clearInputError(inputElement);
    });
  });
});

const fetchingData = function(fetch){
  fetch(`${fetch}`).then(function(response){
    if(!response.ok) throw new Error(`Wrong fetch: ${response.status}}`)
    response.json()
  }).catch(function(err){
    console.log(err)
  })
};