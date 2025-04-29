let dropdown = document.querySelectorAll(".side-menu nav a.extend");
console.log(dropdown);

dropdown.forEach(dropdownE => {
    dropdownE.addEventListener("click",()=>{
        
        let target = document.getElementById(dropdownE.dataset.val);
        console.log(target);
        dropdownE.classList.toggle("rotate");
        target.classList.toggle("extends")
        
    })
});

let minimize = document.getElementById("minimize");
minimize.addEventListener("click",()=>{
    const sidemenu = document.getElementById("side-menu");
    const submenu = document.getElementById("requests");
    if(!sidemenu.classList.contains("close")){
        submenu.classList.remove("extends")
    }
    sidemenu.classList.toggle("close");
})