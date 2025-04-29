let show = document.getElementById("show");
let pass = document.getElementById("password");
show.addEventListener("click",()=>{
    if(pass.getAttribute("type")==="password"){
        pass.setAttribute("type","text");
        show.classList.add("show");
    }
    else{
        pass.setAttribute("type","password");
        show.classList.remove("show");
    }
})
// dark and light theme

let sun = document.getElementById("sun");
let moon = document.getElementById("moon");
let body = document.querySelector("body");
let container = document.querySelector(".containerform");


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
        container.classList.add("light");
    } else {
        document.body.classList.remove('light');
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