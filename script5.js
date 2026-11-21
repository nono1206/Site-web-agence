document.addEventListener('DOMContentLoaded', function () {
    var themeBtn = document.getElementById('themeToggle');
    if (themeBtn) {
        themeBtn.addEventListener('click', function () {
            document.body.classList.toggle('bg-dark');
            document.body.classList.toggle('text-white');
        });
    }
});