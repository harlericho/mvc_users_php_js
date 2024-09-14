const clean = () => {
  document.getElementById("id").value = "";
  document.getElementById("form").reset();
  document.getElementById("name").focus();
  document.getElementById("btnSubmit").textContent = "Guardar";
};

export { clean };
