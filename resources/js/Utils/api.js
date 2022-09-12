export const get = (route) => window.axios.get(route).then(response => response.data)
