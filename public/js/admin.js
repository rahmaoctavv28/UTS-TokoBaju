// Sidebar Toggle

const sidebar=document.getElementById("sidebar");

const toggle=document.getElementById("toggleSidebar");

toggle.addEventListener("click",()=>{

if(window.innerWidth<992){

sidebar.classList.toggle("show");

}else{

sidebar.classList.toggle("collapsed");

}

});

// Responsive

window.addEventListener("resize",()=>{

if(window.innerWidth>992){

sidebar.classList.remove("show");

}

});