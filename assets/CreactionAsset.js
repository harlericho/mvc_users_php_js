import { fetchData } from "./CodeAsset.js";
import { listado } from "./ListAsset.js";
import { showAlert, handleError } from "./MessageAsset.js";
import { clean } from "./CleanAsset.js";
import { routes } from "./RoutesAsset.js";
const submit = async () => {
  const form = new FormData(document.getElementById("form"));
  const name = form.get("name");
  const email = form.get("email");

  if (!name) {
    showAlert("El campo nombre es obligatorio");
    return document.getElementById("name").focus();
  }
  if (!email) {
    showAlert("El campo email es obligatorio");
    return document.getElementById("email").focus();
  }

  const url = form.get("id") ? routes.update : routes.store;
  // const url = `../index.php?action=${action}`;
  try {
    const { data, status } = await fetchData(url, {
      method: "POST",
      body: form,
    });
    if (status === 200 || status === 201) {
      showAlert(data.message);
      listado();
      clean();
    }
  } catch (error) {
    handleError(error, "submit");
  }
};

export { submit };
