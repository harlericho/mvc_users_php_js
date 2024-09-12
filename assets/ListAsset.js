import { fetchData } from "./CodeAsset.js";
import { handleError } from "./MessageAsset.js";
import { routes } from "./RoutesAsset.js";
const tbody = document.getElementById("tbody");

const renderTable = (data) => {
  if (data.length) {
    tbody.innerHTML = data
      .map(
        (element, index) => `
          <tr>
            <td>${index + 1}</td>
            <td>${element.name}</td>
            <td>${element.email}</td>
            <td>
             <a class="btn btn-primary btn-sm" data-id="${
               element.id
             }" id="edit-btn">Editar</a>
            <a class="btn btn-danger btn-sm" data-id="${
              element.id
            }" id="delete-btn">Eliminar</a>
            </td>
          </tr>
        `
      )
      .join("");
  } else {
    tbody.innerHTML = `
        <tr>
          <td colspan="4" class="text-center">No hay registros</td>
        </tr>
      `;
  }
};

const listado = async () => {
  try {
    // const { data, status } = await fetchData("../index.php?action=list");
    const { data, status } = await fetchData(routes.list);
    if (status === 200) {
      renderTable(data);
    }
  } catch (error) {
    handleError(error, "listado");
  }
};

export { listado };
