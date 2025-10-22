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
const categoryId = $('#categoryId');
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
    
    // Custom select input
    if (categoryToggle.length && categoryOptions.length && categoryId.length) {
        categoryToggle.on('click', function(e) {
            // Mencegah event menyebar ke elemen lain
            e.stopPropagation();
            // .toggleClass('show') akan mengembalikan objek jQuery,
            // jadi kita perlu memeriksa apakah kelas 'show' ada setelah toggle
            const isOpen = $options.toggleClass('show').hasClass('show'); 
            $toggle.attr('aria-expanded', isOpen ? 'true' : 'false');
        });

        // 2. Event 'click' pada options untuk memilih item
        // Menggunakan delegasi event untuk hanya menangani klik pada li[data-value]
        $options.on('click', 'li[data-value]', function(e) {
            // 'this' mengacu pada elemen li[data-value] yang diklik
            const $li = $(this);
            const val = $li.data('value'); // Mengambil data-value
            const text = $li.text().trim(); // Mengambil teks, .trim() sudah tersedia di jQuery

            $hidden.val(val); // Mengatur nilai input tersembunyi
            $selectedLabel.text(text); // Mengatur teks label yang dipilih
            
            // Menghapus kelas 'selected' dari semua anak li, lalu menambahkannya ke li yang dipilih
            $options.children().removeClass('selected');
            $li.addClass('selected');

            // Menutup dropdown
            $options.removeClass('show');
            $toggle.attr('aria-expanded', 'false');
        });

        // 3. Menutup saat klik di luar area
        // Event click pada document
        $(document).on('click', function(e) {
            // Memeriksa apakah klik TIDAK terjadi di dalam options DAN TIDAK di dalam toggle
            // .is() dapat digunakan untuk memeriksa kecocokan dengan pemilih
            if (!$options.is(e.target) && !$options.has(e.target).length && !$toggle.is(e.target)) {
                if ($options.hasClass('show')) {
                    $options.removeClass('show');
                    $toggle.attr('aria-expanded', 'false');
                }
            }
        });

        // 4. Menutup saat tombol ESC ditekan
        // Event keydown pada document
        $(document).on('keydown', function(e) {
            // e.which untuk kompatibilitas, tapi e.key lebih modern dan berfungsi
            // menggunakan e.key === 'Escape'
            if (e.key === 'Escape' && $options.hasClass('show')) {
                $options.removeClass('show');
                $toggle.attr('aria-expanded', 'false');
            }
        });
    }
});