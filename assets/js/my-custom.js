/* =========================================
   FOOTER SUBSCRIBE FORM ONLY
========================================= */

document.addEventListener("DOMContentLoaded", function () {

    const footerForm = document.getElementById("footerSubscribeForm");
    const messageBox = document.getElementById("footerMessage");

    if (!footerForm || !messageBox) return;

    footerForm.addEventListener("submit", function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        fetch(footerForm.action, {
            method: "POST",
            body: new FormData(footerForm),
            mode: "no-cors"
        });

        messageBox.innerHTML =
          "<span style='color:green;'> Thank you for subscribing!</span>";

        footerForm.reset();
    });

});
/* =========================================
   END FOOTER SUBSCRIBE FORM ONLY
========================================= */