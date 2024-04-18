import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

function setupNavCurrentLinkHandling() {
    // Can return two, one for mobile nav and one for desktop nav
    [...document.querySelectorAll(".docs_sidebar ul")].forEach((nav) => {
        const localePattern = /^\/[a-zA-Z]{2}\//;
        const pathnameWithoutLocale = window.location.pathname.replace(
            localePattern,
            "/",
        );
        const current = nav.querySelector(
            'li a[href="' + pathnameWithoutLocale + '"]',
        );

        if (current) {
            current.parentNode.parentNode.parentNode.classList.add("sub--open");
            current.parentNode.classList.add("active");
        }
    });

    [...document.querySelectorAll(".docs_sidebar h2")].forEach((el) => {
        el.addEventListener("click", (e) => {
            e.preventDefault();

            const parent = el.parentNode;

            if (parent.classList.contains("sub--open") || parent.classList.value === '') {
                parent.classList.remove("sub--open");
                parent.classList.add("sub--close");
            } else {
                parent.classList.remove("sub--close");
                parent.classList.add("sub--open");
            }

        });
    });

    [...document.querySelectorAll(".docs_sidebar code")].forEach(
        function (code) {
            switch (code.textContent.trim().toLowerCase()) {
                case "get":
                    code.classList.add("get");
                    break;
                case "post":
                    code.classList.add("post");
                    break;
                case "put":
                    code.classList.add("put");
                    break;
                case "patch":
                    code.classList.add("patch");
                    break;
                case "delete":
                    code.classList.add("delete");
                    break;
            }
        },
    );
}

setupNavCurrentLinkHandling();

document.querySelectorAll("#copy-button").forEach(button => {
    button.addEventListener("click", async function () {
        await copyCode(button.closest("figure").querySelector("pre code"), button.querySelector('span'))
    });
});

document.querySelectorAll("#copy-base").forEach(button => {
    button.addEventListener("click", async function () {
        await copyCode(button.querySelector("code"), button.querySelector('span'))

    });
});


async function copyCode(code, button) {
    let text = code.innerText;

    await navigator.clipboard.writeText(text);

    button.innerText = "Copied!";

    setTimeout(() => {
        button.innerText = "Copy";
    }, 700);
}
