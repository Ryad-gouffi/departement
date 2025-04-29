// ------------------------------ body pages tabs
const tabs = document.querySelectorAll('.tab');

tabs.forEach(tab=>{

tab.addEventListener("click",()=>{
    tabs.forEach(tab=>{
        tab.classList.remove("active");
    })
    const pages = document.querySelectorAll("main .container .page");
    pages.forEach(page=>{
        page.classList.remove("active");
    })
    console.log(tab.dataset.tab);
    const target = document.getElementById(tab.dataset.tab);
    tab.classList.add("active");
    target.classList.add("active");
});
})

// ------------------------------ dropDown Menu

let select = document.querySelector(".dropdown .select");
let span = document.querySelector(".dropdown .select span");
let arrow = document.querySelector(".dropdown .arrow");
let options = document.querySelector(".dropdown ul");
let option = document.querySelectorAll(".dropdown ul li");
let hiddenvalue = document.getElementById("dropdownval");
hiddenvalue.value = option[0].dataset.val;
console.log(option);
select.addEventListener("click",()=>{
    select.classList.toggle("open");
    options.classList.toggle("open-menu");
    arrow.classList.toggle("rotate");
    option.forEach(op => {
        op.addEventListener("click",()=>{
            hiddenvalue.value = op.dataset.val;
            span.textContent = op.textContent;
            select.classList.remove("open");
            options.classList.remove("open-menu");
            arrow.classList.remove("rotate");
            option.forEach(opt => {
                opt.classList.remove("active");
            })
            op.classList.add("active");
        })
    });
})
document.addEventListener("click",(event)=>{
    if(!event.target.closest(".dropdown")){
        options.classList.remove("open-menu");
        select.classList.remove("open");
    }
})


// ----------------------------- input label animation

let inputs = document.querySelectorAll("main .container .data .matriculedata input");
inputs.forEach(input => {
    let placeholder = input.getAttribute("placeholder");

    input.addEventListener("focus",()=>{
        input.setAttribute("placeholder","");
    })

    input.addEventListener("blur",()=>{
        if(input.value === ""){
            input.classList.remove("active");
            input.setAttribute("placeholder",placeholder);
        }
        else{
            input.classList.add("active");
        }
    })

});

// ------------------------------ toggler ON OFF urgent

let toggler = document.getElementById("toggler");
let date = document.getElementById("urgentdate");
let urgent = document.getElementById("urgent");
toggler.addEventListener("click",()=>{
    toggler.classList.toggle("active");
    date.classList.toggle("active");
    if(toggler.classList.contains("active")){
        urgent.value = "1";
    }
    else{
        urgent.value = "0";
    }
})
// ------------------------------ Default Date Now

let today = new Date();
let year = today.getFullYear();
let month = String(today.getMonth() + 1).padStart(2, '0'); // so if the month is 7, it will be 07 not 7
let day = String(today.getDate()).padStart(2, '0');
document.getElementById("urgentdate").value = `${year}-${month}-${day}`;

// ------------------------------ Delete Button Modal
let targetrow;
let request_id;
let deletebuttons = document.querySelectorAll("main .container .page2 tbody i.fa-trash-can");
let deletetype = document.getElementById("modal-row-fullname");
let confirmdeletebtn = document.getElementById("modaldeletebtn");
deletebuttons.forEach(deletebtn=>{
    deletebtn.addEventListener("click",()=>{
        targetrow = deletebtn.closest("tr");
        request_id = targetrow.dataset.requestId;
        deletetype.textContent = targetrow.children[0].textContent;
        
    })
})

confirmdeletebtn.addEventListener("click",()=>{
    fetch("php/requests/delete_request.php?request_id=" + request_id)
    .then(res=>res.json())
    .then(data=>{
        console.log(data);
        // here i should add notifications based on the returned error code
        
    })
    targetrow.remove();
    const modal = bootstrap.Modal.getInstance(document.getElementById("deleteRequest"));
    modal.hide();
})