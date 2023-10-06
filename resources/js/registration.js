document.addEventListener("DOMContentLoaded", function () {
    const registrationForm = document.getElementById("registrationForm");
    const messageDiv = document.getElementById("message");

    registrationForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const firstName = document.getElementById("firstName").value;
        const lastName = document.getElementById("lastName").value;
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirmPassword").value;

        // Виконуємо перевірку на клієнтському боці, наприклад, чи паролі співпадають та чи містить email символ "@"
        if (password !== confirmPassword) {
            messageDiv.innerHTML = "Паролі не співпадають.";
        } else if (!email.includes("@")) {
            messageDiv.innerHTML = "Email повинен містити символ '@'.";
        } else {
            // Всі дані валідні, відправляємо AJAX-запит
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "registration.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        messageDiv.innerHTML = "Реєстрація успішна!";
                        registrationForm.reset();
                    } else {
                        messageDiv.innerHTML = "Помилка реєстрації: " + response.message;
                    }
                }
            };

            const data = `firstName=${firstName}&lastName=${lastName}&email=${email}&password=${password}`;
            xhr.send(data);
        }
    });
});
