/*===== FOCUS =====*/
const inputs = document.querySelectorAll(".form__input")

/*=== Add focus ===*/
function addfocus() {
    let parent = this.parentNode.parentNode
    parent.classList.add("focus")
}

/*=== Remove focus ===*/
function remfocus() {
    let parent = this.parentNode.parentNode
    if (this.value == "") {
        parent.classList.remove("focus")
    }
}

/*=== To call function===*/
inputs.forEach(input => {
    input.addEventListener("focus", addfocus)
    input.addEventListener("blur", remfocus)
})

/*=== Validation form 1===*/
function validation() {
    var a = document.forms["myform"]["Nama Lengkap"].value
    var b = document.forms["myform"]["Email"].value
    var c = document.forms["myform"]["Password"].value
    var d = document.forms["myform"]["No Telepon"].value
    if (a == "") {
        alert("Nama Lengkap harus diisi")
        return false
    } else if (b == "") {
        alert("Email harus diisi")
        return false
    } else if (c == "") {
        alert("{Password harus diisi}")
        return false
    } else if (d == "") {
        alert("Nomor Telepon harus diisi")
        return false
    }

}

/*=== Validation form 2===*/
function validation2() {
    var e = document.forms["myform2"]["Data Keluarga"].value
    var f = document.forms["myform2"]["NIK"].value
    var g = document.forms["myform2"]["Tanggal"].value
    var h = document.forms["myform2"]["Alamat"].value
    var i = document.forms["myform2"]["RS"].value
    if (e == "") {
        alert("Data Keluarga harus diisi")
        return false
    } else if (f == "") {
        alert("NIK harus diisi")
        return false
    } else if (g == "") {
        alert("Tanggal Tes harus diisi")
        return false
    } else if (h == "") {
        alert("Alamat Tes harus diisi")
        return false
    } else if (i == "") {
        alert("Rumah Sakit harus diisi")
        return false
    }
}

$(document).ready(function () {

    $('#menu').click(function () {
        $(this).toggleClass('fa-times');
        $('.navbar').toggleClass('nav-toggle');
    });

    $(window).on('scroll load', function () {

        $('#menu').removeClass('fa-times');
        $('.navbar').removeClass('nav-toggle');

        if ($(window).scrollTop() > 0) {
            $('.scroll-top').show();
        } else {
            $('.scroll-top').hide();
        }

        // scroll spy 


        $('section').each(function () {

            let height = $(this).height();
            let offset = $(this).offset().top - 200;
            let id = $(this).attr('id');
            let top = $(window).scrollTop();

            if (top > offset && top < offset + height) {
                $('.navbar ul li a').removeClass('active')
                $('.navbar').find(`[href="#${id}"]`).addClass('active');
            }

        });

    });

    // smooth scrolling

    $('a[href*="#"]').on('click', function (e) {

        e.preventDefault();

        $('html, body').animate({

                scrollTop: $($(this).attr('href')).offset().top,

            },
            500,
            'linear'
        )

    })

});

