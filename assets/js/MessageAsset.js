const showAlert = (message) => alert(message);

const handleError = (error, context) => {
  console.error(`Error en ${context}:`, error);
  showAlert(`Error: ${error.message}`);
};

export { showAlert, handleError };
