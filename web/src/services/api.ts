import axios from "axios";

export const api = axios.create({
    timeout : 2000,
    baseURL: 'http://0.0.0.0:8888',
    headers: {
        'Access-Control-Allow-Origin': '*',
        'Access-Control-Allow-Headers': '*',
    }
})