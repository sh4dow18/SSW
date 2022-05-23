let series_button = document.getElementById("Series");
let movies_button = document.getElementById("Movies");
let stand_up_button = document.getElementById("Stand_Up");

series_button.addEventListener("click", ()=>{
    location.href = "series.php";
});
movies_button.addEventListener("click", ()=>{
    location.href = "movies.php";
});
stand_up_button.addEventListener("click", ()=>{
    location.href = "stand_up.php";
});