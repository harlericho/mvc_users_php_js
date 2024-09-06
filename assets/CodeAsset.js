const app = (() => {
  const tbody = document.getElementById("tbody");

  const fetchData = async (url, options = {}) => {
    try {
      const res = await fetch(url, options);
      const data = await res.json();
      if (!res.ok)
        throw new Error(data.message || "Error al procesar la solicitud");
      return data;
    } catch (error) {
      alert(`Error: ${error.message}`);
      throw error;
    }
  };

  const renderTable = (data) => {
    tbody.innerHTML = data
      .map(
        (element) => `
          <tr>
            <td>${element.id}</td>
            <td>${element.name}</td>
            <td>${element.email}</td>
            <td>
              <a class="btn btn-primary btn-sm" onclick="app.edit(${element.id})">Editar</a>
              <a class="btn btn-danger btn-sm" onclick="app.delete(${element.id})">Eliminar</a>
            </td>
          </tr>`
      )
      .join("");
  };

  const listado = async () => {
    const data = await fetchData("../index.php?action=list");
    renderTable(data);
  };

  const submit = async () => {
    const form = new FormData(document.getElementById("form"));
    const name = form.get("name");
    const email = form.get("email");

    if (!name) {
      alert("El campo nombre es obligatorio");
      return document.getElementById("name").focus();
    }
    if (!email) {
      alert("El campo email es obligatorio");
      return document.getElementById("email").focus();
    }

    const action = form.get("id") ? "update" : "store";
    const url = `../index.php?action=${action}`;
    const responseCode = await fetchData(url, {
      method: "POST",
      body: form,
    });
    if (responseCode) {
      alert(
        `Registro ${
          action === "store" ? "guardado" : "actualizado"
        } correctamente`
      );
      listado();
      clean();
    }
  };

  const deleteUser = async (id) => {
    const url = `../index.php?action=delete&id=${id}`;
    const responseCode = await fetchData(url);
    if (responseCode) {
      alert("Registro eliminado correctamente");
      listado();
    }
  };

  const edit = async (id) => {
    const url = `../index.php?action=show&id=${id}`;
    const data = await fetchData(url);
    document.getElementById("id").value = data.id;
    document.getElementById("name").value = data.name;
    document.getElementById("email").value = data.email;
    document.getElementById("name").focus();
  };

  const clean = () => {
    document.getElementById("id").value = "";
    document.getElementById("form").reset();
    document.getElementById("name").focus();
  };

  return {
    listado,
    submit,
    delete: deleteUser,
    edit,
    clean,
  };
})();

app.listado();
