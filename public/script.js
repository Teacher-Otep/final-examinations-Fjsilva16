//function to show selected section
function showSection(sectionID) {
    const sections = document.querySelectorAll('.content, .homecontent');

    sections.forEach(section => {
        section.style.display = 'none';
    });

    const activeSection = document.getElementById(sectionID);
    if (activeSection) {
        activeSection.style.display = 'block';
    }
}

// Initial state and event listeners
document.addEventListener('DOMContentLoaded', function () {
    // Initially show only the home section
    showSection('home');

    // Handle URL parameters for success toast
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('status') === 'success') {
        const toast = document.getElementById('success-toast');
        if (toast) {
            toast.classList.remove('toast-hidden');
            toast.style.display = 'block';
            toast.style.opacity = '1';

            // Hide it automatically after 3 seconds
            setTimeout(() => {
                toast.style.opacity = '0';
                setTimeout(() => {
                    toast.classList.add('toast-hidden');
                    toast.style.display = 'none';
                }, 500);
            }, 3000);
        }

        // Clean the URL
        window.history.replaceState({}, document.title, window.location.pathname);
    }

    // Clear fields function
    const clrbtn = document.getElementById('clrbtn');
    if (clrbtn) {
        clrbtn.addEventListener('click', function (e) {
            e.preventDefault();
            const inputs = document.querySelectorAll('input.field');
            inputs.forEach(input => {
                input.value = '';
            });
            // Also clear select dropdowns
            const selects = document.querySelectorAll('select.field');
            selects.forEach(select => {
                select.selectedIndex = 0;
            });
        });
    }
});
