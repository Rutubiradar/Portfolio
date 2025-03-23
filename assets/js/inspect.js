$(document).ready(function () {
    // Disable right-click
    $(document).on("contextmenu", function (e) {
        e.preventDefault();
    });

    // Disable F12, Ctrl+Shift+I, Ctrl+Shift+J, Ctrl+U
    $(document).on("keydown", function (e) {
        if (e.keyCode == 123 ||  // F12
            (e.ctrlKey && e.shiftKey && (e.keyCode == 73 || e.keyCode == 74)) || // Ctrl+Shift+I / Ctrl+Shift+J
            (e.ctrlKey && e.keyCode == 85) // Ctrl+U
        ) {
            return false;
        }
    });

    // Prevent DevTools detection
    setInterval(function () {
        if (window.outerHeight - window.innerHeight > 200 || window.outerWidth - window.innerWidth > 200) {
            document.body.innerHTML = "Inspecting is not allowed!";
        }
    }, 1000);
});

   // Detect Copy Action
            $(document).on("copy", function (e) {
                e.preventDefault();
                alert("🖕 Copying is not allowed!");
            });
      