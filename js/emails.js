let table;
let request_id; // matricule used in FETCH API when deleting or updating data (which row to update or delete)

$(document).ready(function() {
    
table = new DataTable('#emails', {
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
$('#emails').show();


let searchinput = document.getElementById("dt-search-0");


let td = document.querySelectorAll("table#emails tbody td");
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