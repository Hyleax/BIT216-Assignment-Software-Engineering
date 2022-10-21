const usernameInput = document.getElementById('username')
const fullnameInput = document.getElementById('fullname')
const phoneNumInput = document.getElementById('phoneNumber')
const occupationInput = document.getElementById('occupation')
const DOBinput = document.getElementById('birthdate')
const emailInput = document.getElementById('email')
const passwordInput = document.getElementById('password')
const confirmPasswordInput = document.getElementById('confirmPassword')
const errorMessageElements = document.querySelectorAll('#errorMsg');
const errorMessagesArray = [
    "this field cannot be left empty",
    "this birthdate makes you innelligible to volunteer",
    "email is invalid",
    "password is too weak",
    "passwords are not the same",
    "password is strong enough"
]




// function to test empty input on client side
const testEmptyInput = (inputName, index) => {
    if (inputName === ""){
        errorMessageElements[index].textContent = errorMessagesArray[0]
    }
    else {
        errorMessageElements[index].textContent = ""
    }
}

// function to test email validity on client side
const testEmailValid = (inputName, index) => {
    if (inputName.includes('@') && inputName.includes('.com')){
        errorMessageElements[index].textContent = ""
    }
    else {
        errorMessageElements[index].textContent = errorMessagesArray[2]
    }
}

// function to test password strength on client side
const testPasswordStrength = (inputName, index) => {
    if (inputName.length < 8){
        errorMessageElements[index].style.color = "red"
        errorMessageElements[index].textContent = errorMessagesArray[3]
    }
    else {
        errorMessageElements[index].style.color = "greenyellow"
        errorMessageElements[index].textContent = errorMessagesArray[5]
    }
}

const testBothPasswordSame = (passInput, confPassInput, index) => {
    if (passInput !== confPassInput){
        errorMessageElements[index].textContent = errorMessagesArray[4]
    }
    else {
        errorMessageElements[index].textContent = ""
    }
}


usernameInput.addEventListener('blur', () => {
    testEmptyInput(usernameInput.value, 0)
})

fullnameInput.addEventListener('blur', () => {
    testEmptyInput(fullnameInput.value, 1)
})

phoneNumInput.addEventListener('blur', () => {
    testEmptyInput(phoneNumInput.value, 2)
})

occupationInput.addEventListener('blur', () => {
    testEmptyInput(occupationInput.value, 3)
})

DOBinput.addEventListener('blur', () => {
    testEmptyInput(DOBinput.value, 4)
})

emailInput.addEventListener('blur', () => {
    testEmptyInput(emailInput.value, 5) 
    testEmailValid(emailInput.value, 5) 
})

passwordInput.addEventListener('blur', () => {
    testEmptyInput(passwordInput.value, 6) 
    testPasswordStrength(passwordInput.value, 6)  
})

confirmPasswordInput.addEventListener('blur', () => {
    testEmptyInput(confirmPasswordInput.value, 7) 
    testBothPasswordSame(passwordInput.value, confirmPasswordInput.value, 7)  
})



