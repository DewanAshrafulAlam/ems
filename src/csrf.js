import axios from 'axios';

export const getCsrfCookie = () => {
  return axios.get('http://127.0.0.1:8000/sanctum/csrf-cookie', {
    withCredentials: true,
  });
};