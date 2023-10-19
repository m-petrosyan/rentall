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
            Authorization: `Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiMWMwOGJjMTZmNmE1YmM3MDc2NGFlZDI3Y2UyOWNjZjk1YjRhN2RmZTI4MDI2YWI3ZDM1ZTdmNjBiMTA0MzJmMWExZTgzYTY1MjgxMDk5ZTYiLCJpYXQiOjE2OTcwNDg5NTAuOTk0MzI1LCJuYmYiOjE2OTcwNDg5NTAuOTk0MzQsImV4cCI6MTcyODY3MTM1MC45NDk2OTMsInN1YiI6IjEiLCJzY29wZXMiOlsiKiJdfQ.kCpAiVK7UnmPuMCIoedaZJ6Dx_vw7Czbz12ogRjAvEiy-ly0Zv3jk-kghehK-iUBYgRC0v-8_C1lu03cm3iD1gTzzkg5-USKJ_88LeACXf5pBf8g1tVS9vV5OVlXDXcD1KzPRFeFfobIDCdKddvN2RjS8n-xd7A2uthMb_5OePFrZjyRmSQ5MX_vgC__XA73674gdAyJ4uzzolG8OzV3ba9E3VeG0TARZ9hhgWAqEfVSfvA55P4QM5ljuCESBf3vk9ExPw4t2jhxh3ftSB82xvLDq9ZwFYXFgilue7HX9J_C2VQofOVNa9sMGZdjhprqgnt5Pg4zW9XTTpmWJKm8MPtzaFsCFriFuBKujCfmwN-Axokhkene6PGFXP1Vsr97__is767ILusanaDJWppK2LMBi4ZI8EZPVVg42sT65tGczx-zfvlMRwpWuDCDPTfUchH3nTOpj1pudigAZ2AyuHgvMzDAhU0L0lvay5wM1osixBrpyQmbW-eKfMhP7_3EZRS3gbOHA7EB6YswTKru8VdLM3enyQbdhNNw8hdMUoOLSAZe-hehlEvO-AiUEqKK1SUTQxPKhU6qWtcPVc1_oyzPjS0zTh9Nv0vwBRxjkbFwMefi-gMv05dTItTervLCUtACSfv6EcVHe6-94wRp1aoGpjOdMHJbodccIjwNJAs`,
            accept: "application/json"
        },
    };
};

export {postRequest, getRequest, patchRequest, putRequest, deleteRequest}
