$(document).ready(function () {
    sideBar();
    toTop();
});

function sideBar() {
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#btn");

    closeBtn.addEventListener("click", () => {
        sidebar.classList.toggle("open");
    });
}

function toTop() {
    var $mybutton = $("#backToTop");

    $(window).scroll(function () {
        if ($(this).scrollTop() > 20) {
            $mybutton.fadeIn();
        } else {
            $mybutton.fadeOut();
        }
    });

    $mybutton.click(function () {
        $("html, body").animate({ scrollTop: 0 }, "fast");
    });
}
