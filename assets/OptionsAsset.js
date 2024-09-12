import { fetchData } from "./CodeAsset.js";
import { listado } from "./ListAsset.js";
import { showAlert, handleError } from "./MessageAsset.js";
import { routes } from "./RoutesAsset.js";
const deleteUser = async (id) => {
  if (confirm("¿Está seguro de eliminar el registro?")) {
    // const url = `../index.php?action=delete&id=${id}`;
    const url = routes.delete(id);
    try {
      const { data, status } = await fetchData(url);
      if (status === 200) {
        showAlert(data.message);
        listado();
      }
    } catch (error) {
      handleError(error, "deleteUser");
    }
  }
};

const edit = async (id) => {
  document.getElementById("btnSubmit").textContent = "Actualizar";
  // const url = `../index.php?action=show&id=${id}`;
  const url = routes.show(id);
  try {
    const { data, status } = await fetchData(url);
    if (status === 200) {
      document.getElementById("id").value = data.id;
      document.getElementById("name").value = data.name;
      document.getElementById("email").value = data.email;
      document.getElementById("name").focus();
    }
  } catch (error) {
    handleError(error, "edit");
  }
};

export { deleteUser, edit };
