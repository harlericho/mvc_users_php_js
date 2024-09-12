const API_BASE_URL = "../index.php";

const routes = {
  list: `${API_BASE_URL}?action=list`,
  show: (id) => `${API_BASE_URL}?action=show&id=${id}`,
  delete: (id) => `${API_BASE_URL}?action=delete&id=${id}`,
  store: `${API_BASE_URL}?action=store`,
  update: `${API_BASE_URL}?action=update`,
};

export { routes };
