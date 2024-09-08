const app = (() => {
  const tbody = document.getElementById("tbody");

  const fetchData = async (url, options = {}) => {
    try {
      const res = await fetch(url, options);
      const data = await res.json();
      if (!res.ok)
        throw new Error(data.message || "Error al procesar la solicitud");
      return { data, status: res.status };
    } catch (error) {
      alert(`Error: ${error.message}`);
      throw error;
    }
  };

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
              <a class="btn btn-primary btn-sm" onclick="app.edit(${
                element.id
              })">Editar</a>
              <a class="btn btn-danger btn-sm" onclick="app.delete(${
                element.id
              })">Eliminar</a>
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
      const { data, status } = await fetchData("../index.php?action=list");
      if (status === 200) {
        renderTable(data);
      }
    } catch (error) {
      console.error("Error en listado:", error);
    }
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
    try {
      const { data, status } = await fetchData(url, {
        method: "POST",
        body: form,
      });
      console.log("data:", data.message);
      console.log("status:", status);
      if (status === 200 || status === 201) {
        alert(data.message);
        listado();
        clean();
      }
    } catch (error) {
      console.error("Error en submit:", error);
    }
  };

  const deleteUser = async (id) => {
    if (confirm("¿Está seguro de eliminar el registro?")) {
      const url = `../index.php?action=delete&id=${id}`;
      try {
        const { data, status } = await fetchData(url);
        if (status === 200) {
          alert(data.message);
          listado();
        }
      } catch (error) {
        console.error("Error en deleteUser:", error);
      }
    }
  };

  const edit = async (id) => {
    document.getElementById("btnSubmit").textContent = "Actualizar";
    const url = `../index.php?action=show&id=${id}`;
    try {
      const { data, status } = await fetchData(url);
      if (status === 200) {
        document.getElementById("id").value = data.id;
        document.getElementById("name").value = data.name;
        document.getElementById("email").value = data.email;
        document.getElementById("name").focus();
      }
    } catch (error) {
      console.error("Error en edit:", error);
    }
  };

  const clean = () => {
    document.getElementById("id").value = "";
    document.getElementById("form").reset();
    document.getElementById("name").focus();
    document.getElementById("btnSubmit").textContent = "Guardar";
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
