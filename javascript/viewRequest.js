// initializing variables
const requestContainer = document.querySelector('.request-container')

// initializing sort buttons
const sortSchoolBtn = document.getElementById('sortSchoolBtn')
const sortCityBtn = document.getElementById('sortCityBtn')
const sortReqDateBtn = document.getElementById('sortReqDateBtn')

// initializing search bar variables
const searchBtn = document.getElementById('searchBtn')
const searchBar = document.getElementById('searchBar')


// call AJAX
let ajax = new XMLHttpRequest();
let method = "GET";
let url = "includes/viewRequests.inc.php";
let async = true;
ajax.open(method, url, true);

// sending ajax request
ajax.send();

// receiving response from viewRequests.inc.php
ajax.onreadystatechange = function() {
    if (this.readyState == 4  && this.status == 200){
        // converting JSON back to array
        let combinedRequestsData = JSON.parse(this.responseText)

        // display all request cards in viewRequests.html
        renderRequests(combinedRequestsData)
        // sortSchoolBtn.addEventListener('click', sortBySchool(combinedRequestsData))
        // sortCityBtn.addEventListener('click', sortByCity(combinedRequestsData))
        // sortReqDateBtn.addEventListener('click', sortByReqDate(combinedRequestsData))
    }
    

}


// SORTING FUNCTIONS

// sort requests by school
const sortBySchool = (combinedRequestsData) => {
    combinedRequestsData.sort((a, b)=> {
        if (a.schoolName > b.schoolName) return 1;
        if (a.schoolName < b.schoolName) return -1;
        return 0;
    })
    console.log("school sorted");
    requestContainer.innerHTML = "";
    renderRequests(combinedRequestsData)
}

// sort requests by city
const sortByCity = (combinedRequestsData) => {
    combinedRequestsData.sort((a, b)=> {
        if (a.city > b.city) return 1;
        if (a.city < b.city) return -1;
        return 0;
    })
    console.log("city sorted");
    requestContainer.innerHTML = "";
    renderRequests(combinedRequestsData)
}

// sort requests by Request date
const sortByReqDate = (combinedRequestsData) => {
    combinedRequestsData.sort((a, b)=> new Date(a.requestDate) - new Date(b.requestDate))
    requestContainer.innerHTML = "";
    renderRequests(combinedRequestsData)
}


const renderRequests = (combinedRequestsData) => {
    
    let modalNum = 0;
    let rowCount = 0;
    let newRow;
    combinedRequestsData.forEach(request => {

        //check if new row needs to be created
        if (rowCount == 0){
            newRow = document.createElement('div');
            newRow.classList.add('row')
            newRow.classList.add('d-flex')
            newRow.classList.add('justify-content-center')
            requestContainer.appendChild(newRow)
        }

        //create new column
        newCol = document.createElement('div')
        newCol.classList.add('col-lg-3')
        newCol.classList.add('col-md-6')
        newCol.classList.add('col-sm-6')
        newCol.classList.add('mt-3')
        newCol.classList.add('mb-3')

            newCol.innerHTML = 
            `
                <div class="card" style="width: 20rem;">
                <img src="${'resourceType' in request ? 'images/devices.JPG' : 'images/tutoring.JPG'}" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title">${'resourceType' in request ? 'Resource Request':'Tutorial Request'}</h5>
                <p class="card-text">${request.description}.</p>
                <div class="row text-center">
                    <div class="col-sm-6">
                        <p class="card-text">School: <b>${request.schoolName}</b></p>
                    </div>
                    <div class="col-sm-6">
                        <p class="card-text">City: <b>${request.city}</b></p>
                    </div>
                </div>
                <p class="card-text text-center mt-2">Request Date: <b>${request.requestDate}</b></p>
                <div class="text-center">
                    <a href="#" class="btn btn-success bg-success text-center" data-bs-toggle="modal" data-bs-target="#modal${modalNum}">View Details</a>
                </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modal${modalNum}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">${'resourceType' in request ? 'Resource Request':'Tutorial Request'}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <p>${'resourceType' in request ? '' : 'Tutorial Date:'} ${'resourceType' in request ? '' : request.tutorialDate}</p>
                    <p>${'resourceType' in request ? 'Resource Type' : 'Student Level'}: ${'resourceType' in request ? request.resourceType : request.studentLevel}</p>
                    <p>${'resourceType' in request ? 'Required No. of devices' : 'Number of students'}: ${'resourceType' in request ? request.requireNum : request.studentNum}</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    
                    <form method = "POST" action = "SubmitOffer.php">
                        <input id = "reqTypeSelector" type="text" name= "requestType" value = "${request.requestID}" hidden>
                        <button name = "submitOfferBtn" type="submit" class="btn btn-success">Submit Offer</button>
                    </form>
                    </div>
                </div>
                </div>
            </div>
            `

            newRow.appendChild(newCol)



        // increment rowCount
        rowCount++;

        // increment modalCount
        modalNum++;
    });
}









