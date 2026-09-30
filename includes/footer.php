<footer>

    <div class="container footer-content">

        <div class="footer-logo">

            <img
                src="assets/img/logo1.png"
                alt="Mahira Printing"
            >

        </div>

        <p>
            Percetakan & Digital Printing
        </p>

        <p class="copyright">
            © 2026 Mahira Printing. All rights reserved.
        </p>

    </div>

</footer>


<button
    id="backTop"
    class="back-top"
    type="button"
>
    ↑
</button>


<script>

var navbar = document.getElementById("navbar");
var backTop = document.getElementById("backTop");
var menuToggle = document.getElementById("menuToggle");
var navMenu = document.querySelector(".nav-menu");


window.addEventListener("scroll", function() {

    if (navbar) {

        if (window.scrollY > 50) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }

    }


    if (backTop) {

        if (window.scrollY > 400) {
            backTop.classList.add("show");
        } else {
            backTop.classList.remove("show");
        }

    }

});


if (backTop) {

    backTop.addEventListener("click", function() {

        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });

    });

}


if (menuToggle && navMenu) {

    menuToggle.addEventListener("click", function() {

        navMenu.classList.toggle("show");

    });

}


var reveals = document.querySelectorAll(".reveal");


function revealOnScroll() {

    for (var i = 0; i < reveals.length; i++) {

        var windowHeight = window.innerHeight;
        var elementTop = reveals[i].getBoundingClientRect().top;
        var elementVisible = 100;

        if (elementTop < windowHeight - elementVisible) {

            reveals[i].classList.add("active");

        }

    }

}


window.addEventListener("scroll", revealOnScroll);

revealOnScroll();

</script>


</body>

</html>