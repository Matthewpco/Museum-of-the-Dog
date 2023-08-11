document.addEventListener("DOMContentLoaded", function() {

    let body = document.querySelector('body');
    let close = document.querySelector('.close');
    let mobileNavToggle = document.querySelector('#mobile-nav-toggle');
    let modalWrapper = document.querySelector('.mobile-modal-wrapper')
    let navDropDown = document.querySelectorAll('.mobile-modal-content-menu .mobile-has-submenu');
    let clickableLinks = document.querySelectorAll('.mobile-submenu a');

    // stop function from bubbling up when a links clicked inside nav drop down
    if (clickableLinks) {
        clickableLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.stopPropagation();
            })
        })
    }

    // when mobile nav toggle is clicked remove hidden clase from mobile modal wrapper
    if (mobileNavToggle) {
        mobileNavToggle.addEventListener('click', function() {
            modalWrapper.classList.toggle("hidden");
            body.classList.toggle("modal-open");
        })
    }
    
    // close modal by re-applying hidden to modal wrapper
    if (close) {
        close.addEventListener('click', function() {
            modalWrapper.classList.toggle("hidden");
            body.classList.toggle("modal-open");
        });
    }

    // When the user clicks anywhere outside of the modal, close it
    window.addEventListener('click', function(e) {
        if (e.target == modalWrapper) {
            modalWrapper.classList.toggle("hidden");
            body.classList.toggle("modal-open");
        }
    })

    // Check if the elements exist
    if (navDropDown) {
        navDropDown.forEach((e) => {
            e.addEventListener('click', function() {
                e.classList.toggle("nav-active");
                toggleOpen.call(e);
            })
        })
    }

    // Define a function to handle clicks on li elements
    function toggleOpen() {
        // Find the ul.mobile-submenu element within the clicked li element
        let ulElement = this.querySelector('ul.mobile-submenu');
        // Toggle the open class on the ul element
        ulElement.classList.toggle('open');
    }

});