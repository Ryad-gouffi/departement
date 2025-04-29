// ------------------------------ dropDown Menu

let select = document.querySelector(".dropdown .select");
let span = document.querySelector(".dropdown .select span");
let arrow = document.querySelector(".dropdown .arrow");
let options = document.querySelector(".dropdown ul");
let option = document.querySelectorAll(".dropdown ul li");
let hiddenvalue = document.getElementById("dropdownval");
hiddenvalue.value = 0;
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