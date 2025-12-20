const menuToogle = $('#menuToggle');
const navbarMenu = $('.navbar-menu');
const closeAlert = $("#closeAlert");

const logout = document.getElementById("logout");
const password = document.getElementById("password");
const showPassword = document.getElementById("showPassword");

const avatar = $("#avatar");
const uploadedFile = $("#uploadedFile");

const categoryToggle = $('#categoryToggle');
const categoryOptions = $('#categoryOptions');
const categoryId = $('#category_id');
const categorySelected = $('#categorySelected');

$(document).ready(function() {
	// Toggle nav items.
	menuToogle.click(function() {
		navbarMenu.toggleClass('show');
	});

	// Show logout alert.
	if(logout !== null) {
		logout.click(function() {
			return confirm('Anda yakin ingin logout?');
		});
	}

	// Close alerts.
	closeAlert.click(function() {
		closeAlert.parent().hide();
	});

	// Show password text.
	if(showPassword !== null) {
		showPassword.addEventListener('click', function() {
			if (password.type === "password") {
				password.type = "text";
			} else {
				password.type = "password";
			}
		});
	}

	// Show uploaded file.
	avatar.change(function() {
		const [file] = this.files;
		if(file) {
			uploadedFile.attr('src', URL.createObjectURL(file));
		}
	});
    
    // Custom select input for categories.
    if (categoryToggle.length && categoryOptions.length && categoryId.length) {
        categoryToggle.on('click', function(e) {
            e.stopPropagation();
            const isOpen = categoryOptions.toggleClass('show').hasClass('show'); 
            categoryToggle.attr('aria-expanded', isOpen ? 'true' : 'false');
        });

        categoryOptions.on('click', 'li[data-value]', function(e) {
            const li = $(this);
            const val = li.data('value');
            const text = li.text().trim();

            categoryId.val(val);
            categorySelected.text(text);
        
            categoryOptions.children().removeClass('selected');
            li.addClass('selected');

            categoryOptions.removeClass('show');
            categoryToggle.attr('aria-expanded', 'false');
        });

        $(document).on('click', function(e) {
            if (!categoryOptions.is(e.target) && !categoryOptions.has(e.target).length && !categoryToggle.is(e.target)) {
                if (categoryOptions.hasClass('show')) {
                    categoryOptions.removeClass('show');
                    categoryToggle.attr('aria-expanded', 'false');
                }
            }
        });

        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && categoryOptions.hasClass('show')) {
                categoryOptions.removeClass('show');
                categoryToggle.attr('aria-expanded', 'false');
            }
        });
    }
});