
let table;
let request_id; // matricule used in FETCH API when deleting or updating data (which row to update or delete)

$(document).ready(function() {
    
table = new DataTable('#tablerequest', {
    columnDefs:[
        {
            targets: [5,6,7], // Indexes of the columns to disable ordering (0-based)
            visible: false, // Disable ordering
            searchable: false
        }
    ],
    layout: {
        topStart: null,
        topEnd: {
            search: {
                placeholder: 'Type search here...',
                text: 'Search: <i class="fa-solid fa-magnifying-glass"></i>'
            }
        },
        bottomStart: {
            info: {
                text: '<span class="paging">_START_ - _END_</span> of _TOTAL_ records'
            }
        },
        topStart: {
            pageLength: {
                text: 'Page length : _MENU_'
            }
        },
        bottomEnd: {
            paging: {
                numbers: false,
                buttons: 3
            }
        }
    }
});
$('#tablerequest').show();


let searchinput = document.getElementById("dt-search-0");


let td = document.querySelectorAll("table#tablerequest tbody td");
searchinput.addEventListener("input",()=>{
    td.forEach(t => t.classList.remove("highlight"));
    if(searchinput.value!=""){
        td.forEach(t =>{
            if(t.textContent.toLowerCase().includes(searchinput.value.toLowerCase())){
                t.classList.add("highlight");
            };
        })
    }

});
searchinput.addEventListener("blur",()=>{
    td.forEach(t => t.classList.remove("highlight"));
});

} );


// ------------------------- delete Row button & Modal  
// first modal i used row.children[1] to get data from a row


let deletebtns = document.querySelectorAll("main #tablerequest tbody .fa-trash-can");
let fullname = document.getElementById("modal-row-fullname");

let row;
deletebtns.forEach(deletebtn=>{
    deletebtn.addEventListener("click",()=>{
        row = deletebtn.closest("tr");
        console.log(table.row(row).data()); // we can use datatables API to get data from row or we can use the method below ...
        request_id = row.dataset.requestId;
        const deletedrowname = row.children[1].textContent;
        const deletedrowsurname = row.children[2].textContent;
        const deletedrowtype = row.children[3].textContent;
        fullname.textContent = `${deletedrowname} ${deletedrowsurname}`;
        const type = document.createElement("span");
        type.textContent = " (" + deletedrowtype + ")";
        fullname.appendChild(type);
    })
})
// delete btn SEND DELETE REQUEST TO BACK END 
let modaldeletebtn = document.getElementById("modaldeletebtn");

modaldeletebtn.addEventListener("click",()=>{
    fetch("php/requests/delete_request.php?request_id=" + request_id)
    .then(res=>res.json())
    .then(data=>{
        console.log(data);
        // here i should add notifications based on the returned error code
        
    })
    row.remove();
    const modal = bootstrap.Modal.getInstance(document.getElementById("deleteRequest"));
    modal.hide();
})

// ---------------------- Edit row button & modal
// second modal i used datatables API to get data from a row
let editbtns = document.querySelectorAll("main #tablerequest tbody .fa-pen-to-square");
let editInputMatricule = document.getElementById("editInputMatricule");
let editInputName = document.getElementById("editInputName");
let editInputType = document.getElementById("editInputType");
let editInputEmail = document.getElementById("editInputEmail");
let editObservation = document.getElementById("editObservation");
let editInputPhone = document.getElementById("editInputPhone");

let editSelectOption = document.getElementById("editSelectOption");
let option1 = editSelectOption.querySelector("option[value=\"1\"]");
let option2 = editSelectOption.querySelector("option[value=\"2\"]");
let option3 = editSelectOption.querySelector("option[value=\"3\"]");

let editrow;

