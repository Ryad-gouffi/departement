const textarea = document.getElementById("postDesctiption");

textarea.addEventListener("input", () => {
textarea.style.height = "auto"; // reset height
textarea.style.height = (textarea.scrollHeight + 4) + "px"; // adjust height
});
const send = document.getElementById("addnews");
const form = document.getElementById("news");
send.addEventListener("click",()=>{
    if(!(textarea.value=="")){
        form.submit();
    }
})