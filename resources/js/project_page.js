document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.more_info_btn');
    const contentSections = document.querySelectorAll('.more_info_content');

    function hideAllContent() {
        contentSections.forEach(section => {
            section.style.display = 'none';
        });
    }

    function removeSelectedClass() {
        buttons.forEach(btn => {
            btn.classList.remove('selected');
            btn.classList.add('white_bg');
        });
    }

    buttons.forEach(button => {
        button.addEventListener('click', function () {
            removeSelectedClass();
            button.classList.add('selected');
            button.classList.remove('white_bg');

            hideAllContent();

            const category = button.getAttribute('data-category');
            const contentToShow = document.getElementById(`${category}_content`);
            if (contentToShow) {
                contentToShow.style.display = 'block';
            }
        });
    });
});


