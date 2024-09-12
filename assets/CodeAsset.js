import { handleError } from "./MessageAsset.js";
const fetchData = async (url, options = {}) => {
  try {
    const res = await fetch(url, options);
    const data = await res.json();
    if (!res.ok)
      throw new Error(data.message || "Error al procesar la solicitud");
    return { data, status: res.status };
  } catch (error) {
    handleError(error, "fetchData");
    throw error;
  }
};

export { fetchData };