editbtns.forEach(editbtn=>{
    editbtn.addEventListener("click",()=>{
        editrow = editbtn.closest("tr");
        console.log(table.row(editrow).data());
        request_id = editrow.dataset.requestId;
        let email = table.row(editrow).data()[5]; // i used datatables API .data() that gets data from a specific row in table
        let phone = table.row(editrow).data()[6];
        let observation = table.row(editrow).data()[7];
        editInputMatricule.value = table.row(editrow).data()[0];
        editInputName.value = table.row(editrow).data()[1];
        editInputType.value = table.row(editrow).data()[3];
        editInputEmail.value = email;
        editInputPhone.value = phone;
        editObservation.value = observation;

        // select option default Option is based on the Statu of the row
        console.log(editrow.children[6]);

        if(editrow.children[6].classList.contains("text-success")){
            editSelectOption.value = 1
        }
        else if(editrow.children[6].classList.contains("text-danger")){
            optionx = editSelectOption.querySelector("option[value=\"3\"]");
            editSelectOption.value = 3
        }
        else{
            optionx =editSelectOption.querySelector("option[value=\"2\"]");
            editSelectOption.value = 2
        }
    })
})


// update button SEND DATA TO BACK END TO UPDATE THE DATABASE
let modalupdatebtn = document.getElementById("modalupdatebtn");


modalupdatebtn.addEventListener("click",()=>{
    console.log(editrow.children[6].innerHTML);
    
    editrow.children[6].classList.remove("text-success");
    editrow.children[6].classList.remove("text-danger");
    switch (editSelectOption.value) {
        case "1":
            editrow.children[6].innerHTML = `<i class=' fa-solid fa-circle-check'></i><span>ready</span>`;
            editrow.children[6].classList.add("text-success");
            break;
        case "2":
            editrow.children[6].innerHTML = `<i class=\" fa-solid fa-arrows-rotate\"></i><span>in process</span>`;
            break;
        case "3":
            editrow.children[6].innerHTML = `<i class=\" fa-solid fa-circle-xmark\"></i></i><span>refused</span>`;
            editrow.children[6].classList.add("text-danger");
            break;
    
        default:
            break;
    }
    const data={
        id:request_id,
        observation:editObservation.value,
        statu:editSelectOption.value,
        type:editInputType.value,
        mail:editInputEmail.value
    }
    console.log(editInputEmail.value);
    
    fetch("php/requests/update_request.php",{
        method:"POST",
        headers:{
            "Content-Type":"application/json",
        },
        body: JSON.stringify(data)
    })
    .then(resp=>resp.json())
    .then(data=>{
        console.log(data);
    })

    const modal = bootstrap.Modal.getInstance(document.getElementById("editRequest"));
    modal.hide();
})


// dark and light theme

let sun = document.getElementById("sun");
let moon = document.getElementById("moon");
let body = document.querySelector("body");
let sidemenu = document.getElementById("side-menu");
let container = document.querySelector("main");


function getThemeFromCookie() {
    const cookies = document.cookie.split(';');
    for (let cookie of cookies) {
        if (cookie.trim().startsWith('theme=')) {
            return cookie.trim().substring('theme='.length);
        }
    }
    return 'dark'; // default is dark
}

function applyTheme(theme) {
    if (theme === 'light') {
        document.body.classList.add('light');
        sidemenu.classList.add("light")
        container.classList.add("light");
    } else {
        document.body.classList.remove('light');
        sidemenu.classList.remove('light');
        container.classList.remove("light");
    }
}

function toggleTheme() {
    const currentTheme = getThemeFromCookie();
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    applyTheme(newTheme);
    document.cookie = "theme=" + newTheme + "; path=/; max-age=" + 60*60*24*365; // Cookie lasts for 1 year
}

document.addEventListener('DOMContentLoaded', () => {
    const theme = getThemeFromCookie();
    applyTheme(theme);
});




sun.addEventListener("click",()=>{
    toggleTheme();
    sun.classList.remove("active");
    moon.classList.add("active");
})
moon.addEventListener("click",()=>{
    toggleTheme();
    moon.classList.remove("active");
    sun.classList.add("active");
})