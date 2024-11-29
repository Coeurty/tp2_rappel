import "./bootstrap.js";
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import "./styles/app.css";
import Swal from "sweetalert2";

function openModal(url) {
  Swal.fire({
    html: '<div id="modalContent">Chargement...</div>',
    showCloseButton: true,
    showConfirmButton: false,
    width: "600px",
    didOpen: () => {
      fetch(url)
        .then((response) => response.text())
        .then((html) => {
          document.getElementById("modalContent").innerHTML = html;
        })
        .catch(() => {
          document.getElementById("modalContent").innerHTML =
            '<p class="text-red-500">Erreur de chargement</p>';
        });
    },
  });
}

window.openModal = openModal;
