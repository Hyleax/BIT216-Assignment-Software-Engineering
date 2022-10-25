const initialContainer = document.getElementById('initial-form-container')
const tutOptionContainer = document.querySelector('.cont-1')
const resourceOptionContainer = document.querySelector('.cont-2')
const requestContainer = document.querySelector('.request-container')
const backtoInitialContainerBtn = document.getElementById('backtoInitialContainerBtn')
const tutorialContentContainer = document.querySelector('.tutorial-content-container')
const resourceContentContainer = document.querySelector('.resource-content-container')
const reqText = document.querySelector('.reqText')
const errorMessagesArray = [
    "this field cannot be left empty",
    "This is not a valid tutorial date",
    "Please give a more detailed description (at least 20 characters)",
    "This is not a valid number",
    "Please schedule a session at least 3 days in advance"
]
let errorMessageElements;



// inputs for TUTORIAL request
const tutDescription = document.getElementById('tutorial-description')
const tutTime = document.getElementById('tutorial-time')
const studentLevel = document.getElementById('student-level')
const noOfStudents = document.getElementById('no-of-students')

// inputs for RESOURCE request
const resourceDesc = document.getElementById('resource-description')
const resourceType = document.getElementById('resource-type')
const noOfResources = document.getElementById('number-of-resources')

// VALIDATION FUNCTIONS FOR SUBMITTING REQUEST

// function to test empty input on client side
const testEmptyInput = (inputName, index) => {
    if (inputName === ""){
        errorMessageElements[index].textContent = errorMessagesArray[0]
    }
    else {
        errorMessageElements[index].textContent = ""
    }
}

// function to test if description is long enough
const testDescriptionLongEnough = (inputName, index) => {
    if (inputName.length < 20){
        errorMessageElements[index].textContent = errorMessagesArray[2]
    }
    else {
        errorMessageElements[index].textContent = ""
    }
}

// function to test if tutorial time is valid 
const testTutorialTimeValid = (inputName, index) => {
    
    //convert user input date from string to Date
    let inputtedDate = new Date(inputName)

    // get current system Date
    let todaysDate = new Date()
    let timeLeft = inputtedDate - todaysDate
    if (timeLeft <= 0){
        errorMessageElements[index].textContent = errorMessagesArray[1]
    }

    // cannot book tutorial session any earlier than 3 days in advance
    else if (timeLeft <=  86400000 * 3){
        errorMessageElements[index].textContent = errorMessagesArray[4]
    }

    else {
        errorMessageElements[index].textContent = ""
    }
}

// function to test if a no. expected students is a valid number
const testValidNumber = (inputName, index) => {
    if (!(parseInt(inputName))){
        errorMessageElements[index].textContent = errorMessagesArray[3]
    }
    else {
        errorMessageElements[index].textContent = ""
    }
}


// onBlur event listeners for all inputs in submitRequest
tutDescription.addEventListener('blur', () => {
    testEmptyInput(tutDescription.value, 0)
    testDescriptionLongEnough(tutDescription.value, 0)
})

tutTime.addEventListener('blur', () => {
    testTutorialTimeValid(tutTime.value, 1)
})

studentLevel.addEventListener('blur', () => {
    testEmptyInput(tutDescription.value, 2)
})

noOfStudents.addEventListener('blur', () => {
    testValidNumber(noOfStudents.value, 3)
})

resourceDesc.addEventListener('blur', () => {
    testEmptyInput(resourceDesc.value, 4)
    testDescriptionLongEnough(resourceDesc.value, 4)
})

resourceType.addEventListener('blur', () => {
    testEmptyInput(resourceType.value, 5)
})

noOfResources.addEventListener('blur', () => {
    testValidNumber(noOfResources.value, 6)
})


backtoInitialContainerBtn.addEventListener('click', (event) => {
    event.preventDefault();
    tutOptionContainer.parentElement.style.display = "block";
    resourceOptionContainer.parentElement.style.display = "block";
    requestContainer.style.display = "none"
    reqText.textContent = "Select a Request Type"
})

tutOptionContainer.addEventListener('click', () => {
    tutOptionContainer.parentElement.style.display = "none";
    resourceOptionContainer.parentElement.style.display = "none";
    requestContainer.style.display = "block"
    tutorialContentContainer.style.display = "block"
    resourceContentContainer.style.display = "none"
    reqText.textContent = "Details for the Tutorial Request"
    errorMessageElements = document.querySelectorAll('#errorMsg')
})


resourceOptionContainer.addEventListener('click', () => {
    tutOptionContainer.parentElement.style.display = "none";
    resourceOptionContainer.parentElement.style.display = "none";
    requestContainer.style.display = "block"
    tutorialContentContainer.style.display = "none"
    resourceContentContainer.style.display = "block"
    reqText.textContent = "Details for the Resource Request"
    errorMessageElements = document.querySelectorAll('#errorMsg')
})
