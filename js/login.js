let login_buttons = document.getElementsByClassName("custom-btn btn-11 Login");

for (let iterable = 0; iterable < login_buttons.length; iterable++) {
    login_buttons[iterable].addEventListener("click", ()=>{
        location.href = "php/automatic_session.php?username=" + login_buttons[iterable].textContent;
    });
}