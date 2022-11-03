// initializing variables
const requestContainer = document.querySelector('.request-container')

// initializing sort buttons
const sortSchoolBtn = document.getElementById('sortSchoolBtn')
const sortCityBtn = document.getElementById('sortCityBtn')
const sortReqDateBtn = document.getElementById('sortReqDateBtn')
const sortText = document.getElementById('sortText')

// initializing search bar variables
const searchBar = document.getElementById('searchBar')
let data;
const requestsArray = []

// fetch viewRequest data from PHP file
fetch(`includes/viewRequests.inc.php`)
.then(res => res.json())
.then(requests => {
    requests.forEach((req) =>{
    requestsArray.push(req)
    renderRequests(requests)
    })
})

// SEARCH BAR FUNCTION
const searchDescription = (searchBarText) => {
    const newArray = []
    sortText.innerHTML = ""
    requestsArray.forEach((req) => {

        // see if description matches user search text
        if (req.description.toLowerCase().includes(searchBarText)){
            newArray.push(req)
        }

        // search by tutorial request type
        else if ("tutorial".includes(searchBarText)){
            if ('studentLevel' in req){
                newArray.push(req)
            }
        }

        // search by resource request type
        else if ("resource".includes(searchBarText)){
            if ('resourceType' in req){
                newArray.push(req)
            }
        }

        // see if school name matches user search text
        else if (req.schoolName.toLowerCase().includes(searchBarText)){
            newArray.push(req)
        }

        // see if city name matches user search text
        else if (req.city.toLowerCase().includes(searchBarText)){
            newArray.push(req)
        }

        // see if request date matches user search text
        else if (req.requestDate.includes(searchBarText)){
            newArray.push(req)
        }
        renderRequests(newArray)
    })
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
    sortText.innerHTML = `<span class = "text-primary">School</span>`
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
    sortText.innerHTML = `<span class = "text-success">City</span>`
    renderRequests(combinedRequestsData)
}

// sort requests by Request date
const sortByReqDate = (combinedRequestsData) => {
    combinedRequestsData.sort((a, b)=> new Date(a.requestDate) - new Date(b.requestDate))
    requestContainer.innerHTML = "";
    sortText.innerHTML = `<span class = "text-danger">Request Date</span>`
    renderRequests(combinedRequestsData)
}


const renderRequests = (combinedRequestsData) => {

    if (combinedRequestsData.length === 0){
        requestContainer.innerHTML = "<i>there are no results...</i>"
        requestContainer.classList.add('h2')
        requestContainer.classList.add('text-center')
        requestContainer.classList.add('mt-5')
    }

    else {
        requestContainer.classList.remove('h2')
        requestContainer.classList.remove('text-center')
        requestContainer.classList.remove('mt-5')
        requestContainer.innerHTML = ""
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
                    <p>${'resourceType' in request ? '' : 'Tutorial Date:'}<b class = "text-success"> ${'resourceType' in request ? '' : request.tutorialDate}</b></p>
                    <p>${'resourceType' in request ? 'Resource Type' : 'Student Level'}: <b class = "text-success">${'resourceType' in request ? request.resourceType : request.studentLevel}</b></p>
                    <p>${'resourceType' in request ? 'Required No. of devices' : 'Number of students'}: <b class = "text-success">${'resourceType' in request ? request.requireNum : request.studentNum}</b></p>
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
}


sortSchoolBtn.addEventListener('click', () => {
    sortBySchool(requestsArray)
})
sortCityBtn.addEventListener('click', () => {
    sortByCity(requestsArray)
})
sortReqDateBtn.addEventListener('click', () => {
    sortByReqDate(requestsArray)
})

searchBar.addEventListener('input', () => searchDescription(searchBar.value.toLowerCase()))