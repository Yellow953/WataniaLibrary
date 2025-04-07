document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.getElementById('toggleButton');
    const filterCollapse = document.getElementById('filterCollapse');

    filterCollapse.addEventListener('show.bs.collapse', function () {
        toggleButton.style.display = 'none';
    });

    filterCollapse.addEventListener('hide.bs.collapse', function () {
        toggleButton.style.display = 'block';
    });
});