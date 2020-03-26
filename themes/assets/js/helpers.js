const $url = "http://localhost/app/";
export default {
    async request(path, method, payload) {
        let url = $url + path;
        let response = await fetch(url, {method: method, body: method != "GET" ? payload : null});
        let data = await response.json();
        return data;
    },
    serialize(obj) {
        let queryString = "";
        for (let key in obj) {
          queryString += `&${key}=${obj[key]}`;
        }
        return queryString;
    }
}