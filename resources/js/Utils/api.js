export const get = (route) => window.axios.get(route).then(response => response.data)
export const post = (route, data) => window.axios.post(route, data).then(response => response.data)
