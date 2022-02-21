let i = 0;
document.querySelector("body").innerHTML += `<div class="sidenav-backdrop"></div>`;
document.querySelector("#toggle").addEventListener("click", () => navEspand());
backdrop = document.querySelector(".sidenav-backdrop");
backdrop.addEventListener("click",()=> navEspand());
// sidenav = document.querySelector("#sidenav-1");
// sidenav.addEventListener("click",()=> navEspand());
// document.querySelector("#sidenav-1").addEventListener("click", () => navEspand());
function navEspand() {
    if(i == 0 ){
        document.querySelector("#sidenav-1").classList = "sidenav sidenav-primary ps";
        document.querySelector("#sidenav-1").style = "width: 240px; height: 100vh; position: fixed; transition: all 0.3s linear 0s; transform: translateX(0%);";
        document.querySelector(".sidenav-backdrop").style= "transition: opacity 0.3s ease-out 0s;position: fixed; width: 100vw; height: 100vh; opacity: 1;";
        i = 1;
    }
    else{
        document.querySelector("#sidenav-1").classList = "sidenav";
        document.querySelector("#sidenav-1").style = "";
        document.querySelector(".sidenav-backdrop").style= "";
        i = 0;
    }
}
