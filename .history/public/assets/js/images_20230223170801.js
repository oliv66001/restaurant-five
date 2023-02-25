$let links = document.querySelectorAll('[data-delete]');


$links.forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        let choice = confirm(this.getAttribute('data-confirm'));

        if (choice) {
            document.getElementById('delete-form').submit();
        }
    });
});