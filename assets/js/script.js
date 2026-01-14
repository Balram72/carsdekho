// CarsDekho Custom JavaScript

document.addEventListener('DOMContentLoaded', function() {

    // Form validation for inquiry form
    var inquiryForm = document.getElementById('inquiryForm');

    if(inquiryForm) {
        inquiryForm.addEventListener('submit', function(e) {
            var checkboxes = document.querySelectorAll('input[name="car_types[]"]:checked');

            if(checkboxes.length === 0) {
                e.preventDefault();
                alert('Please select at least one car type');
                return false;
            }

            // Phone number validation
            var phone = document.getElementById('phone').value;
            var phonePattern = /^[0-9]{10}$/;

            if(!phonePattern.test(phone.replace(/\s/g, ''))) {
                e.preventDefault();
                alert('Please enter a valid 10-digit phone number');
                return false;
            }
        });
    }

    // Add smooth scrolling to anchor links
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
        anchor.addEventListener('click', function(e) {
            var targetId = this.getAttribute('href');

            if(targetId !== '#') {
                e.preventDefault();
                var target = document.querySelector(targetId);

                if(target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });

    // Navbar scroll effect
    var navbar = document.querySelector('.navbar');

    if(navbar) {
        window.addEventListener('scroll', function() {
            if(window.scrollY > 50) {
                navbar.classList.add('shadow');
            } else {
                navbar.classList.remove('shadow');
            }
        });
    }

    // Car type checkbox styling
    var carTypeChecks = document.querySelectorAll('.car-type-check');

    carTypeChecks.forEach(function(check) {
        var input = check.querySelector('input');

        input.addEventListener('change', function() {
            if(this.checked) {
                check.style.borderColor = '#0d6efd';
                check.style.background = '#f0f7ff';
            } else {
                check.style.borderColor = '#e9ecef';
                check.style.background = 'transparent';
            }
        });
    });

});
