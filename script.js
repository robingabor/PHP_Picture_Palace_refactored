const toggle = document.getElementById("toggle");
const close = document.getElementById("close");
const open = document.getElementById("open");
const modal = document.getElementById("modal");
const modalContainer = document.getElementById("modal-container");




// Toggle nav
toggle.addEventListener("click",(e)=>{
    document.body.classList.toggle("show-nav");
});

// Show modal when clicking the Sign Up button
open.addEventListener("click",()=>{
    // modalContainer.style.display = "block";
    modalContainer.classList.add("show-modal");
});

// Hide modal
close.addEventListener("click",()=>{
    // modalContainer.style.display = "none";
    modalContainer.classList.remove("show-modal");
});


// Hide modal on outside click
window.addEventListener('click', e =>
    e.target == modalContainer ? modalContainer.classList.remove("show-modal") : false
);