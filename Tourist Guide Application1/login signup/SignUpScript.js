    const form=document.getElementById('form');
    const username=document.getElementById('username');
    const email=document.getElementById('email');
    const phone=document.getElementById('phone');
    const password=document.getElementById('password');
    const cPassword=document.getElementById('cPassword');
    const togglePassword = document.querySelector('.visible-password');
    const crossLine = document.querySelector('.cross-line');
    //add event, callback function (auto destroy)
    form.addEventListener('submit',(event)=>{
       validate();
        if (validate()==true) {
           form.submit();     
           }
         else{
            event.preventDefault();
         }
    });
    //define the validate function
    const validate=()=>{
        const usernameVal = username.value ? username.value.trim():'';
        const emailVal=email.value.trim();
        const phoneVal=phone.value.trim();
        const passwordVal=password.value.trim();
        const cPasswordVal=cPassword.value.trim();
        let isValid = true;
        
        //validate username
        if(usernameVal===""){
            console.log("Username is empty");
            setErrorMsg(username,"username cannot be empty");
            isValid=false;
        }
        else{
            //name validation
            var namePattern=/^[a-zA-Z ]{3,}$/;            //regular expression end with $
            if(usernameVal.match(namePattern)){
                setSuccessMsg(username);
            console.log("Provided name is valid.");
        }
        else{
            setErrorMsg(username,"please enter valid username username should be at least three letter");
            isValid=false
        }
    }
    //Email validation
    if(emailVal===""){
        console.log("email is empty");
        setErrorMsg(email,"Email cannot be empty");
        isValid=false;
    }
    else{
        var emailPattern=/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;//regular expression end with $
        if(emailVal.match(emailPattern)){
            setSuccessMsg(email);
        console.log("Provided email is valid.");
    }
    else{
        setErrorMsg(email,"please enter a valid email address");
        isValid=false;
    }
    }
    //phone validation
    if(phoneVal===""){
        console.log("mail is empty");
        setErrorMsg(phone,"Phone number cannot be empty");
        isValid=false;
    }
    else{
        var phonePattern= /^(\d{2,5}(-?)\+)?\d{10}$/; //regular expression end with $
        if(phoneVal.match(phonePattern)){
            setSuccessMsg(phone);
        console.log("Provided phone is valid.");
    }
    else{
        setErrorMsg(phone,"please enter a valid phone number");
        isValid=false;
    }
    }
    // password validation
    if (passwordVal === "") {
        console.log("Password is empty");
        setErrorMsg(password, "Password cannot be empty");
        isValid=false;
    } else {
        var passPattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()_+{}|;:'",.<>/?]).{8,15}$/; // regular expression without quotes and $ at the end
        if (passPattern.test(passwordVal)) {
            setSuccessMsg(password);
            console.log("Provided password is valid.");
        } else {
            setErrorMsg(password, "Password must have at least 1 Uppercase, Lower case, Number, and Symbol!");
            isValid=false;
        }
    }
    if (passwordVal === "") {
        console.log("Password is empty");
        setErrorMsg(cPassword, "Password cannot be empty");
        isValid=false;
    } else if (cPasswordVal === "") {
        console.log("Confirm Password is empty");
        setErrorMsg(cPassword, "Confirm Password cannot be empty");
        isValid=false;
    } else if (passwordVal !== cPasswordVal) {
        setErrorMsg(cPassword, "Passwords do not match");
        isValid=false;
    }
    else{
        setSuccessMsg(cPassword);
    }
        // validate gender
        const gender = document.querySelector('input[name="gender"]:checked');
        const genderError = document.getElementById('genderError');
        if (!gender) {
            setErrorMsg(genderError, "Please select a gender");
            isValid = false;
        } else {
            setSuccessMsg(genderError);
        } 
    return isValid;

};

function passwordVisibility() {
    const passwordInput = document.getElementById('password');
    const crossLine = document.querySelector('.cross-line');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        crossLine.style.display = 'none';
    } else {
        passwordInput.type = 'password';
        crossLine.style.display = 'block';
    }
}
function confirmPasswordVisibility() {
    const cPasswordInput = document.getElementById('cPassword');
    const crossLine = cPasswordInput.parentElement.querySelector('.cross-line');

    if (cPasswordInput.type === 'password') {
        cPasswordInput.type = 'text';
        crossLine.style.display = 'none';
    } else {
        cPasswordInput.type = 'password';
        crossLine.style.display = 'block';
    }
}
    function setErrorMsg(input,errorMsgs){
        const formControl=input.parentElement;
        const small=formControl.querySelector('small');
        formControl.className="form-control error";
        small.innerText=errorMsgs;
    }
    function setSuccessMsg(input){
        const formControl=input.parentElement;
        formControl.className="form-control success";
        
    }
    function closeForm(){
        const container=document.querySelector('.container');
        container.style.display='none';
        window.location.replace('login.html');
    }
    function resetForm() {
        var form = document.getElementById('form');
        var errorMessageElements = form.querySelectorAll('.form-control small');
        // Remove error classes and clear error messages
        errorMessageElements.forEach(function (element) {
        element.textContent = '';
        });
        // Reset the form
        form.reset();      
    }
   
  

   