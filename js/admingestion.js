let lis = document.querySelectorAll("#managementul li");
let pages = document.querySelectorAll(".parent .output .page");
lis.forEach(li=>{
    li.addEventListener("click",()=>{
        lis.forEach(cli=>{
            cli.classList.remove("active");
        })
        pages.forEach(page=>{
            page.classList.remove("active");
        })
        li.classList.add("active");
        let target = document.getElementById(li.dataset.page);
        target.classList.add("active");
    })
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

// ------------------------------ Delete Button Modal
let targetrow;
let request_id;
let deletebuttons = document.querySelectorAll("#page2 i.fa-trash-can");
let confirmdeletebtn = document.getElementById("modaldeletebtn");
deletebuttons.forEach(deletebtn=>{
    deletebtn.addEventListener("click",()=>{
        targetrow = deletebtn.closest(".admin");
        let email = targetrow.querySelector(".admin-email").textContent;
        request_id = email;
    })
})

confirmdeletebtn.addEventListener("click",()=>{
    fetch("php/requests/delete_admin.php?request_id=" + request_id)
    .then(res=>res.json())
    .then(data=>{
        console.log(data);
        // here i should add notifications based on the returned error code
        
    })
    targetrow.remove();
    const modal = bootstrap.Modal.getInstance(document.getElementById("deleteRequest"));
    modal.hide();
})