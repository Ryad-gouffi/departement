document.addEventListener("DOMContentLoaded", function () {
    // Get the query parameter 'level' from the URL
    const params = new URLSearchParams(window.location.search);
    const level = params.get("level");
    
    let activeLi;
    if (level === 'all' || level == null) {
        activeLi = document.querySelector('#all'); // For the "ALL" button
    } else {
        activeLi = document.querySelector(`li[data-val="${level}"]`); // For other levels
    }
    if (activeLi) {
        document.querySelector('#all').classList.remove("bbtn");
        activeLi.classList.add('bbtn');
    }
});

const textarea = document.getElementById("postDesctiption");
if(textarea){

    textarea.addEventListener("input", () => {
        textarea.style.height = "auto";
        textarea.style.height = (textarea.scrollHeight + 4) + "px";
    });
    const send = document.getElementById("addnews");
    const form = document.getElementById("news");
    send.addEventListener("click",()=>{
        if(!(textarea.value=="")){
            form.submit();
        }
    })
    


let catval = document.getElementById("catval");
if(!catval){
    catval="";
}

let all = document.querySelector(".postNews #all");
if(all){


let categories = document.querySelectorAll(".postNews #categories li:not(#all)");
categories.forEach(Element=>{
    Element.addEventListener("click",()=>{
        if(Element.classList.contains("bbtn")){
            Element.classList.remove("bbtn");
        }
        else{
            Element.classList.add("bbtn");
            all.classList.remove("bbtn");
        }
        let selection = 0;
        let allselected = 0;
        categories.forEach(e=>{
            if(e.classList.contains("bbtn")){
                selection = 1;
                allselected++;
            }
        });
        if(!selection && !all.classList.contains("bbtn")){
            all.classList.add("bbtn");
        }
        if(allselected===5){
            catval.value = "all";
            all.classList.add("bbtn");
            categories.forEach(e=>{
                e.classList.remove("bbtn");
            });
        }
        let selected = document.querySelectorAll(".postNews #categories .bbtn");
        if(allselected!==5){
            catval.value = "";
            selected.forEach(s => {
                catval.value = (catval.value +" "+ s.dataset.val).trim("");
            });
        }
        if(selection===0){
            catval.value = "all";
        }
    }

)
})
all.addEventListener("click",()=>{
    all.classList.add("bbtn");
    catval.value = "all";
    categories.forEach(e=>{
        if(e.classList.contains("bbtn")){
            e.classList.remove("bbtn")
        }
    });
})
}
}



function deletenews(id) {
    let row = document.getElementById("news"+id);
    fetch("php/requests/delete_news.php?id=" + id)
    row.remove();
}