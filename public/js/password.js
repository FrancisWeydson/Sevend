document.addEventListener("DOMContentLoaded", function () {
    // Verifica se os elementos existem no DOM antes de associar os eventos
    const helpIcon = document.getElementById("helpIcon");
    const popupHelp = document.getElementById("popupHelp");
    const togglePassword = document.getElementById("togglePassword");
    const passwordInput = document.getElementById("password");

    if (togglePassword && passwordInput) {
        togglePassword.addEventListener("click", function () {
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                togglePassword.textContent = "visibility_off";  // Atualiza o ícone para "ocultar"
            } else {
                passwordInput.type = "password";
                togglePassword.textContent = "visibility";  // Atualiza o ícone para "mostrar"
            }
        });
    }

    if (helpIcon && popupHelp) {
        helpIcon.addEventListener("click", function (event) {
            event.stopPropagation();
            popupHelp.classList.toggle("show");  // Exibe ou esconde o popup
        });

        // Fecha o popup ao clicar fora
        document.addEventListener("click", function (event) {
            if (!helpIcon.contains(event.target) && !popupHelp.contains(event.target)) {
                popupHelp.classList.remove("show");
            }
        });
    }
});
