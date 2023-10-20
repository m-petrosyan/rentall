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
            Authorization: `Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiYjM2NDRhOWRhY2ViYWIyYjllOTgwZTMwNjRlMzVjZDVhNzFkMDNiODVkNGVmMDA0YWViMGNmYTE1YTM5Y2QwMjAwYTdkY2UxNTMxZDNjYmYiLCJpYXQiOjE2OTc3NDkzNzcuODIzNDksIm5iZiI6MTY5Nzc0OTM3Ny44MjM0OTksImV4cCI6MTcyOTM3MTc3Ny43NTgwMjksInN1YiI6IjEiLCJzY29wZXMiOlsiKiJdfQ.AHEwXWw3nv3IsYGWCnhtc4HaPCE6-24O4-KoUGFkWFPa4d-KJNS4qm1wWDFsDEs0sosPWKu6xu-rd9Pa6Ui91wwDvRJeXnBk_d5TKIjRNdruhL3WHhlaXIlSvCZ12MKlKkFAqv_cdMa8MSRHje7KGyB1gFOa7B3Ih0BZZGPikJs2tl_4EIviRu6qVGrZ83gw0uzHGCW8q7CgXrzO1lLGjg_QOWgoUcE45YSfq8LnfqaHp4V8ercWyh4-iQU34-VE-MZJSc2xgNTMhh62OXcp3vipAznbs2zr5aZvZME8tQb2H-1_FA6MTB_dmkB0nyWbiWEsbU6e-stJs4VeIyIguEtrsDB1t4MXBNxKp2Tdbv88dpoMMW1B6nHDnYWFHVEoncYXpvrza23LQqiQbZEpLwmgCvftZ9A2Zs84D3dPwbHZ8Rkrhiz9TcqKQ1f-U3ZAV-51N_br8_-OPuZ7uOsjw9VazJ4ujZY-EtKHts3jh7ewdn7Yfp-S-6HgK0-uHJ-ORz6vyRWXOQ8nTWBysSZIofOdW8Byg3QXeincNpVbngeaG6of4I8UariNGoFD40HuF4H4xXGscA5nV-ZVGTPlGnsjIzssYu-zlBhlx_xkAlJeULSVME2EJEpkBh93F36ORW39NSgb8PAW-ix7cwmLJ1oX1pcKRvjtRPvYWpQ6Dsc`,
            accept: "application/json"
        },
    };
};

export {postRequest, getRequest, patchRequest, putRequest, deleteRequest}
