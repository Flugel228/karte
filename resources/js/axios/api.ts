import axios from "axios";
import {RefreshResponse} from "../types/axios/api";
import store from "../store";

const api = axios.create()

api.interceptors.request.use(config => {
    const access_token = localStorage.getItem('access_token');
    if (access_token) {
        config.headers.Authorization = `Bearer ${access_token}`;
    }
    return config;
}, error => {
    return Promise.reject(error);
});


api.interceptors.response.use(config => {
    const access_token = localStorage.getItem('access_token');

    if (access_token) {
        config.headers.Authorization = `Bearer ${access_token}`
    }

    return config;
}, async error => {
    if (error.response.status === 401) {
        try {
            const access_token = localStorage.getItem('access_token');
            const res = await axios.post<RefreshResponse>('api/users/auth/refresh', {}, {
                headers: {
                    'Authorization': `Bearer ${access_token}`
                }
            });
            if (res.status === 200) {
                localStorage.setItem('access_token', res.data.access_token);
                store.commit("SET_ACCESS_TOKEN");
            } else {
                localStorage.removeItem('access_token');
                store.commit("SET_ACCESS_TOKEN");
            }
        } catch (e) {
            if (axios.isAxiosError(e)) {
                console.log(e.message, "err");
                console.log(e.response?.data.message, "error");
            } else if (e instanceof Error) {
                console.log(e.message);
            }
            localStorage.removeItem('access_token');
            store.commit("SET_ACCESS_TOKEN");
        }

    }
    return Promise.reject(error);
})

export default api
