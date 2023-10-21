import axios from "axios";

const url = import.meta.env.VITE_APP_API
const getRequest = async (urlPath, data) => {
    let headers = await getHeader();
    return axios
        .get(url + urlPath, {...headers, params: data})
        .then(response => response.data)
        .catch(error => Promise.reject(error.response.data.data))
};

const postRequest = async (urlPath, data) => {
    let headers = await getHeader();
    return axios
        .post(url + urlPath, data, headers)
        .then(response => response.data)
        .catch(error => Promise.reject(error.response.data));
};

const deleteRequest = async (url, body) => {
    let headers = await getHeader();
    headers = {...headers, ...{data: body}};
    return axios
        .delete(url, headers)
        .then(response => response.data)
        .catch(error => Promise.reject(error.response.data));
};

const putRequest = async (urlPath, body) => {
    let headers = await getHeader();
    return axios
        .put(url + urlPath, body, headers)
        .then(response => response.data)
        .catch(error => Promise.reject(error.response.data));
};

const patchRequest = async (urlPath, body) => {
    let headers = await getHeader();
    return axios
        .patch(urlPath, body, headers)
        .then(response => response.data)
        .catch(error => Promise.reject(error.response.data));
};

const getHeader = async () => {
    let access_token = sessionStorage.getItem('token')
    return {
        headers: {
            // Authorization: `Bearer ${access_token}`,
            Authorization: `Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiYzYwM2Y4YzVjMDdhZThjNmMzYjBiODBlNWIwM2Q2YzI2YWJkZjQyOWIyZDMyMDE1ODU2MGM3MGNjZWY3ZjMzZTM1MDI3NDA5OTU4NWMwMDMiLCJpYXQiOjE2OTc4OTgxODUuNDc2MDAzLCJuYmYiOjE2OTc4OTgxODUuNDc2MDE1LCJleHAiOjE3Mjk1MjA1ODUuNDU0MTQ0LCJzdWIiOiIxIiwic2NvcGVzIjpbIioiXX0.XQMLPWtYOdiAYDufCxgcPG8zPIaaptu4jk8hmjjWCki-NAjRSZIwEbP7glIw9WJGigUP38EER0f5MFooVKiDPQFJ4zAjchert5_7olpTWbAFuQ9m2FM4EJ-_A13PqOJM5MxCfPn-iVEcmkyGeRk0zZ0VAv9SHMvqbHfidSXQAFcpB0TDuQONq385NjHQgkNlinUm2T1sSSPc1-PIrf6LW6BUgvDHXftk6ppp12niMrGfAkl7Nw6vM8fb-yXnAOgROoJNvuW5Z9qsT0m_h7RiBInGvoXtPmGtDv60QhaKb80IDkyezVHkfOWDF4ecggN5FnHsUhu4Lzj6y2SCMqhWK6EBEgTFB9xrWFtgrFSJ_Y5dpMw4vsJlnsHL8_aaMRoRbFZFuMiWpSyUFtlWYR9nZ89HSK3bWg033oIJ5Uhdp0LkLJ4XfdQLbMjPol0dJmnBr2-5ajU8lxfDJkH30ALvozzTsBz6TiAlFMugbZLVva0uJ5dzU1-JKiCtSBD6m7epDpIalPrCu3wzj-XgQeqBC2CF8sE0vm9Q9AQYj_Y-5fQ2pI0czU44_QEtmfFyA1fZ-ISzSvAi6tsEsA-PFUy1zFMaSJrNq2YPJinp4DrYArhuiMY7SrSJ1SAybmdcsJRzCmdi_gWSOFx09E-YIaQ6k3ZoGbCNRWnZxCuEckCfSx4`,
            accept: "application/json"
        },
    };
};

export {postRequest, getRequest, patchRequest, putRequest, deleteRequest}
