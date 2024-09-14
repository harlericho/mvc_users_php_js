import { listado } from "./ListAsset.js";
import { clean } from "./CleanAsset.js";
import { edit, deleteUser } from "./OptionsAsset.js";
import { submit } from "./CreactionAsset.js";

document.addEventListener("DOMContentLoaded", () => {
  listado();

  document.getElementById("form").addEventListener("submit", (e) => {
    e.preventDefault();
    submit();
  });

  document.getElementById("btnClean").addEventListener("click", clean);

  document.getElementById("tbody").addEventListener("click", (e) => {
    if (e.target.id === "edit-btn") {
      edit(e.target.dataset.id);
    }
    if (e.target.id === "delete-btn") {
      deleteUser(e.target.dataset.id);
    }
  });
});
